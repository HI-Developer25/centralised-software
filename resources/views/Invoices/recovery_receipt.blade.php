<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hashim Abbas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <style>
        body {
            font-family: 'helvetica', 'Helvetica', sans-serif !important;
        }
        @page {
            padding-left: 18px;
            margin-top: 0px;
        }
        @media print{
                @page{
                    size: A5;
                    margin: 0;
                    padding: 0;
                }
                table, th, td {
                    border: 0.5px solid black;
                }

                .bc-head-txt-label {
                    left: calc(50% - .5rem);
                    line-height: 1;
                    padding-top: .5rem;
                    position: absolute;
                    left: 0;
                    top:30px;
                    transform: rotate(180deg);
                    white-space: nowrap;
                    writing-mode: vertical-rl;
                    font-size:10px;
                    font-weight:600;
                    color: #a7a7a7 !important;
                }
            .button{
                display:none;
            }
            }
            body {
                font-size: 11px;
            }
        table{
            line-height: 6px;
        }
            .header h1 {
                font-size: 20px;
                font-weight: 400;
                text-transform: uppercase;
                
            }
            .header h1 span{
                font-weight: bold;
            }
            p{
                font-size: 8px;
                margin-bottom: 2px;
                line-height: 12px;
            }
            .form-section {
                border: 1px solid #000;
                padding: 20px;
            }
            .form-label {
                font-weight: bold;
            }
            .form-check-label {
            font-size: 9px;
            font-weight: bold;
            padding-left: 5px;
            margin-top: 6px;
            }
            .plans-goals {
                font-size: 9px;
                line-height: 12px;
                margin-bottom: 2px;
                text-transform: capitalize;
            }
            /* .remarks {
                height: 100px;
            } */
            .sign-stamp {
                height: 50px;
            }
            tr td{
                font-size: 9px;
                text-transform: uppercase;
            }
            .question{
                border:1px dashed #000;
                border-radius:8px !important; 
                padding: 5px;
            }
            input.form-check-input {
                width: 30px;
                height: 15px;
                border: 2px solid #000;
            }
            .form-box{
                font-weight: bold;
                font-size: 12px;
                text-transform: uppercase;
            }
            .subsidy{
                font-size: 13px;
                font-weight: bold;
                text-transform: uppercase;
            }
            .subsidy span{
                font-weight: 400;
            }
            .date{
                font-weight: bold;
                font-size: 11px;
                text-transform: uppercase;
            }
            .date span{
                font-weight: 400;
            }
            .bc-head-txt-label {
    left: calc(50% - .5rem);
    line-height: 1;
    padding-top: .5rem;
    position: absolute;
    left: 0;
    top:30px;
    transform: rotate(180deg);
    white-space: nowrap;
    writing-mode: vertical-rl;
    font-weight:600;
    color: #a7a7a7;
}
            /* img{
                vertical-align: middle;
            } */

            table, th, td {
                border: 1px solid black;
                border-bottom: none;
                border-collapse: collapse;
            }
    </style>

