<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['url', 'hash'];

    protected $casts = [
        'is_private'    => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($link) {
            $link->user_id = auth()->id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    public function getIsPrivateLabelAttribute()
    {
        return $this->is_private ? 'Yes' : 'No';
    }

    public function getAllowedEmailLabelAttribute()
    {
        if (! $this->allowed_email) {
            return '-';
        }

        return collect(explode(',', $this->allowed_email))->transform(function ($item) {
            return trim($item);
        })->implode(', ');
    }

    public function isAllowedByPrivateUser(?User $user)
    {
        if (! $user) {
            return false;
        }

        return collect(explode(',', $this->allowed_email))->transform(function ($item) {
            return trim($item);
        })->contains($user->email);
    }
}
