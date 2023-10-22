<div>
    <div class="container">

        @foreach ($jornadas as $jornada )

            <div class="card mt-4">
                <div class="card-title">{{$jornada->FechaHumana}}</div>

                <div class="card-body">
                    @foreach ($jornada->trabajosporEmpleado as $trabajo )
                        @if ($empleadoActual != $trabajo->UserName)
                            <div class="text-xl font-semibold">{{$trabajo->UserName}}</div>
                            @php
                                $empleadoActual = $trabajo->UserName;
                            @endphp
                        @endif
                        <div>{{$trabajo->title}}</div>
                        <div>{{$trabajo->description}}</div>
                    @endforeach
                </div>
            </div>




        @endforeach
        <div class="py-6 px-4">
            {{$jornadas->links()}}
        </div>

    </div>

</div>
{{-- <x-dialog-modal wire:model='modalInfo'>
        <x-slot name="title">
            DDDDDDDD
        </x-slot>
        <x-slot name="content">
            <div>{!!$info!!}</div>

        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeModoalInfo">
                Ok
            </x-secondary-button>

        </x-slot>

    </x-dialog-modal> --}}

    {{-- <x-tableresponsive>
        <table class="min-w-full text-left text-sm font-light">
        <thead
            class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
            <tr>
            <th scope="col" class="px-6 py-4">#</th>
            <th scope="col" class="px-6 py-4">Empleado</th>
            <th scope="col" class="px-6 py-4">Tarea</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eachParte->tareas as $eachTarea )
                <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700">
                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{$eachTarea->id}}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{$eachTarea->user->name}}</td>
                    <td class="whitespace-nowrap px-6 py-4">{{$eachTarea->title}}</td>

                </tr>
            @endforeach
        </tbody>
        </table>
    </x-tableresponsive> --}}
    {{-- @foreach ($trabajos as $eachTrabajo )
            <div class="card mt-6">
                <div class="card-body">
                    <div class="card-title">
                        <div >{{$eachTrabajo->fecha}}  {{$eachTrabajo->title}}</div>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
        @endforeach --}}




        {{-- @foreach ($trabajos as $eachTrabajo )
        @if($fecha != $eachTrabajo->fecha)
            <div>{{$eachTrabajo->fecha}}</div>
            @php
                $fecha = $eachTrabajo->fecha;
            @endphp
        @endif

        <div class="card mt-6">
            <div class="card-body">
                <div class="card-title">
                    <div >{{$eachTrabajo->title}} {{$eachTrabajo->fecha}}</div>
                </div>
                <div>
                    {{$eachTrabajo->description}}
                </div>
            </div>
        </div>
    @endforeach --}}


    {{-- @foreach ($trabajos as $eachTrabajo )
    @if ($fecha != $eachTrabajo->FechaHumana)
        @php
            $fecha = $eachTrabajo->FechaHumana
        @endphp
        <div class="mt-4 card-title bg-gray-500 text-white">{{$fecha}}</div>
        <div class="card">
            <div class="card-body">

               <x-tableresponsive>
                    <table class="min-w-full text-left text-sm font-light">
                    <thead
                        class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                        <tr>
                        <th scope="col" class="px-6 py-4">#</th>
                        <th scope="col" class="px-6 py-4">Empleado</th>
                        <th scope="col" class="px-6 py-4">Tarea</th>
                        </tr>
                    </thead>
                    <tbody>

                            <tr class="border-b bg-neutral-100 dark:border-neutral-500 dark:bg-neutral-700">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{$eachTrabajo->id}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$eachTrabajo->UserName}}</td>


                            </tr>

                    </tbody>
                    </table>
                </x-tableresponsive>

            </div>
        </div>



    @endif
    @endforeach --}}
