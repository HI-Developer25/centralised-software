<?php

namespace App\Jobs;

use App\Models\Setting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_Spreadsheet;
use Google_Service_Sheets_ValueRange;
use Google_Service_Drive;
use Google_Service_Drive_Permission;
use Illuminate\Support\Facades\Schema;
use App\Models\Member;

class SaveInGoogleDrive implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
{
    try {
        $setting = Setting::first();
        $client = new Google_Client();
        $client->setApplicationName("Google Sheets Export");

        // 👇 Add Google Drive API scope to allow sharing
        $client->setScopes([
            Google_Service_Sheets::SPREADSHEETS,
            Google_Service_Drive::DRIVE,
        ]);

        $client->setAuthConfig(base_path(env('GOOGLE_SERVICE_ACCOUNT_PATH')));
        $client->setAccessType("offline");

        $sheets = new Google_Service_Sheets($client);

        // 1. Create spreadsheet
        $spreadsheet = new Google_Service_Sheets_Spreadsheet([
            'properties' => ['title' => 'Laravel Members Export - ' . now()->toDateTimeString()]
        ]);
        
        $spreadsheetId = null;
        if(!$setting) {
            $spreadsheet = $sheets->spreadsheets->create($spreadsheet);
            $spreadsheetId = $spreadsheet->spreadsheetId;
        } else {
            $spreadsheetId = $setting->google_sheet_id;
        }

        // 2. Insert data
        $value = [];
        $vals = Member::all();

        foreach($vals as $val) {
            $value[] = [ 
                $val->id,
                $val->member_name,
                $val->date_of_birth,
                $val->gender,
                $val->marital_status,
                $val->cnic_passport,
                str_replace("+", "", $val->phone_number),
                str_replace("+", "", $val->alternate_ph_number),
                $val->email_address,
                $val->residential_address,
                $val->city_country,
                $val->membership->card_name,
                $val->membership_number,
                $val->membership_status,
                $val->file_number,
                $val->date_of_applying,
                $val->form_fee,
                $val->processing_fee,
                $val->first_payment,
                $val->total_installment,
                $val->installment_month,
                $val->payment_status,
                $val->blood_group,
                $val->emergency_contact,
                $val->card_type,
                $val->date_of_issue,
                $val->validity,
                $val->locker_category,
                $val->locker_number
            ];
        }

        $values = [
            [
                "id", 
                "Member Name", 
                "Date of Birth",
                "Gender",
                "Marital Status",
                "CNIC/Passport",
                "Phone Number",
                "Alternate Phone Number",
                "Email Address",
                "Residential Address",
                "City Country",
                "Membership Type",
                "Membership Number",
                "Membership Status",
                "File Number",
                "Date of Applying",
                "Form Fee",
                "Processing Fee",
                "First Payment",
                "Total Installment",
                "Installment Month",
                "Payment Status",
                "Blood Group",
                "Emergency Contact",
                "Card Type",
                "Date of Issue",
                "Validity",
                "Locker Category",
                "Locker Number"
            ],
            ...$value
        ];

        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);

        $sheets->spreadsheets_values->update(
            $spreadsheetId,
            'Sheet1!A1',
            $body,
            ['valueInputOption' => 'RAW'] 
        );

        // 3. Share sheet with your Gmail
        $driveService = new Google_Service_Drive($client);
        $permission = new Google_Service_Drive_Permission([
            'type' => 'user',
            'role' => 'writer', // use 'reader' if you only want to view
            'emailAddress' => 'backup290125@gmail.com' 
        ]);
        $driveService->permissions->create($spreadsheetId, $permission);

        // 4. Show the sheet URL
        $url = "https://docs.google.com/spreadsheets/d/$spreadsheetId";

        if(!$setting) {
            Setting::create([
                "google_drive_link" => $url,
                "google_sheet_id" => $spreadsheetId
            ]);
        }

    } catch (\Google_Service_Exception $e) {
        \Log::error('Google_Service_Exception: ' . $e->getMessage());
        \Log::error('HTTP Code: ' . $e->getCode());
        \Log::error('Errors Array: ' . json_encode($e->getErrors()));
        \Log::error('Full Exception: ' . $e);
        throw $e;

    } catch (\Exception $e) {
        \Log::error('General Exception: ' . $e->getMessage());
        throw $e;
    }
}

}
