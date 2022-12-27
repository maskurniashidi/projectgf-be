<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use HasFactory;

    protected $fillable = [
        'panelName',
        'maxPower',
        'remainingPower',
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'panelId');
    }
}
