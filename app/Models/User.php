<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

/**
 * @property string name
 * @property string first_name
 * @property string last_name
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'first_name',
            'last_name',
            'email',
            'password',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function routeNotificationForSlack()
    {
        return $this->settigns()->where('slack_hook')->first()->value;
    }

    public function settings()
    {
        return $this->morphMany(Setting::class, 'settingable');
    }
}
