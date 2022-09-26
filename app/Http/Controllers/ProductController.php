<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Status;


class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-productos|crear-productos|editar-productos|borrar-productos', ['only' => ['index']]);
        $this->middleware('permission:crear-productos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-productos', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-productos', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);

        //$products = Product::all();

        $products = $products->map( function( $product ){

            foreach ($product as $prod) {

                $name_categorie=Categorie::where('id',$product->categorie_id)->get()->pluck('name');
                $name_status=Status::where('id',$product->status_id)->get()->pluck('name');

                $product->categorie_name = $name_categorie[0];

                $product->status_name = $name_status[0];
            }

            return $product;
        });

        $products_page = Product::paginate(5);

        return view('products.index',compact('products','products_page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=Categorie::pluck('name','id')->toArray();
        $statuses=Status::pluck('name','id')->toArray();

        return view('products.crear', compact('categories','statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'name' => 'required',
            'amount' => 'required|min:1|regex:/^\d*(\.\d{1,2})?$/',
            'categorie_id' => 'required|integer',
            'status_id' => 'required|integer'
        ]);

        $product=[
            'name' => $request->name,
            'comment' => $request->comment,
            'amount' => $request->amount,
            'categorie_id' => $request->categorie_id,
            'status_id' => $request->status_id
        ];

        Product::firstOrCreate($product); //Si el producto ya exciste no lo crea

        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $categories=Categorie::pluck('name','id')->toArray();
        $statuses=Status::pluck('name','id')->toArray();

        return view('products.editar',compact('product','categories','statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        dd($request);
        request()->validate([
            'name' => 'required',
            'amount' => 'required',
            'categorie_id' => 'required|integer',
            'status_id' => 'required|boolean'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

}
