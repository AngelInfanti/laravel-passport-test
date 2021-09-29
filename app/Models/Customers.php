<?php

namespace App\Models;

use App\Models\Communes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'dni',
        'id_reg',
        'id_com',
        'email',
        'name',
        'last_name',
        'address',
        'status',
        'date_reg'

    ];

    public $primaryKey  = 'dni';

    public $incrementing = false;

    public $timestamps = false;

    public function communes(){
        return $this->hasOne(Communes::class, 'id_com', 'id_com');
    }

    public function regions(){
        return $this->hasOne(Communes::class, 'id_reg', 'id_reg');
    }

}
