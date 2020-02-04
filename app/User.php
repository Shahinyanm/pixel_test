<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Departments many to many relation
     *
     * @return BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_users');
    }

    /**
     * Scope for  all users besides Admin
     *
     * @param $query
     * @return mixed
     */
    public function scopeUsers($query)
    {
        return $query->where('email', '!=', 'admin@test.loc');
    }
}
