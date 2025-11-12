<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'report_month',
        'total_sales',
    ];

    // Relasi ke user (vendor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke toko
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
