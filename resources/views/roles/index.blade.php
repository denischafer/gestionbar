@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Puesto</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                           @can('crear-puestos')
                           <a class='btn btn-warning' href='{{ route('roles.create') }}'>Nuevo Puesto</a>
                           @endcan

                           <table class='table table-striped mt-2'>

                            <thead class='bg-primary'>
                                <th class='text-white d-none'>Id</th>
                                <th class='text-white'>Puesto</th>
                                <th class='text-white'></th>
                            </thead>
                            <tbody>
                                @foreach($roles as $rol)
                                <tr>
                                    <td class='d-none'>{{ $rol->id }}</td>
                                    <td>{{ $rol->name }}</td>
                                    <td class='text-right'>
                                        @can('edit-puestos')
                                        <a class='btn btn-success' href='{{ route('roles.edit',$rol->id) }}'>Editar</a>
                                        @endcan

                                        @can('borrar-puestos')
                                            {!! Form::open(['method'=>'DELETE', 'route'=>['roles.destroy', $rol->id], 'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class='pagination justify-content-end'>
                            {!! $roles->links() !!}
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

