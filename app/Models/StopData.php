<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StopData extends Model
{
    use HasFactory;

    protected $table = 'stop_datas';

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
        'token'
    ];

    protected $dates = ["created_at", "updated_at"];
}
