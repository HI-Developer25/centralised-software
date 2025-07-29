<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Card Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
        @page {
            size: 8in 11in;
            margin: 0; /* Adjust as needed for your layout */
        }
        body {
            margin: 0;
            padding: 0;
            width: 8in;
            height: 11in;
        }
        .container-fluid {
            width: 100%;
            height: 100%;
            image-rendering: crisp-edges; /* For images, if any */
        }
        .card-custom {
            color: white;
            border-radius: 0px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            padding: 20px; 

        }

        .card-custom::before,
    .card-custom::after {
        content: "";
        position: absolute;
    }

    /* Top and Bottom lines */
    .card-custom::before {
        width: 2px; /* Line thickness */
        height: 0.5cm; /* Height of the line */
        left: 50%; /* Center alignment */
        transform: translateX(-50%);
        top: 0; /* Top line */
    }

    .card-custom::after {
        width: 2px; /* Line thickness */
        height: 0.5cm; /* Height of the line */
        left: 50%; /* Center alignment */
        transform: translateX(-50%);
        bottom: 0; /* Bottom line */
    }

    /* Left line */
    .card-custom .before-left {
        content: "";
        position: absolute;
        background: #000;
        height: 0.5cm; /* Full height */
        width: 2px; /* Line thickness */
        top: 50%;
        right: 0; /* Left side */
        transform: translateY(45%);
        rotate: 90deg;
    }
    
    .before-left, .after-right {
        background: white !important;
    }

    /* Right line */
    .card-custom .after-right {
        content: "";
        position: absolute;
        background: #000;
        height: 0.5cm; /* Full height */
        width: 2px; /* Line thickness */
        top:50%;
        left: 0; /* Right side */
        transform: translateY(-45%);
        rotate: 90deg;
    }


            .card-body {
                display: flex;
                justify-content: space-between;
                padding: 10px 10px;
            }

            .members_info {
                font-family: 'Roboto';
                font-size: 6.13pt;
                color: #fff;
                font-weight: bold;
                line-height: 10px;
            }

            .card-footer-custom {
                font-size: 16px;
            }
            .bc-head-txt-label {
        left: calc(50% - .5rem);
        line-height: 1;
        padding-top: .5rem;
        position: relative;
        transform: rotate(180deg);
        white-space: nowrap;
        writing-mode: vertical-rl;
        color: #fff;
        font-weight: 500;
        font-size: 50%;


    }

    .card-custom {
        height: 6.33cm;
        /*padding: 0.5cm;*/
    }


</style>
</head>
<body onload="window.print();">
<div class="container-fluid">
    <div class="row p-0 mx-2">
            @foreach($member_collection as $member)
                            <div class="col-sm-6 p-0">
                            
                            <div class="card card-custom mx-1 mt-3 card-custom-{{ $member['id'] }}" style="background-color: {{ $member['card_color'] }};">
                            <style>
                                .card-custom-{{ $member['id'] }}::before,
                                .card-custom-{{ $member['id'] }}::after {
                                    background: {{ $member['card_color'] }} !important;
                                    filter: brightness(1.3);
                                }
                            </style>
                            <div class="before-left" style="background-color: {{ $member['card_color'] }} !important; filter: brightness(1.3)"></div>
                            <div class="after-right" style="background-color: {{ $member['card_color'] }} !important; filter: brightness(1.3)"></div>
                            <div class="card-body">
                                <table style="width:100%">
                                    <tr>
                                        <td style="width: 62%;">
                                            <table class="membership-details" style="width: 100%;">
                                                <tr class="members_info">
                                                    <td>NIC No:</td>
                                                    <td>{{ $member["cnic_passport"] }}</td>
                                                </tr>
                                                <tr class="members_info">
                                                    <td>Membership Type:</td>
                                                    <td>{{ $member["card_name"] }}</td>
                                                </tr>
                                                <tr class="members_info">
                                                    <td>Membership No:</td>
                                                    <td>{{ $member["membership_number"] }}</td>
                                                </tr>
                                                <tr class="members_info">
                                                    <td>Blood Group:</td>
                                                    <td style="text-transform: uppercase;">{{ $member["blood_group"] ?? "-" }}</td>
                                                </tr>
                                                <tr class="members_info">
                                                    <td>Emergency No:</td>
                                                    <td>{{ $member["emergency_contact_code"] ?? "" . str_replace("+", "+" . $member['emergecy_contact_code'], $member["emergency_contact"]) }}</td>
                                                </tr>
                                                <tr class="members_info">
                                                    <td>Date of Issue:</td>
                                                    <td><?= date('d-M-y', strtotime($member["date_of_issue"])); ?></td>
                                                </tr>
                                                <tr class="members_info">
                                                    <td>Validity:</td>
                                                    <td><?= date('d-M-y', strtotime($member["validity"])); ?></td>
                                                </tr>
                                            </table>
                                            <table class="membership-details mt-3" style="width: 100%;">
                                                <tr class="members_info">
                                                    <td class="pe-4">Corporate Office: VG House, The Plaza, Suite 207, 2nd Floor, Khayaban-e-Iqbal, Block-9, Clifton, Karachi, Pakistan.</td>
                                                </tr>
                                                <tr class="members_info">
                                                    <td>Help Line: +9221-111-947-111</td>
                                                </tr>
                                                <tr class="members_info">
                                                    <td>Club Address: 01, Club Road, North Darbela, Platinum Seaview, Gwadar, Pakistan.</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width: 36%; text-align: center; position: relative; top: 10px;">
                                            @php
                                                $path = $member["profile_picture"];
                                                $base64 = null;
                                                if (Storage::disk('public')->exists($path)) {
                                                    $data = Storage::disk('public')->get($path);
                                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                                }
                                            @endphp
                                            <img src="{{ $base64 }}" alt="<?= htmlspecialchars($member['member_name']); ?>" style="width:50%; height:65px;">
                                            <p class="members_info mt-1">{{ $member["member_name"] }}</p>
                                            <div class="bg-white mx-auto" style="height: 40px; width: 80%; border-radius: 3px;">
                                                <img src="{{ asset('/assets/img/sign_logo.png') }}" alt="" class="img-fluid" style="height: 40px;">
                                            </div>
                                            <p class="members_info mt-1">SECRETARY<br>GWADAR GYMKHANA</p>
                                        </td>
                                        <td style="width: 2%;">
                                            <div class="bc-head-txt-label bc-head-icon-chrome_android">Membership card is required for the use of <br>facilities and services in Gwadar Gymkhana.</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                            </div>
                    
                        
            
            <?php endforeach; ?>
            </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


