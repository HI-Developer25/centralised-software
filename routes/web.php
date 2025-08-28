<?php

use App\DateFormatter;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Members\MemberRecoverySheetController;
use App\Http\Controllers\Api\RecoveryController;
use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\CardTypeController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\ComplainQuestionController;
use App\Http\Controllers\ComplainTypeController;
use App\Http\Controllers\DeploymentController;
use App\Http\Controllers\DurationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportingController;
use App\Http\Controllers\IntroletterController;
use App\Http\Controllers\Members\MemberController;
use App\Http\Controllers\MembersCardController;
use App\Http\Controllers\MembershipCardController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ThirdParty\GoogleServicesController;
use App\Http\Controllers\UserController;
use App\Jobs\CreateFamilySheet;
use App\Jobs\ImportingJob;
use App\Jobs\PrepareRecoveryData;
use App\Jobs\SaveInGoogleDrive;
use App\Models\Introletter;
use App\Models\Member;
use App\Models\Permission;
use App\Models\PersonalAccessToken;
use App\Models\RecoverySheet;
use App\Models\Setting;
use App\Models\Spouse;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TempMemberController;

Route::get("sheets", function() {
    Member::chunk(500, function ($members) {
        foreach ($members as $member) {
            dispatch(new CreateFamilySheet($member));
        }
    });
});

Route::get("google-drive", function() {
    dispatch(new ImportingJob());
});

Route::get("introletterss", function() {
    $introletter = Introletter::first();

    $member = Member::all();
    dd($introletter);
});


Route::get("import", [ImportingController::class, "import"]);

Route::get("testing-url", function() {
    dd("Deployment Refactored");
});

Route::post("/deploy", [DeploymentController::class, "deploy"])->withoutMiddleware([VerifyCsrfToken::class]);

Route::get("testing-image", function() {
    dd(base_path());
    $member = Member::latest()->first();
    $path = $member->profile_picture;
    $file = Storage::disk('public')->exists($path);
    dd($file);
});

Route::get("/recovery/{member:user_token}/download", [MemberRecoverySheetController::class, "download"])->name("member.recovery.sheet.file");
Route::get("/recovery/{member:user_token}", [MemberRecoverySheetController::class, "get"])->name("member.recovery.sheet.download");

Route::get("/create/tree", function() {
    $member = Member::latest()->first();
    dispatch(new CreateFamilySheet($member));
});

Route::get("/recovery-sheet", function(DateFormatter $dateFormatter) {
    PrepareRecoveryData::dispatch();
});

Route::get("/tree", function() {
    $member = Member::latest()->first();
    $pdf = Pdf::loadView("Invoices.member_tree", [
        "member" => $member
    ])->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper('A4', 'portrait');
    return $pdf->stream();
});

Route::get("/test", function() {
    dd("Test");
});
Route::get("populate-permissions", function() {
    $permissions = [
        "member:add",
        "member:manage",
        "member:birthdays",
        "recovery:payment-schedule",
        "recovery:report-by-members",
        "recovery:payment-receipt",
        "recovery:report-overall",
        "reciprocal:introletters",
        "reciprocal:manage-club",
        "reciprocal:add-club",
        "reciprocal:duration-and-fees",
        "card:add",
        "card:manage",
        "complains:by-member",
        "complains:types",
        "user:actions"
    ];
    $labels = [
        "Add member",
        "Manage member",
        "Birthdays",
        "View Payment Schedule",
        "Recovery Report by Members",
        "Recovery Payment Receipt",
        "Recovery Report Overall",
        "Create Introduction letter",
        "Manage Clubs",
        "Add Clubs",
        "Add duration and fees",
        "Add Card",
        "Manage Card",
        "Member Complain",
        "Complain Types",
        "Users"
    ];
    foreach($permissions as $index => $permission) {
        Permission::create([
            "ability" => $permissions[$index],
            "label" => $labels[$index]
        ]);
    }

    $user = User::create([
        "username" => "hashimabs",
        "fullname" => "Hashim Abbas",
        "password" => "anker@102"
    ]);
    $user->givePermissionsToUser($permissions);
});

