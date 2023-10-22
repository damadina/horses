@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de roles</h1>
@stop

@section('content')
    @if(session('info'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Enhorabuena  </strong> {{session('info')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.roles.create')}}">Crear rol</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th class="colspan-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td colspan="4">{{$role->name}}</td>
                            <td width="10px">
                                <a class="btn btn-primary" href="{{route('admin.roles.edit',$role)}}">Edit</a>
                            </td>
                            <td width="10px">
                                <form action="{{route('admin.roles.destroy',$role)}}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4">No hay ningún rol creado</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
