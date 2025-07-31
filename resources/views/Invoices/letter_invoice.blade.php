<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduction Letter <?php echo $timestamp = date('d M Y'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @media print{
                @page{
                    size: A5 !important;
                    size: landscape !important; 
                    margin: 0 10px;
                    margin-left:50px;
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
            line-height: 5px;
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
                font-size:12px;
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
            .sign-stamp {
                height: 50px;
            }
            tr td{
                font-size: 12px;
                text-transform: capitalize;
                font-weight: 400;
                padding:10px !important;   
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
@media only screen and (max-width: 768px) {
.form-label {
    font-size:9px;
    line-height:10px;
}
td span{
    font-size:9px !important;
}
h2{
    font-size:10px !important;
}
.header img{
    width:40%;
}
}
    </style>
</head> 

<body onload="window.print()">
    <div class="container-fluid mt-2">
        <div class="header row">
            <div class="col-9" style="vertical-align: middle;">
                <h2 style="font-size:18px; text-transform: uppercase; font-weight: 400;" class="mt-2">Introduction Letter</h2>
                <p style="font-size:11px; line-height: 1px;">RII30924 | www.gwadargymkhana.com.pk  -  UAN: +9221-111-947-111</p>
            </div>
            <div class="col-3 text-end" >
                <img src="https://gwadargymkhana.com.pk/introletter/images/logo.png" alt="" class="img-fluid" width="250">
            </div>
            
        </div>
        <!-- <p class="my-2"><span style="font-weight: bold;">TERMS & CONDITION:</span> The Gwadar Gymkhana Club offers selective memberships for business professionals, including those in industrial and import-export sectors. Perfect for individuals involved in major projects within Gwadar Economic Zone, such as the construction of factories and hotels. It's also suited for those interested in Gwadar's tourism. Complete the eligibility form to apply. Suitable applicants will be contacted for membership details. By applying, you agree to our terms and confirm the accuracy of your information. Your personal data will be securely used for club-related communications only.</p> -->
        
    <table class="table-bordered table mt-3" style="border: 1px solid #000 !important;">
        <tr>
            <td style="width: 20%;">To the reciprocal club</td>
            <td colspan="4">{{ $introletter->club->club_name }}</td>
            <td>Issue Date</td>
            <td><?php echo date('d M Y', strtotime($introletter->created_at)); ?></td>
        </tr> 
        <tr>
            <td>Member's name</td>
            <td colspan="2">{{ $introletter->member->member_name }}</td>
            <td>Membership No:</td>
            <td>{{ $introletter->member->membership_number }}</td>
            <td>Expiry Date</td>
            <td><?php echo date('d M Y', strtotime($introletter->created_at->addMonths($introletter->duration->months))); ?></td>
        </tr> 
        
    </table>
<table class="table-bordered table mt-2" style="border: 1px solid #000 !important;">
    <tr>
        <td>Spouse Name</td>
        @if(optional($introletter->member->spouses)[0])
            <td style="width: 30%;">{{  $introletter->member->spouses[0]->spouse_name }}</td>
        @elseif(isset($member) && $member->spouse_name)
            <td style="width: 30%;">{{  $member->spouse_name }}</td>
        @else
            <td style="width: 30%">N/A</td>
        @endif
        
        <td>Second Spouse Name</td>
        @if(optional($introletter->member->spouses)[1])
            <td style="width: 30%;">{{  $introletter->member->spouses[1]->spouse_name }}</td>
        @elseif(isset($member) && $member->second_spouse)
            <td style="width: 30%;">{{  $member->second_spouse }}</td>
        @else
            <td style="width: 30%">N/A</td>
        @endif
    </tr> 
    <tr>
        <td >Third Spouse Name</td>
        
        @if(optional($introletter->member->spouses)[2])
            <td style="width: 30%;">{{  $introletter->member->spouses[2]->spouse_name }}</td>
        @elseif(isset($member) && $member->third_spouse)
            <td style="width: 30%;">{{  $member->third_spouse }}</td>
        @else
            <td style="width: 30%">N/A</td>
        @endif
        
        <td>Fourth Spouse Name</td>
        
        @if(optional($introletter->member->spouses)[3])
            <td style="width: 30%;">{{  $introletter->member->spouses[3]->spouse_name }}</td>
        @elseif(isset($member) && $member->fourth_spouse)
            <td style="width: 30%;">{{  $member->fourth_spouse }}</td>
        @else
            <td style="width: 30%">N/A</td>
        @endif
    </tr> 
    
</table>

<table class="table-bordered table mt-2" style="border: 1px solid #000 !important;">
    <tr>
        <td rowspan="5" class="text-center" style="vertical-align: middle;">Children's Name</td>
        <td style="width: 42%;">{{ optional($introletter->member->children)[0] ? $introletter->member->children[0]->child_name : 'N/A' }}</td>
        <td style="width: 42%;">{{ optional($introletter->member->children)[1] ? $introletter->member->children[1]->child_name : 'N/A' }}</td>
    </tr> 
    <tr>
        <td style="width: 40%;">{{ optional($introletter->member->children)[2] ? $introletter->member->children[2]->child_name : 'N/A' }}</td>
        <td style="width: 40%;">{{ optional($introletter->member->children)[3] ? $introletter->member->children[3]->child_name : 'N/A' }}</td>
    </tr>
    <tr>
    <td style="width: 40%;">{{ optional($introletter->member->children)[4] ? $introletter->member->children[4]->child_name : 'N/A' }}</td>
    <td style="width: 40%;">{{ optional($introletter->member->children)[5] ? $introletter->member->children[5]->child_name : 'N/A' }}</td>
    </tr>
    <tr>
    <td style="width: 40%;">{{ optional($introletter->member->children)[6] ? $introletter->member->children[6]->child_name : 'N/A' }}</td>
    <td style="width: 40%;">{{ optional($introletter->member->children)[7] ? $introletter->member->children[7]->child_name : 'N/A' }}</td>
    </tr>
    <tr>
    <td style="width: 40%;">{{ optional($introletter->member->children)[8] ? $introletter->member->children[8]->child_name : 'N/A' }}</td>
    <td style="width: 40%;">{{ optional($introletter->member->children)[9] ? $introletter->member->children[9]->child_name : 'N/A' }}</td>
    </tr>
</table>
<table class="table-bordered table my-2" style="border: 1px solid #000 !important;">
    <tr>
        <td>CNIC/Passport Number</td>
        <td style="width: 50%;">{{ $introletter->member->cnic_passport }}</td>
    </tr> 
</table>
<h6 class="my-1" style="font-size:10px; font-weight:400;">Gwadar Gymkhana Club will not be responsible for credit facilities if any rendered to the members. I shall appreciate extension of facilities of your Club to our member with family holding membership cards. If you have any queries, please contact me at reciprocal@gwadargymkhana.com.pk. Thank you!</h6>
<h6 class="my-1" style="font-size:10px; font-weight:400;">Approved by (with stamp):</h6>
<table class="table-bordered table my-2" style="border: 1px solid #000 !important;">
    <tr>
    <td class="p-4"></td>
    <td class="p-4"></td>
    </tr>
    <tr>
        <td>Reciprocal Department - Ghina Shahmir</td>
        <td>Recovery Department - Khadija Baloch</td>
    </tr>
</table>
<h6 class="my-1" style="font-size:10px; font-weight:400;">A payment of PKR 1000/- per month for the processing fee of this introduction letter has been received. <span style="font-weight:500;">Guest access is not allowed.</span></h6>
                
    </div>
       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>




</body>
</html>
