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
        'nameAccount',
        'numberAccount',
        'type_account',
        'currency',
        'status',
        'property',
        'user_id',
        'department_id'
    ];

    protected $dates = ["created_at", "updated_at", "deleted_at"];

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank', 'bank_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

}
