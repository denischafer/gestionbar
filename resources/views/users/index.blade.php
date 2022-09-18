@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Operadores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a class='btn btn-warning' href='{{ route('users.create') }}'>Nuevo Operador</a>

                            <table class='table table-striped mt-2'>

                                <thead class='bg-primary'>
                                    <th class='text-white d-none'>Id</th>
                                    <th class='text-white'>Nombre</th>
                                    <th class='text-white'>E-mail</th>
                                    <th class='text-white'>Puesto</th>
                                    <th class='text-white'></th>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class='d-none'>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach( $user->getRoleNames() as $rolName)
                                                    {{ $rolName }}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class='text-right'>
                                            <a class='btn btn-success' href='{{ route('users.edit',$user->id) }}'>Editar</a>
                                            {!! Form::open(['method'=>'DELETE', 'route'=>['users.destroy', $user->id], 'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <div class='pagination justify-content-end'>
                                {!! $user->links !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
