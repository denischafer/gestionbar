@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Producto</h3>
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

                            {!! Form::open(array('route'=>'products.store','method'=>'POST')) !!}
                                    <div class='row'>

                                        <!--Nombre-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for='name'>Nombre</label>
                                                {!! Form::text('name',null,array('class'=>'form-control')) !!}
                                            </div>
                                        </div>

                                        <!--Detalle-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for='comment'>Detalle</label>
                                                {!! Form::text('comment',null,array('class'=>'form-control')) !!}
                                            </div>
                                        </div>

                                        <!--Email-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for='amount'>Valor</label>
                                                {!! Form::text('amount', null, array('class'=>'form-control') ); !!}
                                            </div>
                                        </div>

                                        <!--Categoría-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for=''>Categoría</label>
                                                {!! Form::select('categorie_id',$categories,[],array('class'=>'form-control')) !!}
                                            </div>
                                        </div>

                                        <!--Estado-->
                                        <div class='col-xs-12 col-sm-12 col-md-12'>
                                            <div class='form-group'>
                                                <label for=''>Estado</label>
                                                {!! Form::select('status_id',$statuses,[],array('class'=>'form-control')) !!}
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

