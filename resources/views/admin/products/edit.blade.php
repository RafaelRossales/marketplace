@extends('layouts.app')

@section('content')

<h1>Atualizar Produto</h1>

<form action="{{route('admin.products.update',['product'=>$product->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

     <div class="form-group">
    <label>Nome Produto</label>
    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
    </div>
    <div class="form-group">
        <label>Descricao</label>
        <textarea class="form-control" name="description" >{{ $product->description}}</textarea>
    </div>
    <div class="form-group">
        <label>Conteúdo</label>
        <input type="text" class="form-control" name="body" value="{{ $product->body}}">
    </div>
    <div class="form-group">
        <label>Preço</label>
        <input type="text" class="form-control" name="price" value="{{ $product->price }}">
    </div>

    <div class="form-group">
        <label>Fotos</label>
        <input type="file"  name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
        @error('photos')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label>Categorias</label>
        <select name="categories[]" id="" class="form-control" multiple>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            @if($product->categories->contains($category)) selected @endif>{{ $category->name }}</option>    
        @endforeach
    </select>
    </div>
    <div>
    <button class= "btn btn-primary"><i class="fas fa-band-aid"></i>Atualizar Produto</button>
    </div>
    <hr>
    <div class="row">
        @foreach ($product->photos as $photo)
            <div class="col-4 text-center">
                <img src="{{ asset('storage/'. $photo->image) }}" alt="" class="img-fluid">
                <form action ="{{ route('admin.photo.remove')}}" method="POST">
                    <input type="hidden" name="photoName" value="{{ $photo->image }}">
                @csrf
                <button type="submit" class="btn btn-danger">Remover</button>
                </form>
            </div>
        @endforeach
    </div>
</form>

@endsection