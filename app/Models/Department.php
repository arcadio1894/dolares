<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function accounts()
    {
        return $this->hasMany('App\Models\AccountDolarero', 'department_id', 'id');
    }

    public function account_customers()
    {
        return $this->hasMany('App\Models\AccountCustomer', 'department_id', 'id');
    }
}
