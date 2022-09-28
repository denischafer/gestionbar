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
                           @can('crear-productos')
                           <a class='btn btn-warning' href='{{ route('products.create') }}'>Agregar Producto</a>
                           @endcan

                           <table class='table table-striped mt-2'>
                           <thead class='bg-primary'>
                                <th class='text-white d-none'>Id</th>
                                <th class='text-white'>Nombre</th>
                                <th class='text-white'>Comentario</th>
                                <th class='text-white'>Valor</th>
                                <th class='text-white'>Categoría</th>
                                <th class='text-white'>Estado</th>
                                <th class='text-white'></th>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td class='d-none'>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->comment }}</td>
                                    <td>{{ $product->amount }}</td>
                                    <td>{{ $product->categorie_name }}</td>
                                    <td>{{ $product->status_name }}</td>
                                    <td class='text-right'>
                                        @can('editar-productos')
                                        <a class='btn btn-success' href='{{ route('products.edit',$product->id) }}'>Editar</a>
                                        @endcan

                                        @can('borrar-productos')
                                            {!! Form::open(['method'=>'DELETE', 'route'=>['products.destroy', $product->id], 'style'=>'display:inline']) !!}
                                                {!! Form::submit('Borrar', ['class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        <div class='pagination justify-content-end'>
                            {!! $products_page->links() !!}
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

