<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTO;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Plan extends Model
{

    protected $fillable = [
        'title',
        'body',
        'prefecture',
        'address',
        'meeting_date_time',
        'age',
        'venue',
        'membership_fee',
        'capacity',
    ];

    protected $dates = ['meeting_date_time'];
    
    public function user():BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'interests')->withTimestamps();
    }

    public function isInterestedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->interests->where('id', $user->id)->count()
            : false;
    }

    public function getCountInterestsAttribute(): int
    {
        return $this->interests->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function participations(): HasMany
    {
        return $this->hasMany('App\Models\Participation', 'plan_id');
    }

    public function is_participationed_by_auth_user()
    {
        $id = Auth::id();
        $participations = array();
        foreach($this->participations as $participation) {
            array_push($participations, $participation->user_id);
        }

        if (in_array($id, $participations)) {
            return true;
        } else {
            return false;
        }
    }
}
