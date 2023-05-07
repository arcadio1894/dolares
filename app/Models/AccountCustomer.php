<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountCustomer extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'account_customers';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'bank_id',
        'numberAccount',
        'currency',
        'status',
    ];

    protected $dates = ["created_at", "updated_at", "deleted_at"];

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank', 'bank_id', 'id');
    }

}
