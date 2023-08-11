<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StopOperation extends Model
{
    use HasFactory;

    protected $table = 'stop_operations';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'buyStop',
        'sellStop',
        'buyControl',
        'sellControl',
        'token',
        'coupon_id',
        'type',
        'sendAmount',
        'getAmount',
        'account_dolarero_id',
        'nameBankDolarero',
        'account_customer_id',
        'source_fund_id',
        'ahorro',
        'account_dolarero_real_id',
    ];

    protected $dates = ["created_at", "updated_at"];

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'coupon_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function account_dolarero()
    {
        return $this->belongsTo('App\Models\AccountDolarero', 'account_dolarero_id', 'id');
    }

    public function account_dolarero_real()
    {
        return $this->belongsTo('App\Models\AccountDolarero', 'account_dolarero_real_id', 'id');
    }

    public function account_customer()
    {
        return $this->belongsTo('App\Models\AccountCustomer', 'account_customer_id', 'id');
    }

    public function source_fund()
    {
        return $this->belongsTo('App\Models\SourceFund', 'source_fund_id', 'id');
    }
}
