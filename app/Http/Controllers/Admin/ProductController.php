<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    use UploadTrait;
    private $product;

    public function __construct(Product $product)
    
    {
        $this->product = $product;    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStore = auth()->user()->store;
        $products = $userStore->products()->paginate(10);

        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all(['id','name']);

        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //Criando produto
        
        
        $data = $request->all();
        $categories = $request->get('categories',null);
        //Acesso a loja do usuario autenticado
        $store = auth()->user()->store;
        //Objeto produto retorna as informações do produto criado
        $product = $store->products()->create($data);
        //Acessando a ligação de produtos com categorias e salvando na tabela intermediaria
        //category_product 
        $product->categories()->sync($categories);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'),'image');
            //inserção destas imagens/referencia  na base

            $product->photos()->createMany($images);
        }

        flash('Produto Criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
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
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = $this->product->find($product);
        $categories = \App\Category::all(['id','name']);
        
        return view('admin.products.edit',compact('product','categories'));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        $categories = $request->get('categories',null);
        
        $product = $this->product->find($product);
        $product->update($data);
        if(!is_null($categories)){
           
            $product->categories()->sync($data['categories']);
        }
        

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'),'image');
            //inserção destas imagens/referencia  na base

            $product->photos()->createMany($images);
        }

        flash('Produto atualizado com sucesso!')->success();
        return redirect()->route('admin.products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = $this->product->find($product);
        $product->delete();

        flash('Produto excluido com sucesso!')->success();
        return redirect()->route('admin.products.index');

    }


}
