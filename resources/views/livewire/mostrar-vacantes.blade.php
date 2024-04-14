<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    @forelse ($vacantes as $vacante)
        <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                    {{ $vacante->titulo }}
                </a>
                <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                <p class="text-sm text-gray-500">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                <p class="text-sm text-gray-500">Categoría: {{ $vacante->categoria->categoria }}</p>
                <p class="text-sm text-gray-500">Salario: {{ $vacante->salario->salario }}</p>
            </div>
            <div class="flex flex-col md:flex-row gap-3 items-stretch mt-5 md:mt-0">
                <a href="{{ route('candidatos.index', $vacante) }}"
                    class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    {{ $vacante->candidatos->count() }}
                    Candidatos
                </a>
                <a href="{{ route('vacantes.edit', $vacante->id) }}"
                    class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Editar
                </a>
                <button wire:click='$emit("alertaEliminar", {{ $vacante->id }})'
                    class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Eliminar
                </button>
            </div>
        </div>
    @empty
        <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>
    @endforelse
    <div class="flex  mt-10">
        {{ $vacantes->links() }}
    </div>
</div>
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('alertaEliminar', (vacanteId) => {
            Swal.fire({
                title: '¿Eliminar Vacante?',
                text: "Una Vacante Eliminada no se puede Recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    //Eliminar la vacante
                    Livewire.emit('eliminarVacante', vacanteId);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu Vacante Ha Sido Eliminada',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
