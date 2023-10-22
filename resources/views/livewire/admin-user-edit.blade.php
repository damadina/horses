<div>
    <div class="card">
        <div class="card-body">
            <div>
                <p class="h5 pt-2 text-primary font-weight-bold">Roles</p>
                    @foreach ($listaRoles as $role )
                        <div class="form-check">
                            <input wire:model="roles" class="form-check-input" type="checkbox" value="{{$role->id}}" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            {{$role->name}}
                            </label>
                        </div>
                    @endforeach
            </div>
            <div class="mt-4">
                <p class="h5 pt-2 text-primary font-weight-bold">Día libre</p>

                <select class="custom-select w-25" wire:model="diaLibre">
                    <option value="0" selected>Elige un día libre</option>
                    <option value="1">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miércoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                    <option value="6">Sábado</option>
                    <option value="7">Domingo</option>
                </select>
            </div>





            <div  class="mt-4">
                <p class="h5 pt-2 text-primary font-weight-bold">Vacaciones {{$totalDiasVacaciones}} días</p>

                <div class="d-flex flex-wrap panel align-items-center my-auto gap-4 ">

                    @foreach ( $vacaciones as $key => $item )
                        <div  class="d-flex item ">
                            <input autocomplete="off"  data-key="{{$key}}"  value="{{$item['rango']}}" type="text"  id="{{$item['id']}}" class=" form-control w-auto ml-1 rangeDate " placeholder="Selecciona nuevo rango">
                            @if($item['id'] != 9999)
                                <i class="fa-solid fa-trash mx-1 text-danger iconoAction " wire:click="clickTrash({{$key}})"></i>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button type="button" wire:click='actualizar' class="btn btn-danger btn-sm">Actualizar</button>
                    <button type="button" wire:click='cancelar' class="ml-5 btn btn-primary btn-sm">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

