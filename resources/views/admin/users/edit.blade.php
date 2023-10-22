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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


    <script
    src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
    crossorigin="anonymous">
    </script>





    <script>

        document.addEventListener('livewire:load', function(){

            var minDate = new Date(new Date().getFullYear(), 0, 1);
            var masDate = new Date(new Date().getFullYear(), 11, 31);
            var diasDisabled=[];
            DiasInicializa();

            function DiasInicializa() {

                var elementos = document.querySelectorAll('.rangeDate');

                elementos.forEach(function(element) {

                    if(element.value!=['']) {
                        valores = changeDateFormat(element.value)
                        var dias = getDates(valores['desde'],valores['hasta']);
                        diasDisabled = diasDisabled.concat(dias);
                    }
                    Livewire.emit('actualizaDiasVacaciones',diasDisabled.length);
                });

                elementos.forEach(function(element) {
                    inicializa(element);
                });
            }

            function changeDateFormat(valor) {
                var myArray = valor.split(" a ");

                var dateParte = myArray[0].split('-');
                var desde=dateParte[2]+'-'+dateParte[1]+'-'+dateParte[0];
                var dateParte = myArray[1].split('-');
                var hasta=dateParte[2]+'-'+dateParte[1]+'-'+dateParte[0];
                return {'desde': desde,
                        'hasta': hasta};
            }




            Livewire.on('nuevoDatePiker', () => {
                DiasInicializa();

            });




            function inicializa(element) {
                if (element.value != "") {
                    valores = changeDateFormat(element.value)
                    var dias = getDates(valores['desde'],valores['hasta']);
                    dias.forEach(dia => {
                        var index = diasDisabled.indexOf(dia);
                        if (index > -1) {
                            diasDisabled.splice(index, 1);
                        }
                    });

                }

                flatpickr(element, {
                    locale: "es",
                    mode: 'range',
                    dateFormat: "d-m-Y",
                    maxDate: masDate,
                    minDate: minDate,
                    disable: diasDisabled,
                    allowInput:false,
                    onChange: ([start, end],dateStr,instance) => {
                        if(dateStr=="") {
                            key = instance.element.dataset.key;
                            Livewire.emit('clickTrash',key)
                        }

                        if (start && end) {
                            var day = start.getDate();
                            var month = start.getMonth()+1;
                            var year = start.getFullYear();
                            let fechaInicio = year + "/" + month + "/" + day;

                            day = end.getDate();
                            month = end.getMonth()+1;
                            year = end.getFullYear();
                            let fechaFin = year + "/" + month + "/" + day;

                            key = instance.element.dataset.key;
                            Livewire.emit('changeRange',dateStr,key,fechaInicio,fechaFin)
                        }
                    }
                });
            }

            function getDates(startDate, stopDate) {
                var dateArray = [];
                var currentDate = moment(startDate);
                var stopDate = moment(stopDate);
                while (currentDate <= stopDate) {
                    dateArray.push( moment(currentDate).format('DD-MM-YYYY') )
                    currentDate = moment(currentDate).add(1, 'days');
                }
                return dateArray;
            }


        });



    </script>

@stop



