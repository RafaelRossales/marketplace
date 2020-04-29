@extends('layouts.app')

@section('content')

@if(!$store)
<div class="" style="text-align:center;">
<a href="{{ route('admin.stores.create') }}" class="btn btn-success" ><i class="fa fa-shopping-basket"></i> Criar Loja</a>
</div>
@else

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Loja</th>
            <th>Total de produtos</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $store->id }}</td>
            <td>{{ $store->name }}</td>
            <td>{{ $store->products->count() }}</td>
            <td>
                <a href="{{ route('admin.stores.edit',['store'=>$store->id]) }}" class="btn  btn-warning"><i class="fa fa-edit"></i></a>
                <form action="{{ route('admin.stores.destroy',['store'=>$store->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn  btn-danger"><i class="fa fa-trash"></i></button>
                </form>
        </td>
        </tr>
    </tbody>
</table>
@endif
@endsection