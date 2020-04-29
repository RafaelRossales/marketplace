<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{


    use UploadTrait;

    //Chamando middleware UserHasStoreMiddleware

    public function __construct()
    {
        // O middleware sera executado apenas nos métodos passados
        $this->middleware('user.has.store')->only(['create','store']);
    }

    public function index()
    {
        //Exibe todas as lojas cadastradas
        //$stores = \App\Store::all();

        //Paginação de 3 lojas por pagina
        //Paginate
        //$stores = \App\Store::paginate(3);
        $store = auth()->user()->store;
        return view('admin.stores.index',compact('store'));
    }

    public function create()
    {

        $users = \App\User::all(['id','name']);
        return view('admin.stores.create',compact('users'));

        
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        //Busca o usuário que esta autenticado
        $user = auth()->user();

        if($request->hasFile('logo')){
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store = $user->store()->create($data);

        flash('Loja criada com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = \App\store::find($store);

        return view('admin.stores.edit',compact('store'));
    }

    public function update(StoreRequest $request,$store)
    {
       $data = $request->all();
       $store = \App\Store::find($store);

       if($request->hasFile('logo')){
           //Verifica se logo da loja ja existe 
           if(Storage::disk('public')->exists($store->logo)){
               //Apaga logo da loja
            Storage::disk('public')->delete($store->logo);
           }
           //Insere outra imagem no campo logo
        $data['logo'] = $this->imageUpload($request->file('logo'));
    }


       $store->update($data);

       flash('Loja Atualizada com sucesso!')->success();
       return redirect()->route('admin.stores.index');

    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();

        flash('Loja removida com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }
}
