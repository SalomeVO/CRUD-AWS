<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user_sombies extends Authenticatable
{
    use HasFactory;

    public $table='user_sombies';

    public $timestamps=false;
    protected $fillable=[
        'id','name','points','email', 'password','dateZ', 'image',
    ];

    protected $primaryKey='id';


    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
