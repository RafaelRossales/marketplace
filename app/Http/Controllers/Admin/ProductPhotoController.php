<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request)
    {

        $photoName = $request->get('photoName');
        //Busca a foto pelo Id
        if(Storage::disk('public')->exists($photoName)){
        //Remove dos arquivos
            Storage::disk('public')->delete($photoName); 
        }

        //Remove a imagem do banco
        $removePhoto = ProductPhoto::where('image',$photoName);

        $productId = $removePhoto->first()->product_id;
        $removePhoto->delete();

        flash('Imagem removida com sucesso!')->success();
        return redirect()->route('admin.products.edit',['product'=>$productId]);

        
    }
}