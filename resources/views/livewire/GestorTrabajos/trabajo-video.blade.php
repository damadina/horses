<div>

    @if($trabajo->videos->count()>0)
        @foreach ($trabajo->videos as $each )

        <article class="card mt-4">
                <div class="card-body">
                    @if ($tutorial->id == $each->id)
                        <form wire:submit.prevent="update">
                            <div class="flex items-center">
                                <label class="w-32">Nombre:</label>
                                <input wire:model = "tutorial.title" class=" flex-1 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('tutorial.title')
                                <span class="text-sm text-red-500">{{$message}}</span>
                            @enderror

                            <div class="flex items-center mt-4">
                                <label class="w-32">Plataforma:</label>
                                <select wire:model="tutorial.platform_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                    @foreach ($platforms as $platform )
                                        <option value="{{$platform->id}}">{{$platform->title}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="flex items-center mt-2">
                                <label class="w-32">URL:</label>
                                <input wire:model = "tutorial.url" class=" flex-1 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('tutorial.url')
                                <span class="text-sm text-red-500">{{$message}}</span>
                            @enderror

                            <div class="mt-4 flex justify-end">
                                <button type="button" class="btn btn-danger"  wire:click="cancel">Cancelar</button>
                                <button type="submit" class="btn btn-primary ml-2">Actualizar</button>
                            </div>


                        </form>

                    @else
                        <header>
                            <h1><i class="fa-solid fa-circle-play text-blue-500 mr-1"></i>Video formativo: {{$each->title}} </h1>
                        </header>
                        <div>
                            <hr class="my-2">
                            <p class="text-sm">Plataforma:{{$each->platform->title}}</p>
                            <p class="text-sm">Enlace: <a class="text-blue-600" href="{{$each->url}}" target="_blank">{{$each->url}}</a> </p>
                            <div class="mt-2">
                                <button class="btn btn-primary text-sm" wire:click="edit({{$each}})">Editar</button>
                                <button class="btn btn-danger text-sm" wire:click="destroy({{$each}})">Eliminar</button>
                            </div>
                        </div>
                    @endif
                </div>


        </article>

        @endforeach
    @else
        jjjjjjjjjjjjjjj
    @endif

    <div class="mt-4" x-data="{open:false}">
        <a x-show="!open" x-on:click="open = true" class="flex items-center cursor-pointer">
            <i class="fa-regular fa-square-plus text-2xl text-red-500 mr-2"></i>
            Agregar nuevo video
        </a>
        <article class="card" x-show="open">
            <div class="card-body">
                <h1 class="text-xl font-bold mb-4">Agregar nuevo vídeo</h1>
                <div class="mb-4">
                    <div class="flex items-center">
                        <label class="w-32">Nombre:</label>
                        <input wire:model = "title" class=" flex-1 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('title')
                        <span class="text-sm text-red-500">{{$message}}</span>
                    @enderror

                    <div class="flex items-center mt-4">
                        <label class="w-32">Plataforma:</label>
                        <select wire:model="platform_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            @foreach ($platforms as $platform )
                                <option value="{{$platform->id}}">{{$platform->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('platform_id')
                        <span class="text-sm text-red-500">{{$message}}</span>
                    @enderror

                    <div class="flex items-center mt-2">
                        <label class="w-32">URL:</label>
                        <input wire:model = "url" class=" flex-1 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error('url')
                        <span class="text-sm text-red-500">{{$message}}</span>
                    @enderror
                    <div class="mt-4 flex justify-end">
                        <button class="btn btn-danger"  x-on:click="open = false">Cancelar</button>
                        <button class="btn btn-primary ml-2" wire:click="store">Actualizar</button>
                    </div>

                </div>
            </div>

        </article>

    </div>
    <script>
        let tabsContainer = document.querySelector("#tabs");

        let tabTogglers = tabsContainer.querySelectorAll("#tabs a");

        console.log(tabTogglers);

        tabTogglers.forEach(function(toggler) {
        toggler.addEventListener("click", function(e) {
            e.preventDefault();

            let tabName = this.getAttribute("href");

            let tabContents = document.querySelector("#tab-contents");

            for (let i = 0; i < tabContents.children.length; i++) {

            tabTogglers[i].parentElement.classList.remove("border-t", "border-r", "border-l", "-mb-px", "bg-white");  tabContents.children[i].classList.remove("hidden");
            if ("#" + tabContents.children[i].id === tabName) {
                continue;
            }
            tabContents.children[i].classList.add("hidden");

            }
            e.target.parentElement.classList.add("border-t", "border-r", "border-l", "-mb-px", "bg-white");
        });
        });

    </script>
</div>
