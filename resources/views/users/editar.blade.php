@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar operador</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class='alert alert-dark alert-dismissible fade show' role='alert'>
                                    <strong>Error en el formulario</strong>
                                        @foreach ( $errors->all() as $error )
                                            <span class='badge badge-danger'>{{ $error }}</span>
                                        @endforeach
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                </div>
                            @endif

                            {!! Form::model($user, ['method'=>'PUT','route'=>['users.update', $user->id]]) !!}
                                    <div class='row'>

                                        <!--Nombre-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for='name'>Nombre</label>
                                                {!! Form::text('name',null,array('class'=>'form-control')) !!}
                                            </div>
                                        </div>

                                        <!--Email-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for='email'>E-mail</label>
                                                {!! Form::text('email',null,array('class'=>'form-control')) !!}
                                            </div>
                                        </div>

                                        <!--Password-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for='password'>Contraseña</label>
                                                {!! Form::password('password', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <!--Confirm-Password-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for='confirm-password'>Confirmar Contraseña</label>
                                                {!! Form::password('confirm-password', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <!--Roles-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for=''>Roles</label>
                                                {!! Form::select('roles[]',$roles,[],array('class'=>'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <button type='submit' class='btn btn-primary'>Guardar</button>
                                        </div>

                                    </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

