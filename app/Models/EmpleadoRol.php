<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoRol extends Model
{
    use HasFactory;
    protected $table = 'empleado_rol';
    protected $fillable = [
        'empleado_id',
        'rol_id',
    ];

    // -------------------------------------- Relations Models --------------------------------------------//
    public function foreignWorker()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function foreignRol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
