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
        body {
            color: #424242;
        }

        h1 {
            font-size: 1.7em;
            margin: 20px;
        }

        .group {
            position: relative;
            margin: 30px 20px 50px;
        }

        input {
            color: #424242;
            font-size: 1.2em;
            padding: 10px 10px 5px 5px;
            display: block;
            width: 300px;
            border: none;
            border-bottom: 1px solid #607D8B;
        }
        input:focus {
            outline: none;
        }

        label.input-label {
            color: #616161;
            position: absolute;
        }

        input:focus ~ label.input-label {
            color: #0288D1;
        }

        input[readonly] ~ label.input-label {
            top: -15px;
            font-size: 0.9em;
        }

        .bar {
            position: relative;
            display: block;
            width: 315px;
        }

        .bar:before,
        .bar:after {
            background: #0288D1;
            content: '';
            height: 2px;
            width: 0;
            bottom: 1px;
            position: absolute;
            transition: 0.2s ease all;
            -moz-transition: 0.2s ease all;
            -webkit-transition: 0.2s ease all;
        }

        .bar:before {
            left: 50%;
        }

        .bar:after {
            right: 50%;
        }

        input:focus ~ .bar:before,
        input:focus ~ .bar:after {
            width: 50%;
        }

    </style>
    <style>
        .iconoAction:hover {
            cursor: pointer;
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

            inicializaPikerDate();

            Livewire.on('inicializaDatePiker', () => {
                inicializaPikerDate();
            });


            function inicializaPikerDate() {
               flatpickr("#rangeDate",{
                    locale: "es",
                    mode: 'range',
                    dateFormat: "d-m-Y",
                    /*
                    onChange: function(selectedDates, dateStr, instance) {
                       //console.log(selectedDates);
                       //console.log(dateStr);
                       console.log(instance.element.dataset.key);
                    },
                    */
                    console.log("PPPPPPPPPPPP");




                    onChange: ([start, end],dateStr,instance) => {

                        //const $this = $(this);
                        //const dataVal = $this.find(':selected').data('key');
                        //console.log(dataVal);
                        //const itemId = bb.dataset.key;

                        if (start && end) {

                            //console.log(dateStr);
                            //const element = document.getElementById("rangeDate")
                            //const element = document.querySelector("#rangeDate");
                            //console.log(element);

                            //startConv = start.toLocaleDateString("es-ES");
                            //endConv = end.toLocaleDateString("es-ES");
                            key = instance.element.dataset.key;
                            Livewire.emit('changeRange',dateStr,key)

                        }

                    }

                    //defaultDate: ["10-10-2023", "20-10-2023"]
                });
            }

        });
    </script>

@stop




