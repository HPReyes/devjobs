<?php

namespace App\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
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

        //almacenar la imagen
        $imagen = $this->imagen->store('public/vacantes');
        $nombre_imagen = str_replace('public/vacantes/', '', $imagen);

        //crear la vacante llamando al modelo

        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $nombre_imagen,
            'user_id' => auth()->user()->id,
        ]);

        //crear un mensaje
       session()->flash('mensaje', 'La vacante se publicó correctamente.');

        //redireccionar
        return redirect()->route('dashboard');
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
