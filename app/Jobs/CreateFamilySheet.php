<?php

namespace App\Jobs;

use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateFamilySheet implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Member $member)
    {
        //
    }

    /**
     * Execute the job.
     * 
     */
    public function handle(): void
    {
        $this->member->updateQuietly([
            "has_receipt_created" => false,
        ]);
        $pdf = Pdf::loadView("Invoices.member_tree", [ "member" => $this->member ])
    ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
    ->setPaper("A4", "portrait");

$pdfContent = $pdf->output();
$fileName = $this->member->member_name . "-" . $this->member->id . ".pdf";
$filePath = "members/FamilySheet/" . $fileName;

// Delete previous file if exists
if (Storage::disk("public")->exists($filePath)) {
    Storage::disk("public")->delete($filePath);
}

// Save new file
Storage::disk("public")->put($filePath, $pdfContent);

// Update member flag
$this->member->updateQuietly([
    "has_receipt_created" => true
]);

        
    }
}