</head>
<body>

    <div class="container-fluid mt-4" style="padding-top: -100px;">
        <div class="header" style="margin: 0; padding: 0;">
       
            <div style="float: left; margin-bottom: 15px">
                <h1 class="mt-2" style="font-weight: bold; margin-bottom: 3px;">RECEIPT</h1>
                <span style="line-height: 0px;">
                    <p style="font-size: 15px; margin-top: 0px; font-weight: 400; margin-bottom: 0px; padding-bottom: 0px; margin: 0; height: 10px;">from Gwadar Gymkhana (Pvt) Ltd.</p>
                    <p style="font-size: 8px; margin-top: 0px; padding-top: 0px; margin: 0; padding: 0;">PR120224 - <span style="font-style: italic;">All published prices are in PKR.</span></p>
                </span>
            </div>
            
            <!-- <img src="" alt=""> -->
             <div style="position: relative;">
                 <img src="https://gwadargymkhana.com.pk/cef/admin/img/logo.png" alt="" class="img-fluid" width="180px" style="float: right; position: absolute; top: 10; right: 0;">
             </div>
        </div>

        <div style="margin-top: 0.5px; font-weight: bold; width: 100%; text-align: right; font-size: 10px;">
            <p style="font-size: 10px;">www.gwadargymkhana.com.pk - UAN: +9221-111-947-111</p>
        </div>
        
       <table style="width: 100%; border-collapse: collapse; margin-top: 10px">
            <tr>
                <td style="width: 70%; border: none; padding: 6px; font-size: 10px; text-transform: capitalize; vertical-align: middle;">
                    <span style="font-weight: bold">To</span>: <span>{{ $receipt->member->member_name }}</span>
                </td>
                
                <td style="text-align: center; vertical-align: middle; width: 30%; border: none; border-left: 1px solid black; padding: 6px; border-right: 1px solid black; border-bottom: 1px solid black; line-height: 8px; font-size: 10px; text-transform: capitalize; line-height: 10px;" rowspan="2">
                    <span style="font-weight: bold;">Receipt No:</span>
                    <br>
                    {{ $receipt->receipt_id }}
                </td>
            </tr>
            <tr>
                <td style="width: 70%; border-bottom: 1px solid black; border-right: none; padding: 6px; font-size: 10px; text-transform: capitalize; padding-top: 8px;">
                    <span style="font-weight: bold;">CNIC/Passport No</span>: <span>{{ $receipt->member->cnic_passport }}</span>
                </td>
            </tr>
        </table>
        <div class="tick_mark_sign" style="margin-top: 10px; text-align: center">
            <img style="margin: 0 auto;" src="https://gwadargymkhana.com.pk/mailer/mailer/sign_logo_2.png" width="150"> 
        </div>
        <p style="text-align: center; font-weight: bold; font-size: 15px; margin-bottom: 5px;">Payment received. Thank you!</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 40px;">
            <tr style="padding: 6px;">

              <td style="padding: 6px; width: 35%; text-transform: capitalize; font-size: 10px;"><span style="font-weight: bold; text-transform: lowercase"><span style="text-transform: uppercase;">P</span>ayment <span style="text-transform: uppercase;">R</span>eference no: <span style="font-weight: normal; text-transform: uppercase;">{{ $receipt->reference_number }}</span></td>
            <td style="padding: 6px; white-space: nowrap; width: 40%; font-size: 10px;"><span style="font-weight: bold; text-transform: capitalize;">Payment Method: </span><span style="text-transform: capitalize;">{{ $receipt->payment_method->payment_method }}</span></td>
               
        </table>
        <table style="width: 100%; text-align: center; border-bottom: 1px solid black;">
            <tr style="vertical-align: middle;">
                <td style="font-size: 20px; font-weight: bold; padding-top: 30px; padding-bottom: 20px;">PAID PKR. {{ number_format($receipt->paid_amount) }}/-</td>
            </tr>
        </table>
        
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="padding: 5px; width: 20%; text-transform: lowercase; text-align: center; font-size: 10px;"><span style="font-weight: bold;"><span style="text-transform: uppercase;">D</span>ate: </span>{{ $receipt->date }}</td>
                <td style="padding: 5px; white-space: nowrap; width: 40%; text-transform: lowercase;"><span style="font-weight: bold;"><span style="text-transform: uppercase; font-size: 10px;">I</span>nvoice generated by:</span> <span style="text-transform: capitalize;">Khadija Baloch</td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse; border-bottom: 1px solid black;">
            <tr>
                <td style="font-weight: bold; padding: 10px; width: 20%; font-size: 10px !important; text-transform: lowercase; text-align: center; line-height: 11px; background: #fff2cc;"><span style="text-transform: uppercase;">T</span>his receipt is electronically generated and valid without a signature or stamp. It is only valid
with the above payment reference number for verification</td>
            </tr>
        </table>
        <p style="text-align: center; font-weight: bold; font-size: 10px; margin-top: 20px; line-height: 10px;">This receipt confirms only the amount received</p>
        
         <p style="font-weight: bold; text-align: center; margin-top: 10px; font-size: 10px; line-height: 9px; margin-top: 30px;">For inquiries, contact Finance department at +9221 111 947 111 ext. 206 or <br> <span style="color: #0563c1; text-decoration: underline;">info@gwadargymkhana.com.pk</span></p>
                
    </div>
       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>