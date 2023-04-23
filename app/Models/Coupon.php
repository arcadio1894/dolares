<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'coupons';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'amountBuy',
        'amountSell',
        'status',
    ];

    protected $dates = ["created_at", "updated_at", "deleted_at"];
}
