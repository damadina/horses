@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Datos de empleado</h1>
    <p class="mt-2 h3 text-primary">{{$user->name}}<span class="h5">  ({{$user->email}})</span></p>

@stop

@section('content')
    @livewire('admin-user-edit',['user' => $user])
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">




    <style>
        .iconoAction:hover {
            cursor: pointer;
        }

        #boxCalendar {
            /* The box that will responsively resize */
            border: 10px solid #000;
            position: relative;
        }
        #papelera {
            position: absolute;
            top: 25px;
            left: 5px;
            color: #fff;
            font-family: sans-serif;
        }

    </style>

    <style>
        .panel {
            border-radius: 4px;
            padding: 1rem;
            margin-top: 2rem;
        }
        .item {
            border-radius: 4px;
            padding: 0.5rem;
            margin: 0.2rem;
        }


    </style>


@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script src="https://kit.fontawesome.com/839c82ee0b.js" crossorigin="anonymous"></script>



    <script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous"></script>




    <script>



        document.addEventListener('livewire:load', function(){

            Livewire.on('console', () => {
                console.log("holaVaru");
            });

            document.querySelectorAll('.rangeDate').forEach(function(element) {
                inicializa(element);
            });

            Livewire.on('nuevoDatePiker', () => {
                console.log("hola");
                const newElem = document.getElementById('9999');
                console.log("paso 1")
                inicializa(newElem);
                console.log("paso 2");
            });




            function inicializa(element) {

                flatpickr(element, {
                    locale: "es",
                    mode: 'range',
                    dateFormat: "d-m-Y",
                    onChange: ([start, end],dateStr,instance) => {
                        if (start && end) {
                            key = instance.element.dataset.key;
                            Livewire.emit('changeRange',dateStr,key)
                        }

                    }
                });
            }








            Livewire.on('inicializaDatePiker', () => {
                inicializaPikerDate();
            });





            /*
            Livewire.on('nuevoDatePiker', () => {

                const newElem = document.getElementById('9999');
                const fp = flatpickr(newElem, {
                    locale: "es",
                    mode: 'range',
                    dateFormat: "d-m-Y",


                    onChange: ([start, end],dateStr,instance) => {
                        if (start && end) {
                            key = instance.element.dataset.key;
                            Livewire.emit('changeRange',dateStr,key)
                        }

                    }

                });
                console.log("pasooooo");



            });
            */



            function inicializaPikerDate() {
               const todos = flatpickr(".rangeDate",{
                    locale: "es",
                    mode: 'range',
                    dateFormat: "d-m-Y",



                    onChange: ([start, end],dateStr,instance) => {
                        if (start && end) {
                            key = instance.element.dataset.key;
                            console.log("bbbbb");
                            console.log(key);
                            Livewire.emit('changeRange',dateStr,key)

                        }

                    }


                });
                console.log("Total");
                console.log(todos.length);
            }












        });



    </script>

@stop


{{-- disable: [
                        {
                            from: "01-09-2023",
                            to: "05-09-2023"
                        },
                        {
                            from: "20-09-2023",
                            to: "25-09-2023"
                        }
                    ], --}}

