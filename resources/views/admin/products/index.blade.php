@extends('layouts.app')

@section('content')
<a href="{{ route('admin.products.create') }}" class="btn btn-success"><i class="fa fa-shopping-basket"></i> Criar Produto</a>
<hr>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Loja</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->store->name }}</td>
            <td>R$ {{ number_format($p->price,2,',','.')}}</td>
            <td>
                <a href="{{ route('admin.products.edit',['product'=>$p->id]) }}" class="btn  btn-warning"><i class="fa fa-edit"></i></a>
                <form action="{{ route('admin.products.destroy',['product'=>$p->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                     <button type="submit" class="btn  btn-danger"><i class="fa fa-trash"></i></button>
                </form>
           </td>
        </tr>

        @endforeach
    </tbody>
</table>
{{-- Paginação --}}
{{ $products->links() }}

@endsection