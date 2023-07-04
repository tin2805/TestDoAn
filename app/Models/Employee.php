<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Employee extends Authenticatable
{
    use HasFactory;

    public function hashPassword($password)
    {
        $this->password = Hash::make($password);
    }

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            $model->hashPassword($model->password);
        });
    }

    protected $fillable = ['fullname','email','phone','user_name','address', 'password'];


}
