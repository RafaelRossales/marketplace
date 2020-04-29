@extends('layouts.app')

@section('content')

<h1>Editar Loja</h1>
<form action="{{ route('admin.stores.update',['store'=>$store->id]) }}}}" method="post" enctype="multipart/form-data">

    @csrf
    @method("PUT")
    
     <div class="form-group">
    <label>Nome Lojas</label>
    <input type="text" class="form-control" name="name" value="{{ $store->name }}">
    </div>
    <div class="form-group">
        <label>Descricao</label>
        <input type="text" class="form-control" name="description" value="{{ $store->description }}">
    </div>
    <div class="form-group">
        <label>Telefone</label>
        <input type="text" class="form-control" name="phone" value="{{ $store->phone }}">
    </div>
    <div class="form-group">
        <label>Logo</label>
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
        @error('logo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div>
    <button class= "btn btn-primary">Atualizar Loja</button>
    </div>

</form>
<p>Imagem Atual</p>
<p>
    <img src="{{ asset('storage/'.$store->logo) }}" alt="">
</p>

@endsection