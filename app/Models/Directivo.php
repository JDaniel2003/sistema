<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directivo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'directivos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_directivo';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'cargo',
        'id_abreviatura',
        'id_usuario'
    ];

    /**
     * Get the full name attribute.
     *
     * @return string
     */
    public function getNombreCompletoAttribute()
    {
        $nombre = $this->nombres . ' ' . $this->primer_apellido;
        if ($this->segundo_apellido) {
            $nombre .= ' ' . $this->segundo_apellido;
        }
        return $nombre;
    }

    /**
     * Relación con la tabla abreviaturas
     */
    public function abreviatura()
    {
        return $this->belongsTo(Abreviatura::class, 'id_abreviatura', 'id_abreviatura');
    }

    /**
     * Relación con la tabla usuarios
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    /**
     * Scope para filtrar por nombre completo
     */
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
}