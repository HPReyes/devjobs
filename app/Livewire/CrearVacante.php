<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    
    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'categoria' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',

    ];

    public function crearVacante()
    {
        $datos = $this->validate();
    }

    public function render()
    {
        //consultar la bbdd

        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', 
    ['salarios' => $salarios,
    'categorias'=>$categorias]);
    }
}