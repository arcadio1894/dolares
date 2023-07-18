<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EconomicActivity extends Model
{
    use HasFactory;

    protected $table = 'economic_activities';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'description',
        'sector_id'
    ];

    public function sector()
    {
        return $this->belongsTo('App\Models\EconomicSector', 'sector_id', 'id');
    }

}
