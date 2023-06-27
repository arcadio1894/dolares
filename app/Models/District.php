<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'province_id',
        'department_id'
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id', 'id');
    }

}
