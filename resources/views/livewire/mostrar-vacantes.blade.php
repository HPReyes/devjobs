<div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante)
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">
                        {{ $vacante->titulo }}

                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>
                <div class="flex flex-col md:flex-row gap-3 items-streech mt-5 md:mt-0">
                    <a href="{{route('candidatos.index' ,$vacante)}}"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        {{$vacante->candidato->count()}}
                        @choice('Notificación|Notificaciones', $vacante->candidato->count())
                    </a>

                    <a href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="bg-blue-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        Editar
                    </a>

                    <button 
                    wire:click="$dispatch('mostrarAlerta',{ vacante: {{ $vacante->id }} })"
                    class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                >Eliminar</button>
                </div>
            </div>

        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>


</div>
@push('scripts')
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('mostrarAlerta', vacante => {
                Swal.fire({
                    title: '¿Seguro?',
                    text: "¡No podrás revertirlo!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('eliminarVacante',[vacante]);
 
                        Swal.fire(
                            '¡Borrado!',
                            'Tu vacante ha sido eliminada.',
                            'success'
                        )
                    }
                });
       });
    });
    </script>
@endpush
