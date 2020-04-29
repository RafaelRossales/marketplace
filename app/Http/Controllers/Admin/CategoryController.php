<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->paginate(3);

        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        $category = $this->category->create($data);
        flash('Categoria criada com sucesso!')->success();
        return redirect()->route('admin.categories.index');
    }

    public function show()
    {

    }

    public function edit($category)
    {
        $category = $this->category->findOrFail($category);
        
        return view('admin.categories.edit',compact('category'));
    }

    public function update(CategoryRequest $request,$category)
    {
        $data = $request->all();

        $category = $this->category->find($category);
        $category->update($data);

        flash('Categoria atualizad com sucesso!')->success();
        return redirect()->route('admin.categories.index');
    }
    
    public function destroy($category)
    {
        $category = $this->category->find($category);
        $category->delete();

        flash('Categoria deletada com sucesso!')->success();
        return redirect()->route('admin.categories.index');
    }

}
