<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Artisan;

class ProductController extends Controller
{
    // space that we can use the repository from
    protected $model;

    public function __construct(Product $product)
    {
        // set the model
        $this->model = new Repository($product);
    }

    public function index()
    {
        
        Artisan::call("add:product", [
            "id" => 5,
            "--name"=> "System"
            ]);
            

        return $this->model->all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|max:500'
       ]);

        // create record and pass in only fields that are fillable
        return $this->model->create($request->only($this->model->getModel()->fillable));
    }

    public function show($id)
    {
        return $this->model->show($id);
    }

    public function update(Request $request, $id)
    {
        $this->model->update($request->only($this->model->getModel()->fillable), $id);
       
        return Product::findOrFail($id);
    }

    public function destroy($id)
    {
        return $this->model->delete($id);
    }
}
