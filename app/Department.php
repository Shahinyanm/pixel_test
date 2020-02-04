<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'description', 'logo'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'department_users','department_id','user_id');
    }

    public function getLogoAttribute(){
        return $this->attributes['logo']? 'storage/logos/'.$this->attributes['logo'] : null;
    }
}
