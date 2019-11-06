<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['url'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($link){
            $pool = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
            $this->hash = substr(str_shuffle(str_repeat($pool, 5)), 0, 6);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
