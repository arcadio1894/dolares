<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $table = 'operations';

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
        'state',
        'number_operation_user',
        'number_operation_dolareros',
        'code_operation'
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

    public function account_customer()
    {
        return $this->belongsTo('App\Models\AccountCustomer', 'account_customer_id', 'id');
    }

    public function source_fund()
    {
        return $this->belongsTo('App\Models\SourceFund', 'source_fund_id', 'id');
    }

    public function getSendAmountListAttribute()
    {
        $moneda = ($this->type == 'buy') ? 'USD':'PEN' ;
        $amount = $moneda. ' '.number_format(round($this->sendAmount, 2), 2);

        return $amount;
    }

    public function getGetAmountListAttribute()
    {
        $moneda = ($this->type == 'buy') ? 'PEN':'USD' ;
        $amount = $moneda. ' '.number_format(round($this->getAmount, 2), 2);

        return $amount;
    }

    public function getTypeChangeAttribute()
    {
        if ( $this->coupon_id != null )
        {
            $amounCoupon = ($this->type == 'buy') ? $this->coupon->amountBuy:$this->coupon->amountSell;
        } else {
            $amounCoupon = 0;
        }

        $change = ($this->type == 'buy') ? $this->buyStop:$this->sellStop;
        $amount = number_format(round($change+$amounCoupon, 2), 2);

        return $amount;
    }

    public function getEstadoAttribute()
    {
        if ( $this->state == 'refused' ) {
            $estado = 'RECHAZADO';
        } elseif ($this->state == 'processing') {
            $estado = 'PROCESANDO';
        } else {
            $estado = 'FINALIZADO';
        }

        return $estado;
    }
}
