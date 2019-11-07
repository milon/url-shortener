<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['link_id', 'os', 'browser', 'ip', 'device', 'device_type', 'meta'];

    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
