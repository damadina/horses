<div>
    @if(session()->has('info'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Enhorabuena!</strong> {{ session()->get('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>


    @endif


    <div class="card">

        <div class="card-header">
            <input wire:keydown="limpiar_page" wire:model='search' class="form-control w-100" placeholder="¿Qué estás buscando?">
        </div>
        @if($users->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo de Usuario</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user )
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td width="10px">
                                    @php
                                        $tiene = "NO";
                                        if($user->empleado) {
                                            if($user->empleado->vacaciones) {
                                                $tiene ="SI";
                                            }
                                        }
                                    @endphp
                                    <div class="select">
                                    <select wire:change="changeSelect($event.target.value,{{$user}})" class="  form-select form-select-lg mb-3">
                                        <option value="1" @if($user->userType==1) selected @endif >Invitado</option>
                                        <option value="2" @if($user->userType==2) selected @endif>Empleado</option>
                                    </select>
                                    </div>


                                </td>
                                <td width="10px" >
                                    @if($user->userType==2)
                                        <a class="btn btn-primary btn-sm" href="{{route('admin.users.edit',$user)}}">Edit</a>
                                    @endIf
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$users->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No hemos encontrado ningún registro coincidente</strong>
            </div>
        @endif
    </div>

</div>
