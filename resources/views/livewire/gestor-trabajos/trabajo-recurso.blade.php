<div>

    @if($trabajo->recursos->count()>0)
        @foreach ($trabajo->recursos as $each )

        <article class="card mt-4">
                <div class="card-body py-2 mb-0">
                    <header>
                        <div class="flex items-center">
                            <h1 class="flex-1"><i wire:click="download({{$each}})" class="fa-solid fa-download text-gray-500 mr-2 cursor-pointer"></i></i>{{$each->title}} </h1>
                            <i wire:click="destroy({{$each}})" class="fa-solid fa-trash text-red-500 cursor-pointer"></i>
                        </div>
                    </header>
                </div>


        </article>

        @endforeach
    @else
        jjjjjjjjjjjjjjj
    @endif

    <div class="mt-4" x-data="{open:false}">
        <a x-show="!open" x-on:click="open = true" class="flex items-center cursor-pointer">
            <i class="fa-regular fa-square-plus text-2xl text-red-500 mr-2"></i>
            Agregar nuevo recurso
        </a>
        <article class="card" x-show="open">
            <div class="card-body">
                <h1 class="text-xl font-bold mb-4">Agregar un nuevo recurso</h1>
                <form class="mb-4" wire:submit.prevent="save">
                    <div class="flex items-center">
                        <label class="w-32">Nombre:</label>
                        <input wire:model = "title" class=" flex-1 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('title')
                        <span class="text-sm text-red-500">{{$message}}</span>
                    @enderror

                    <div class="flex items-center mt-2 mb-2">
                        <input wire:model="file" type="file" class="flex-1 form-input">
                    </div>
                    <div class="text-blue-500 font-bold mt-1">
                        Cargando ...
                    </div>


                    @error('file')
                        <span class="text-sm text-red-500">{{$message}}</span>
                    @enderror
                    <div>
                        <button class="btn btn-danger"  x-on:click="open = false">Cancelar</button>
                        <button class="btn btn-primary ml-2">Guardar</button>
                    </div>

                </form>
            </div>

        </article>

    </div>






</div>
