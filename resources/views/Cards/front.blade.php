<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Card Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">

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
        }
        .card-custom-front{
            color: white;
            border-radius: 0px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               /* Your existing styles */
               /* background-image: url("images/bg_card_front.webp"); */
            background-size: contain;
            /* background-position: center; */
            background-blend-mode: overlay;
        }
        
        /* .card-custom {
            background-color: #857147;
            color: white;
            border-radius: 0px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            padding: 20px; 

        } */

        .card-custom-front::before,
.card-custom-front::after {
    content: "";
    position: absolute;
    background: white; /* Line color */
}

/* Top and Bottom lines */
.card-custom-front::before {
    width: 2px; /* Line thickness */
    height: 0.5cm; /* Height of the line */
    left: 50%; /* Center alignment */
    transform: translateX(-50%);
    top: 0; /* Top line */
}

.card-custom-front::after {
    width: 2px; /* Line thickness */
    height: 0.5cm; /* Height of the line */
    left: 50%; /* Center alignment */
    transform: translateX(-50%);
    bottom: 0; /* Bottom line */
}

/* Left line */
.card-custom-front .before-left {
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



/* Right line */
.card-custom-front .after-right {
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

.before-left, .after-right {
    background: white !important;
}


        .card-body {
            display: flex;
            justify-content: space-between;
          
        }

        .members_info-front {
            font-size: 40%;
            color: #fff;
            font-weight: 500;
        }
@font-face {
    font-family: "kefa";
    src: url("{{ asset('/assets/fonts/kefa.ttf') }}");
}
td h6{
    font-family: 'kefa', serif;
    font-weight: 400;
}

            .building-images {
                background-color: #3b321d; /* The color to show in the image pattern */
                -webkit-mask-image: url("{{ asset('/assets/img/front.png') }}"); /* Masking image */
                -webkit-mask-repeat: no-repeat; /* Ensures the image doesn't repeat */
                -webkit-mask-size: cover; /* Scale the mask to cover the area */
                mask-image: url("{{ asset('/assets/img/front.png') }}"); /* Masking for other browsers */
                mask-repeat: no-repeat;
                mask-size: cover;
                
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 100%;

            }
            h6 {
                font-size: 11.72pt;
            }
            .card-custom-front {
                height: 6.33cm;
                padding: 0.5cm;
            }

            .borderless {
                clip-path: inset(20px 20px 20px 20px);
            }

    </style>
</head>
<body onload="window.print();">
    <div class="container-fluid">
    <div class="row p-0 mx-2">
        @php
            $is_fuji = request()->fuji;
        @endphp
        @foreach($member_collection as $member)
                <div class="col-sm-6 p-0">
                    <div class="{{ (int)$is_fuji === 1 ? 'borderless' : '' }} card card-custom-front card-custom-front-{{ $member["id"] }} mx-1 mt-3" style="background-color: {{ $member["card_color"] }}; position: relative;">
                                <style>
                                    .card-custom-front-{{ $member["id"] }}::before,
                                    .card-custom-front-{{ $member["id"] }}::after {
                                        background: {{ $member["card_color"] }} !important;
                                        filter: brightness(1.3);
                                    }
                                </style>
                                <div class="building-images" style="z-index: 0; position: absolute; background-color: {{ $member['shade_color'] }}">&nbsp;</div>
                                <div class="before-left" style="z-index: 100; background-color: {{ $member['card_color'] }} !important; filter: brightness(1.3)"></div>
                                <div class="after-right" style="z-index: 100; background-color: {{ $member['card_color'] }} !important; filter: brightness(1.3)"></div>
                                <div class="card-body" style="z-index: 100;">
                                    <table style="width:100%">
                                    <tr>
                                        @if($member["card_type"] === "Provisional Membership")
                                            <td style="width: 65%;">
                                                <img src="{{ asset("/assets/img/card_logo_.png") }}" alt="Card Logo" class="img-fluid" style="width: 70%; margin-top:-20px; position: relative; {{ (int)$is_fuji === 1 ? 'left: 0px' : 'left: 20px' }} ">
                                            </td>
                                            <td style="width: 35%; text-align: right;">
                                                <h6>{{ $member["card_type"] }}</h6>
                                            </td>
                                        @elseif($member["card_type"] === "cleared")
                                            <td colspan="2" class="text-center">
                                                <img src="{{ asset("/assets/img/gg_logo.png") }}" alt="Card Logo" class="img-fluid" style="height:50px;">
                                            </td>
                                        @else 
                                            <td style="width: 65%;">
                                                <img src="{{ asset("/assets/img/card_logo_.png") }}" alt="Card Logo" class="img-fluid" style="width: 70%; margin-top:-20px; position: relative; left: 20px;">
                                            </td>
                                            <td style="width: 35%; text-align: right;">
                                                <h6>Not Valid <br /> For Family</h6>
                                            </td>
                                        @endif
                                    </tr>

                                        <tr>
                                        <td colspan="2"><h6 class="text-center" style="margin: 38px 0px; font-size: 11.72pt">{{ $member["card_name"] }}</h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6 class="text-start">{{ $member["member_name"] }}</h6></td>
                                            <td><h6 class="text-end">{{ $member["membership_number"] }}</h6></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                </div>
                @endforeach
    </div>


       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>