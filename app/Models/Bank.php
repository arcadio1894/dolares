<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'banks';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
        'nameBank',
        'imageBank',
        'status',
    ];

    protected $dates = ["created_at", "updated_at", "deleted_at"];

    public function accounts()
    {
        return $this->hasMany('App\Models\AccountDolarero', 'bank_id', 'id');
    }
}
