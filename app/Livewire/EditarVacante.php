<?php

namespace App\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    public $id;
    public $titulo;
    public $empresa;
    public $categoria;
    public $descripcion;
    public $salario;
    public $ultimo_dia;
    public $imagen;
    public $imagen_nueva;

    use WithFileUploads;


    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'categoria' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024',

    ];

    public function mount(Vacante $vacante)
    {
        $this->id=$vacante->id;
        $this->titulo = $vacante->titulo;
        $this->empresa = $vacante->empresa;
        $this->categoria = $vacante->categoria_id;
        $this->descripcion = $vacante->descripcion;
        $this->salario = $vacante->salario_id;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->imagen = $vacante->imagen;

    }

    public function editarVacante()
    {
        $datos = $this->validate();

        if($this->imagen_nueva){
            $imagen =$this->imagen_nueva->store('public/vacantes/');
            $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        }



        $vacante = Vacante::find($this->id);

        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        $vacante->save();

        session()->flash('mensaje', 'La vacante se actualizó correctamente');

        return redirect()->route('dashboard');
    }



    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.editar-vacante', 
        ['salarios' => $salarios,
        'categorias'=>$categorias]);
        }
}
