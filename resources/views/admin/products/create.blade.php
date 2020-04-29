@extends('layouts.app')

@section('content')

<h1>Criar Produto</h1>
<form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
    
    @csrf

     <div class="form-group">
    <label>Nome Produto</label>
    <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" >

        @error('name')
        <div class="invalid-feedback">
        {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Descricao</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>

        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Conteúdo</label>
        <input type="text"  name="body" class="form-control @error('body') is-invalid @enderror" value="{{old('body')}}">

        @error('body')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Preço</label>
        <input type="text"  name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
        
        @error('price')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
        
    </div>

    <div class="form-group">
        <label>Categorias</label>
        <select name="categories[]" id="" class="form-control" multiple>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>    
        @endforeach
    </select>
    </div>
    <div class="form-group">
        <label>Fotos</label>
        <input type="file"  name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
    </div>
    @error('photos')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    <div>
    <button class= "btn btn-primary"><i class="fas fa-band-aid"></i>Criar Produto</button>
    </div>
</form>

@endsection