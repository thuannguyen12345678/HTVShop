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
use Illuminate\Support\Facades\Storage;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    function getModel()
    {
        return Product::class;
    }
    public function all($request)
    {
        $products = $this->model->select('*');

        if (!empty($request->search)) {
            $search = $request->search;
            $products = $products->Search($search);
        }
        if (!empty($request->category_id)) {
            $products->NameCate($request)
            ->filterPrice(request(['startPrice', 'endPrice']))
            ->filterDate(request(['start_date', 'end_date']))
            ->status($request)->Type($request);
        }
        if (!empty($request->supplier_id)) {
            $products->NameSupp($request)
            ->filterPrice(request(['startPrice', 'endPrice']))
            ->filterDate(request(['start_date', 'end_date']))
            ->status($request)->Type($request);
        }
        if (!empty($request->brand_id)) {
            $products->NameBran($request)
            ->filterPrice(request(['startPrice', 'endPrice']))
            ->filterDate(request(['start_date', 'end_date']))
            ->status($request)->Type($request);
        }

        $products->filterPrice(request(['startPrice', 'endPrice']));
        $products->filterDate(request(['start_date', 'end_date']));
        $products->status($request);
        $products->Type($request);

        return $products->orderBy('id', 'DESC')->paginate(5);
    }
    public function create($data)
    {
        // dd($data);
        try {
            //create product
            $products = $this->model;
            $products->name = $data['name'];
            $products->price = $data['price'];
            $products->amount = $data['amount'];
            $products->color = $data['color'];
            $products->category_id = $data['category_id'];
            $products->brand_id = $data['brand_id'];
            $products->description = $data['description'];


            // $products->created_by = Auth::user()->id;
            if ($data['image']) {
                $file = $data['image'];
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = 'storage/' . $file->store('/products', 'public');
                $products->image = $path;
            }
            $products->save();
            if ($data['file_names']) {
                ImageProduct::where('product_id', '=', $products->id)->delete();
                foreach ($data['file_names'] as $file_detail) {
                    // File::delete($product->file_names()->file_name);
                    $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $products->image_products()->saveMany([
                        new ImageProduct([
                            'product_id' => $products->id,
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

        return $products;
    }
    public function update($id, $data)
    {
        // dd($data);
        try {
            //create product
            $products = $this->model->find($id);
            $products->name = $data['name'];
            $products->price = $data['price'];
            $products->amount = $data['amount'];
            $products->color = $data['color'];
            $products->category_id = $data['category_id'];
            $products->brand_id = $data['brand_id'];
            $products->description = $data['description'];
            // $products->image = $data['image'];
            // dd($data);
            // $products->created_by = Auth::user()->id;
            if (isset($data['image'])) {
                $file = $data['image'];
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . date('mdYHis') . uniqid() . '.' . $extension;
                $path = 'storage/' . $file->store('/products', 'public');
                $products->image = $path;
            }
            //create specifications

            $products->save();
            if (isset($fileExtension)) {
                Storage::delete($products);
            }
            //create product_images
            if ($data['file_names']) {
                $items = ImageProduct::where('product_id', '=', $products->id)->get();
                foreach($items as $item){
                    $im = 'public/images/product/'.$item->image;
                    Storage::delete($im);
                }
                ImageProduct::where('product_id', '=', $products->id)->delete();
                foreach ($data['file_names'] as $file_detail) {
                    // File::delete($product->file_names()->file_name);
                    $detail_path = 'storage/' . $file_detail->store('/products', 'public');
                    $products->image_products()->saveMany([
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
        // $products->save();

        return $products;
    }
    // public function update($id, $data)
    // {
    //     try {
    //         //create product
    //         $product = $this->model->find($id);
    //         $product->name = $data['name'];
    //         $product->price = $data['price'];
    //         $product->amount = $data['amount'];
    //         $product->description = $data['description'];
    //         $product->category_id = $data['category_id'];
    //         $product->brand_id = $data['brand_id'];
    //         $product->image = $data['image'];
    //         // $product->created_by = Auth::user()->id;
    //         if (isset($data['inputFile'])) {
    //             $file = $data['inputFile'];
    //             $image = 'public/images/product/'.$product->image;
    //             $fileExtension = $file->getClientOriginalExtension();
    //             $fileName = time(); // create file name by curent time
    //             $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
    //             $data['inputFile']->storeAs('public/images/product', $newFileName); //save file in public/images/brand with newname is newFileName
    //             $product->image = $newFileName;

    //         }
    //         $product->save();
    //         if(isset($fileExtension)){
    //             Storage::delete($image);
    //         }
    //         //create product_images
    //         if (isset($data['file_names'])) {
    //             $items = ImageProduct::where('product_id', '=', $product->id)->get();
    //             foreach($items as $item){
    //                 $im = 'public/images/product/'.$item->image;
    //                 Storage::delete($im);
    //             }
    //             ImageProduct::where('product_id', '=', $product->id)->delete();
    //             ImageProduct::onlyTrashed()->where('product_id', '=', $product->id)->forceDelete();
    //             foreach ($data['file_names'] as $key => $file_detail) {
    //                 $fileExtension = $file_detail->getClientOriginalExtension();
    //                 $fileName = time(); // create file name by curent time
    //                 $newFileName =  $key .$fileName. '.' . $fileExtension;
    //                 $file_detail->storeAs('public/images/product', $newFileName);
    //                 $product->product_images()->saveMany([
    //                     new ImageProduct([
    //                         'product_id' => $product->id,
    //                         'image' => $newFileName,
    //                     ]),
    //                 ]);
    //             }
    //         }
    //         return true;
    //     } catch (\Exception $e) {
    //         Log::error($e->getMessage());
    //         return false;
    //     }
    //     return $product;
    // }
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
