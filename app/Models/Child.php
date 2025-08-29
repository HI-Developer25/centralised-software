<?php

namespace App\Models;

use App\Jobs\CreateFamilySheet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];
    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function membership() {
        return $this->belongsTo(CardType::class, "membership_id");
    }

    protected static function booted() {
        static::created(function($data) {
            dispatch(new CreateFamilySheet($data->member));
        });

        static::updated(function($data) {
            dispatch(new CreateFamilySheet($data->member));
        });
    }

    public function scopeThirtyPlus(Builder $query) {
        return $query->whereDate(
            'date_of_birth', 
            '<=', 
            Carbon::now()->subYears(30)
        );
    }

     public function scopeFilter($query) {
        $keyword = request()->keyword;
        
        $query->where(function ($q) use ($keyword) {
            
            $q->whereLike("child_name", "%$keyword%")
            ->orWhereHas("membership", function($q) use ($keyword) {
                $q->whereLike("card_name", "%$keyword%");
            })
            ->orWhereHas("member", function($q) use ($keyword) {
                $q->whereLike("phone_number", "%$keyword%")
                    ->orWhereLike("residential_address", "%$keyword%");
            });
        });

        return $query;
    }
}
