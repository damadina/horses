<div>
   <h1 class="text-2xl p-4 font-bold">CÁTALOGO DE TRABAJOS</h1>

   <hr class="mt-2 mb-6">

    <div class="mx-4 mb-2">
        <input wire:keydown="limpiar_page" wire:model='search' class="form-input w-full" placeholder="¿Qué estás buscando?">
    </div>

    @foreach ($tiposTrabajo as $each )
        <article>
            <div class="card-body bg-gray-100">
                @if ($trabajo->id == $each->id)
                    <form wire:submit.prevent="update">
                        <input wire:model='trabajo.title' class="form-input w-full" placeholder="nombre del trabajo">
                        @error('trabajo.title')
                            <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                    </form>
                @else
                    <header class="flex justify-between items-center">

                        <h1 class="flex-1 cursor-pointer text-xl"><strong>Trabajo: </strong>{{$each->title}}</h1>

                        <div>
                            <i class="cursor-pointer text-blue-500 fa-regular fa-pen-to-square" wire:click="edit({{$each}})"></i>
                            <i class="cursor-pointer text-red-500 fa-solid fa-eraser"></i>
                        </div>
                    </header>
                @endif
            </div>
        </article>

    @endforeach
    <div x-data="{open:false}">
        <a x-show="!open"   x-on:click="open=true"  class="flex items-center cursor-pointer ml-4 mb-6">
            <i class="mr-2 text-red-500 text-2xl fa-regular fa-square-plus"></i>
            Agregar nuevo trabajo al catálogo
        </a>
        <article class="card" x-show='open'>
            <div class="card-body bg-gray-100">
                <h1 class="text-xl font-bold mb-4">Agregar nuevo trabajo</h1>
                <div class="mb-4">
                    <input wire:model="title" class="form-input w-full" placeholder="Escriba el nombre del nuevo trabajo">
                    @error('title')
                        <span class="text-xs text-red-500">{{$message}}</span>
                    @enderror


                </div>
                <div class="flex justify-end">
                    <button x-on:click="open = false"  class="btn btn-danger">Cancelar</button>
                    <button class="btn btn-primary ml-2" wire:click="store">Agregar</button>
                </div>
            </div>
        </article>

    </div>

    <div>
        {{$tiposTrabajo->links()}}
    </div>

</div>
