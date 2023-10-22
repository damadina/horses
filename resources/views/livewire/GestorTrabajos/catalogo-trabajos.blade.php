<div>
   <h1 class="text-2xl p-4 font-bold">CÁTALOGO DE TRABAJOS</h1>

   <hr class="mt-2 mb-6">
   <button class="btn btn-primary m-4" wire:click="openModal">Nuevo trabajo</button>
    <div class="mx-4 mb-2">
        <input wire:keydown="limpiar_page" wire:model='search' class="form-input w-full" placeholder="¿Qué estás buscando?">
    </div>

    @foreach ($tiposTrabajo as $each )
        <article>
            <div class="card-body bg-gray-100">

                @if ($trabajo->id == $each->id)
                    <form wire:submit.prevent="update">
                        <div class="flex">
                            <input wire:model='trabajo.title' class="w-4/6 form-input " placeholder="nombre del trabajo">

                            <div class="ml-4 flex-1">
                                <select wire:model="horas" class="selectHoras">
                                <option value="0">Horas</option>
                                <option value=3600 @if($trabajo->horas == 3600) selected @endif >1 hora</option>
                                <option value=7200 @if($trabajo->horas == 7200) selected @endif>2 horas</option>
                                <option value="10800" @if($trabajo->horas == 10800) selected @endif>3 horas</option>
                                <option value="14400" @if($trabajo->horas == 14400) selected @endif>4 horas</option>
                                <option value="18000" @if($trabajo->horas == 18000) selected @endif>5 horas</option>
                                <option value="21600" @if($trabajo->horas == 21600) selected @endif>6 horas</option>
                                <option value="25200" @if($trabajo->horas == 25200) selected @endif>7 horas</option>
                                <option value="28800" @if($trabajo->horas == 28800) selected @endif>8 horas</option>
                                </select>
                                <select wire:model="minutos" class="ml-4" wire:model="minutos">
                                    <option value="0">Minutos</option>
                                    <option value="900" @if($trabajo->minutos == 900) selected @endif >15 minutos</option>
                                    <option value="1800" @if($trabajo->minutos == 1800) selected @endif>30 minutos</option>
                                    <option value="2700" @if($trabajo->minutos == 2700) selected @endif>45 minutos</option>
                                </select>
                                <input type="text" wire:model="tiempoEstimado" hidden>
                                @error('tiempoEstimado')
                                <span class="text-xs text-red-500">{{$message}}</span>
                        @enderror
                            </div>

                        </div>

                        <div>
                            @error('trabajo.title')
                                <span class="text-xs text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="button" class="btn btn-danger" wire:click="cancelUpdate">Cancelar</button>
                        </div>

                    </form>
                @else
                    <header class="flex justify-between items-center">

                        <h1 class="w-4/6 cursor-pointer text-xl">{{$each->title}}</h1>
                        <div class="flex-1">
                            <select disabled   class="selectHoras" class="">
                                <option value="0">Horas</option>
                                <option value=3600 @if($each->horas == 3600) selected @endif >1 hora</option>
                                <option value=7200 @if($each->horas == 7200) selected @endif>2 horas</option>
                                <option value="10800" @if($each->horas == 10800) selected @endif>3 horas</option>
                                <option value="14400" @if($each->horas == 14400) selected @endif>4 horas</option>
                                <option value="18000" @if($each->horas == 18000) selected @endif>5 horas</option>
                                <option value="21600" @if($each->horas == 21600) selected @endif>6 horas</option>
                                <option value="25200" @if($each->horas == 25200) selected @endif>7 horas</option>
                                <option value="28800" @if($each->horas == 28800) selected @endif>8 horas</option>
                            </select>
                            <select disabled  class="ml-2">
                                <option value="0">Minutos</option>
                                <option value="900" @if($each->minutos == 900) selected @endif >15 minutos</option>
                                <option value="1800" @if($each->minutos == 1800) selected @endif>30 minutos</option>
                                <option value="2700" @if($each->minutos == 2700) selected @endif>45 minutos</option>
                            </select>

                        </div>
                        <div>
                            <i class="cursor-pointer text-blue-500 fa-regular fa-pen-to-square" wire:click="edit({{$each}})"></i>
                            <i class="cursor-pointer text-red-500 fa-solid fa-eraser"></i>
                        </div>
                    </header>

                    <div x-data="{abierto:false}">

                        <p class="font-bold">
                            <template  x-if="!abierto">
                                <i class="fa-regular fa-eye mr-2 cursor-pointer text-blue-500" x-on:click="abierto = !abierto" ></i>
                            </template>
                            <template  x-if="abierto">
                                <i class="fa-regular fa-eye-slash mr-2 cursor-pointer text-blue-500" x-on:click="abierto = !abierto" ></i>
                            </template>
                        Recursos formativos</p>

                        <template  x-if="abierto">
                            <div class="rounded border-2 mx-auto mt-4">
                                <!-- Tabs -->
                                <ul id="tabs" class="inline-flex pt-2 px-1 w-full border-b">
                                <li class="bg-white px-4 text-gray-800 font-semibold py-2 rounded-t border-t border-r border-l -mb-px"><a id="default-tab" href="#first">Videos</a></li>
                                <li class="px-4 text-gray-800 font-semibold py-2 rounded-t"><a href="#second">Documentos</a></li>
                                </ul>

                                <!-- Tab Contents -->

                                    <div id="tab-contents">
                                        <div id="first" class="p-4">
                                            @livewire('gestor-trabajos.trabajo-video', ['trabajo' => $each], key('gestor-trabajos.trabajo-video'.$each->id))
                                        </div>
                                        <div id="second" class="hidden p-4">
                                            @livewire('gestor-trabajos.trabajo-recurso', ['trabajo' => $each], key('gestor-trabajos.trabajo-recurso'.$each->id))
                                        </div>
                                    </div>
                            </div>
                        </template>
                    </div>

                    {{-- <div x-data="{abierto:false}">
                        <p class="cursor-pointer my-1 font-bold" x-on:click="abierto = !abierto" >Recursos</p>
                        <div x-show="abierto">
                            <div class="ml-4 px-4 bg-gray-200" x-data="{open:false}">
                                <h2 class="cursor-pointer py-2" x-on:click="open = !open">Videos Formativos</h2>
                                <div x-show="open">
                                    @livewire('gestor-trabajos.trabajo-video', ['trabajo' => $each], key('gestor-trabajos.trabajo-video'.$each->id))
                                </div>
                            </div>

                            <div class=" mt-2 ml-4 px-4 bg-gray-200" x-data="{open:false}">
                                <h2 class="cursor-pointer py-2" x-on:click="open = !open">Manuales instrucciones (pdf)</h2>
                                <div x-show="open">
                                    @livewire('gestor-trabajos.trabajo-recurso', ['trabajo' => $each], key('gestor-trabajos.trabajo-recurso'.$each->id))
                                </div>
                            </div>
                        </div>
                    </div> --}}
                @endif

            </div>
        </article>
    @endforeach

    <x-dialog-modal wire:model='modalOn'>
        <x-slot name="title">
            Nueva trabajo
        </x-slot>
        <x-slot name="content">
            <div class="mb-2">
                <x-label value="Nombre del trabajo" class="text-red-800"/>
                <x-input type="text" class="w-full" wire:model="title"/>
                <x-input-error for="title"/>
            </div>
            <div>
                <x-label value="Tiempo estimado" class="text-red-800"/>
                <select wire:model="horas" class="selectHoras" class="">
                    <option value="0">Horas</option>
                    <option value=3600>1 hora</option>
                    <option value=7200>2 horas</option>
                    <option value="10800">3 horas</option>
                    <option value="14400">4 horas</option>
                    <option value="18000">5 horas</option>
                    <option value="21600">6 horas</option>
                    <option value="25200">7 horas</option>
                    <option value="28800">8 horas</option>
                </select>
                <select wire:model="minutos" class="ml-2">
                    <option value="0">Minutos</option>
                    <option value="900">15 minutos</option>
                    <option value="1800">30 minutos</option>
                    <option value="2700">45 minutos</option>
                </select>
            </div>
            <x-input type="text" hidden  wire:model="tiempoEstimado"/>
            <x-input-error for="tiempoEstimado"/>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('modalOn',false)">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-4" wire:click="saveTrabajo" wire:laoding.attr="disabled" class="disabled:opacity-25">
                Crear trabajo
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>



    {{-- <div x-data="{open:false}">
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

    </div> --}}

    <div class="m-4">
        {{$tiposTrabajo->links()}}
    </div>

</div>
