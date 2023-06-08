<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $table = 'empleado';
    protected $fillable = [
        'id',
        'nombre',
        'email',
        'sexo',
        'area_id',
        'boletin',
        'descripcion'
    ];

    // -------------------------------------- Relations Models --------------------------------------------//
    public function foreignArea()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
