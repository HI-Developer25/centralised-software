<?php

namespace App\Preprocess;

use App\Http\Requests\MemberRequest;

class CleanMemberRequest
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function clean(MemberRequest $request) {
        $spouses = request()->spouses;
        $children = request()->children;

        $children = collect($children)->filter(function ($child) {
            $excludeKeys = ['profile_pic', 'emergency_number', 'emergency_country_code', 'emergency_phone_number'];  // allow null in these keys

            foreach ($child as $key => $value) {
                if (in_array($key, $excludeKeys, true)) {
                    continue;  // skip checking this field
                }

                if ($value === null) {
                    return false;  // reject if any other field is null
                }
            }
            return true;
        });

        $spouses = collect($spouses)->filter(function ($spouse) {
            $excludeKeys = ['profile_pic', 'emergency_number', 'emergency_country_code', 'emergency_phone_number'];  // allow null in these keys

            foreach ($spouse as $key => $value) {
                if (in_array($key, $excludeKeys, true)) {
                    continue;
                }

                if ($value === null) {
                    return false;
                }
            }
            return true;
        });

        $phone_numbers = json_decode(request()->phone_numbers);

        return [$children, $spouses, $phone_numbers];
    }
}
