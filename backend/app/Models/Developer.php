<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = [
        "datanascimento",
        "sexo",
        "nome",
        "hobby"
    ];

    public function setIdadeAttribute()
    {
        $this->attributes['idade'] =  \Carbon\Carbon::parse($this->attributes['datanascimento'])->age;
    }
    
}
