<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministracionCarrera extends Model
{
    protected $table = 'administracion_carreras';
    protected $primaryKey = 'id_administracion_carrera';
    public $timestamps = false;

    protected $fillable = [
        'id_area',
        'id_usuario',
        'id_carrera',
        'datos',
    ];

    protected $casts = [
        'datos' => 'array', 
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'id_carrera');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

     public function scopeBuscarPorNombre($query, $nombre)
    {
        return $query->where(function($q) use ($nombre) {
            $q->where('nombres', 'like', "%{$nombre}%")
              ->orWhere('primer_apellido', 'like', "%{$nombre}%")
              ->orWhere('segundo_apellido', 'like', "%{$nombre}%");
        });
    }

    /**
     * Scope para filtrar por cargo
     */
    public function scopeBuscarPorCargo($query, $cargo)
    {
        return $query->where('cargo', 'like', "%{$cargo}%");
    }
    /**
 * Get nombre completo con abreviatura
 *
 * @return string
 */
public function getNombreConAbreviaturaAttribute()
{
    $nombre = $this->nombre_completo;
    
    if ($this->abreviatura) {
        $nombre = $this->abreviatura->abreviatura . ' ' . $nombre;
    }
    
    return $nombre;
}
public function directivo()
    {
        return $this->belongsTo(Directivo::class, 'id_directivo', 'id_directivo');
    }
}