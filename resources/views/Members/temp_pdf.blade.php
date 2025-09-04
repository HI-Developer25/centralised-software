<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Members Report - {{ date('d-m-Y') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<style>
    * {
        font-family: "Roboto", sans-serif;
    }
    
    body {
        padding: 20pt;
        margin: 0;
        font-size: 10px;
        line-height: 1.4;
    }
    
    .header {
        text-align: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #333;
        padding-bottom: 20px;
    }
    
    .header h1 {
        font-size: 24px;
        margin: 0 0 10px 0;
        color: #333;
    }
    
    .header p {
        font-size: 12px;
        margin: 0;
        color: #666;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 9px;
    }
    
    .main-table th {
        background-color: #343a40;
        color: white;
        padding: 8px 6px;
        text-align: left;
        font-weight: bold;
        font-size: 9px;
        border: 1px solid #dee2e6;
    }
    
    .main-table td {
        padding: 6px;
        border: 1px solid #dee2e6;
        vertical-align: top;
    }
    
    .main-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    .member-row {
        background-color: #ffffff;
    }
    
    .child-row {
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
    }
    
    .member-info {
        display: flex;
        align-items: center;
    }
    
    .member-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 8px;
        object-fit: cover;
    }
    
    .member-details h4 {
        margin: 0 0 2px 0;
        font-size: 10px;
        font-weight: bold;
        color: #333;
    }
    
    .member-details p {
        margin: 0;
        font-size: 8px;
        color: #666;
    }
    
    .child-details h4 {
        margin: 0 0 2px 0;
        font-size: 9px;
        font-weight: bold;
        color: #1976d2;
    }
    
    .child-details p {
        margin: 0;
        font-size: 7px;
        color: #666;
    }
    
    .address-cell {
        max-width: 150px;
        word-wrap: break-word;
    }
    
    .child-indent {
        padding-left: 20px;
    }
    
    @page {
        size: A4;
        margin: 1cm;
    }
    
    @media print {
        table {
            page-break-inside: avoid;
        }
        
        .member-row {
            page-break-inside: avoid;
        }
    }
</style>
<body>
    <div class="header">
        <h1>Temporary Members Report</h1>
        <p>Generated on {{ date('F d, Y \a\t H:i:s') }}</p>
    </div>
    
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 25%;">Member Name</th>
                <th style="width: 12%;">Contact Number</th>
                <th style="width: 20%;">Address</th>
                <th style="width: 15%;">Email</th>
                <th style="width: 12%;">Alt Ph. No.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tempMembers as $member)
                <!-- Main Member Row -->
                <tr class="member-row">
                    <td>
                        <div class="member-info">
                            @if(isset($member['profile_picture']))
                                <img src="https://gwadargymkhana.com.pk/members/storage/{{ $member['profile_picture'] }}" 
                                     alt="Profile" class="member-avatar">
                            @endif
                            <div class="member-details">
                                <h4>{{ $member['member_name'] ?? 'N/A' }}</h4>
                                <p>{{ ucfirst($member['membership_type'] ?? 'Unknown') }} Membership</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $member['contact_number'] ?? 'N/A' }}</td>
                    <td class="address-cell">
                        {{ strip_tags(str_replace('<br>', ', ', $member['address'] ?? 'N/A')) }}
                    </td>
                    <td>{{ $member['email'] ?? '-' }}</td>
                    <td>{{ $member['alternate_ph_number'] ?? '-' }}</td>
                </tr>
                
                <!-- Children Rows (Nested/Indented) -->
                @if(isset($member['children']) && count($member['children']) > 0)
                    @foreach($member['children'] as $child)
                        <tr class="child-row">
                            <td class="child-indent">
                                <div class="member-info">
                                    @if(isset($child['profile_pic']))
                                        <img src="https://gwadargymkhana.com.pk/members/storage/{{ $child['profile_pic'] }}" 
                                             alt="Child Profile" class="member-avatar">
                                    @endif
                                    <div class="child-details">
                                        <h4>{{ $child['child_name'] ?? 'N/A' }}</h4>
                                        <p>Child Member</p>
                                    </div>
                                </div>
                            </td>
                            <td class="child-indent" colspan="2">
                                @if(isset($child['date_of_birth']))
                                    @php
                                        try {
                                            $age = \Carbon\Carbon::parse($child['date_of_birth'])->age;
                                        } catch (\Exception $e) {
                                            $age = 'N/A';
                                        }
                                    @endphp
                                    {{ $age }} years
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="child-indent">-</td>
                            <td class="child-indent">-</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
    
    @if(count($tempMembers) == 0)
        <div style="text-align: center; padding: 40px; color: #666;">
            <h3>No Temporary Members Found</h3>
            <p>There are currently no temporary members in the system.</p>
        </div>
    @endif
</body>
</html>
