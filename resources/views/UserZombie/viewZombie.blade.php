@extends('layouts.base') <!--para heredar de base-->
@section('title', 'Lista') <!--nombre pagina, nombre de seccion-->
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="cold-md-11">
            <h1 class="text-center mb-5 fw-bold">
                <i class="fas fa-biohazard" style="color: #FFC300;"></i> USUARIOS
            </h1>

            <a class="btn btn-success mb-4 fw-bold" href="{{url('/formUser')}}">
                <i class="fas fa-user-plus fa-2x" style="color:white;"></i>
            </a>

            <div class="col-xl-30">
                <table class="table table-light table-bordered table-hover text-center">
                    <thead style="color: #8B716C; border-color: black">
                    <tr class="text-light" style="background-color: #1A5276;">
                        <th style="background-color: #573278">Foto</th>
                        <th style="background-color: #573278">ID.</th>
                        <th style="background-color: #573278">Nombre</th>
                        <th style="background-color: #573278">Punteo</th>
                        <th style="background-color: #573278">Email</th>
                        <th style="background-color: #573278">Contraseña</th>
                        <th style="background-color: #573278">Fecha de creacion</th>
                        <th style="background-color: #573278">Acciones</th>
                    </tr>
                    </thead>

                    <tbody style="background-color: #E5E8E8">

                    @foreach($user as $users)
                        <tr>
                            <td>
                                <img src="{{ asset('storage').'/'. $users->image}}" class="img-fluid img-thumbnail"  width="50px" high="50px">
                            </td>
                            <td>{{$users->id}}</td>
                            <td>{{$users->name}}</td>
                            <td>{{$users->points}}</td>
                            <td>{{$users->email}}</td>
                            <td>{{$users->password}}</td>
                            <td>{{$users->dateZ}}</td>

                            <td>
                                <div class="btn btn-group">
                                    <a href="{{route('editZom', $users->id)}}" class="btn btn-outline-info mb-2 me-2 m-1" style="border-radius: 20%">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('deleteZom',$users->id)}}" id="{{$users->id}}" method="POST">
                                        @csrf @method('DELETE')

                                        <button type="button" onclick="eliminar({{$users->id}})" class="btn btn-outline-danger mb-2 mr-2 m-1">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>



        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>}

    <!--Mensaje de Guardado-->
    @if(session('usuarioGuardado')=='Guardado')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Usuario Guardado',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    <!--Mensaje de Modificacion-->
    @if(session('usuarioModificado')=='Modificado')
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Empleado Modificado',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    <!--Mensaje de Eliminado-->
    @if(session('usuarioEliminado')=='Eliminado')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'Se elimino exitosamente al empleado',
                'success'
            )
        </script>
    @endif

    <script>
        function eliminar(user){
            Swal.fire({
                title: '¿Esta seguro que desea eliminar al usuario?',
                text: "Si presiona si se eliminara definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(user).submit()
                }
            })
        }
    </script>

@endsection
