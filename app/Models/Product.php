<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected table = 'my_products';
    protected $fillable = [
        'panelId',
        'burden',
        'voltage',
        'electricCurrent',
        'power'
    ];

    public function panel()
    {
        return $this->belongsTo(Panel::class, 'panelId');
    }
}
