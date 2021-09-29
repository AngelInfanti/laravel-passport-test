<?php

namespace App\Models;

use App\Models\Regions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Communes extends Model
{
    use HasFactory;

    public $primaryKey  = 'id_com';

    public function regions(){
        return $this->hasOne(Regions::class, 'id_reg', 'id_reg');
    }
}
