<?php

namespace App;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['url'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($link){
            $link->hash = Str::random(6);
            $link->user_id = auth()->id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
