<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    use HasFactory;

    protected $table = 'accountings';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'operation_id',
        'bank_id',
        'account_dolarero_id',
        'document_customer',
        'type_operation',
        'type_exchange',
        'code_operation_customer',
        'code_operation_dolarero',
        'balance_prev',
        'balance_next',
        'type',
        'date',
        'observation'
    ];

    protected $dates = ["date"];

    public function operation()
    {
        return $this->belongsTo('App\Models\Operation', 'operation_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank', 'bank_id', 'id');
    }

    public function account_dolarero()
    {
        return $this->belongsTo('App\Models\AccountDolarero', 'account_dolarero_id', 'id');
    }
}
