@extends('layouts.app')

@section('content')

<h1>Criar Loja</h1>
<form action="{{route('admin.stores.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    
     <div class="form-group">
    <label>Nome Lojas</label>
    <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

    @error('name')
    <div class="ivalid-feedback">
        {{ message }}
    </div>
    @enderror

    </div>
    <div class="form-group">
        <label>Descricao</label>
        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}">

        @error('description')
        <div class="ivalid-feedback">
            {{ $message }}
        </div>
        @enderror

    </div>
    <div class="form-group">
        <label>Telefone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">

        @error('description')
        <div class="ivalid-feedback">
            {{ $message }}
        </div>
        @enderror

    </div>
    <div class="form-group">
        <label>Logo</label>
        <input type="file" name="logo"  class="form-control @error('logo') is-invalid @enderror" >
        @error('logo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div>
    <button class= "btn btn-primary"><i class="fas fa-band-aid"></i>Criar</button>
    </div>
</form>

@endsection