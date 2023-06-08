<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'nombre'
    ];


}

