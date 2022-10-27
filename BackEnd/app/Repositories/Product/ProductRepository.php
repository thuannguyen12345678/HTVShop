<?php

namespace App\Repositories\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Specifications;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    function getModel()
    {
        return Product::class;
    }
    public function all($request)
    {
        $key        = $request->key ?? '';
        $name      = $request->name ?? '';
        $amount      = $request->amount ?? '';
        $price      = $request->price ?? '';
        $category_id      = $request->category_id ?? '';
        $brand_id      = $request->brand_id ?? '';
        $id         = $request->id ?? '';

        // $categories = Category::all();
        // $brands = Brand::all();

        // thực hiện query
        $query = Product::select('*');
        $query->orderBy('id', 'DESC');
        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%')->where('deleted_at', '=', null);
        }
        if ($amount) {
            $query->where('amount', 'LIKE', '%' . $amount . '%')->where('deleted_at', '=', null);
        }
        if ($price) {
            $query->where('price', 'LIKE', '%' . $price . '%')->where('deleted_at', '=', null);
        }
        if ($category_id) {
            $query->where('category_id', 'LIKE', '%' . $category_id . '%')->where('deleted_at', '=', null);
        }
        if ($brand_id) {
            $query->where('brand_id', 'LIKE', '%' . $brand_id . '%')->where('deleted_at', '=', null);
        }
        if ($id) {
            $query->where('id', $id)->where('deleted_at', '=', null);
        }
        if ($key) {
            $query->orWhere('id', $key)->where('deleted_at', '=', null);
            $query->orWhere('name', 'LIKE', '%' . $key . '%')->where('deleted_at', '=', null);
            $query->orWhere('amount', 'LIKE', '%' . $key . '%')->where('deleted_at', '=', null);
            $query->orWhere('category_id', 'LIKE', '%' . $key . '%')->where('deleted_at', '=', null);
            $query->orWhere('brand_id', 'LIKE', '%' . $key . '%')->where('deleted_at', '=', null);
            $query->orWhere('price', 'LIKE', '%' . $key . '%')->where('deleted_at', '=', null);
        }
        return $query->where('deleted_at', '=', null)->paginate(5);



        
    }
    public function create($data)
    {
        // dd($data->category_id);
        try {
            //create product
            $product = $this->model;
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->quantity = $data['quantity'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->description = $data['description'];
            $product->created_by = Auth::user()->id;
            if ($data['image']) {
                $file = $data['image'];
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = 'storage/' . $file->store('/products', 'public');
                $product->image = $path;
            }
            $product->save();

            //create specifications
           
            //create product_images
            if ($data['file_names']) {
                foreach ($data['file_names'] as $file_detail) {
                    $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $product->file_names()->saveMany([
                        new ImageProduct([
                            'file_name' => $detail_path,
                        ]),
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function update($id, $data)
    {

        try {
            //create product
            $product = $this->model->find($id);
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->quantity = $data['quantity'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->description = $data['description'];
            $product->created_by = Auth::user()->id;
            if (!empty($data['image'])) {
                $file = $data['image'];
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = 'storage/' . $file->store('/products', 'public');
                $product->image = $path;
            }
            $product->save();
            //create specifications
           

            //create product_images
            if ($data['file_names']) {
                ImageProduct::where('product_id', '=', $product->id)->delete();
                foreach ($data['file_names'] as $file_detail) {
                    // File::delete($product->file_names()->file_name);
                    $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $product->file_names()->saveMany([
                        new ImageProduct([
                            'product_id' => $product->id,
                            'file_name' => $detail_path,
                        ]),
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function delete($id)
    {
        $product = $this->model->find($id);
        try {
            $product->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function trashedItems()
    {
        $query = $this->model->onlyTrashed();
        $query->orderBy('id', 'desc');
        $product = $query->paginate(5);
        return $product;
    }
    public function restore($id)
    {
        $product = $this->model->withTrashed()->findOrFail($id);
        $product->restore();
        return $product;
    }
    public function force_destroy($id)
    {
        $product = $this->model->onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        return $product;
    }
}