<?php

namespace App\Models;

use App\Models\Salario;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacante extends Model
{
    use HasFactory;

    protected $casts = ['ultimo_dia' => 'date:d-m-Y']; //para convertir el string del último día en fecha
    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function salario()
    {
        return $this->belongsTo(Salario::class);
    }


    public function candidato()
    {
        return $this->hasMany(Candidato::class)->orderByDesc('created_at');
    }


    public function reclutador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
