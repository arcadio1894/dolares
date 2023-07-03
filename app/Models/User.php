<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'document',
        'last_login',
        'account_type',
        'business_name',
        'department_id',
        'province_id',
        'district_id',
        'direction',
        'name_legal_representative',
        'dni_legal_representative',
        'profession',
        'economic_activity_id',
        'economic_sector_id',
        'constitution_date',
        'state_company',
        'front_image',
        'reverse_image',
        'flag_front',
        'flag_reverse',
        'reason_refuse_front',
        'reason_refuse_reverse'
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }

    public function economic_activity()
    {
        return $this->belongsTo('App\Models\EconomicActivity', 'economic_activity_id', 'id');
    }

    public function economic_sector()
    {
        return $this->belongsTo('App\Models\EconomicSector', 'economic_sector_id', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'last_login', 'created_at', 'constitution_date'
    ];

    public function setLastLogin($value)
    {
        $this->attributes['last_login'] = $value;
    }

    public function getLastLogin()
    {
        return $this->last_login;
    }

    public function routeNotificationForTelegram()
    {
        return $this->telegram_chat_id;
    }
}