Route::get('/', function () {
    phpinfo();
    return view('welcome');
});


Route::get("/", [HomeController::class, "index"])->name("home");

Route::get("/member/create", [MemberController::class, "create"])->name("member.create");
Route::get("/members", [MemberController::class, "index"])->name("member.manage");
Route::get("/member/{member}/update", [MemberController::class, "update"])->name("member.updated");
Route::get("/member/birthday", [BirthdayController::class, "index"])->name("member.birthdays");

Route::get("/membership-card/add-card", [CardTypeController::class, "create"])->name("card-type.add");
Route::get("/membership-cards", [CardTypeController::class, "index"])->name("card-type.index");
Route::get("/membership-card/{cardType}/update", [CardTypeController::class, "update"])->name("card-type.update");
Route::get("/members/membership-cards", [MembershipCardController::class, "index"])->name("membership.cards");

Route::get("/club/create", [ClubController::class, "create"])->name("club.create");
Route::get("/clubs", [ClubController::class, "index"])->name("club.index");
Route::get("/club/{club}/update", [ClubController::class, "update"])->name("club.update");

Route::get("/durations", [DurationController::class, "index"])->name("duration.index");

Route::get("/introletters", [IntroletterController::class, "index"])->name("introletter.index");
Route::get("/introletter/{introletter}/invoice", [IntroletterController::class, "invoice"])->name("introletter.invoice");

Route::get("googlesheet", [GoogleServicesController::class, "save"]);

Route::get("/card/front", [MembersCardController::class, "index"])->name("card.front");
Route::get("/card/back", [MembersCardController::class, "back"])->name("card.back");

Route::view("/view-payment-schedule", "Recovery.view-payment-schedule_2")->name("payment-schedule");
Route::get("/recovery/{member}/sheet", [\App\Http\Controllers\RecoveryController::class, "getSheet"])->name("member.recovery.sheet");
Route::get("/recovery/member/report", [\App\Http\Controllers\RecoveryController::class, "getReport"])->name("member.recovery.report");
Route::get("/recovery/monthly/report", [\App\Http\Controllers\RecoveryController::class, "getOverall"])->name("member.recovery.overall");

Route::get("/member/receipt", [ReceiptController::class, "create"])->name("member.recovery.receipt");
Route::get("/member/receipts", [ReceiptController::class, "get"])->name("member.recovery.receipts.get");
Route::get("/member/{receipt}/receipt", [ReceiptController::class, "update"])->name("member.recovery.receipt.update");

Route::get("/member/{member}/get", [MemberController::class, "getDetails"])->name("member.get");

Route::get("/payment-methods", [PaymentMethodController::class, "index"])->name("payment_method.index");
Route::get("/payment-method/create", [PaymentMethodController::class, "create"])->name("payment_method.create");

Route::get("/complain-types", [ComplainTypeController::class, "index"])->name("complain.complain-types.index");
Route::get("/complain/{complainType}/questions", [ComplainQuestionController::class, "index"])->name("complain.complain-types.questions.index");
Route::get("/complain/{complainType}/question/create", [ComplainQuestionController::class, "create"])->name("complain.complain-types.questions.create");
Route::get("/complain/{complainQuestion}/question/update", [ComplainQuestionController::class, "update"])->name("complain.complain-types.questions.update");

Route::get("/complains", [ComplainController::class, "get"])->name("complains");
Route::get("/complain/{complain}/get", [ComplainController::class, "getOne"])->name("complains.detail");

Route::get("/login", [AuthController::class, "login"])->name("login");

Route::get("/users", [UserController::class, "index"])->name("users");
Route::get("/user/create", [UserController::class, "create"])->name("user.create");
Route::get("/user/{user}/update", [UserController::class, "update"])->name("user.update");

Route::get("/temp-members", [TempMemberController::class, "index"])->name("temp.member.index");



