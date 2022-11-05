<?php

namespace App\Repositories\Api\Product;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\Api\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeProductRepository extends BaseRepository implements FeProductRepositoryInterface
{

    function getModel()
    {
        return Product::class;
    }
    public function getAll()
    {
        $products = $this->model->take(15)->get();


        return $products;
    }
    public function search($request)
    {
        $query = $this->model::query();
        $data = $request->input('search');
        if ($data) {
            $query->whereRaw("name Like '%" . $data . "%' ")
                ->orWhereRaw("price Like '%" .$data . "%' ")
                // ->orWhereRaw("description Like '%" .$data . "%' ")
            ;
        }
        return $query->get();
    }
    public function find($id)
    {
        $product= DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select('products.*',  'categories.name as cateName',
        'brands.name as branName')->where('products.id','=',$id)->get();
        return $product;
    }

    public function find_images($id)
    {
        $product= DB::table('products')
        ->join('image_products', 'products.id', '=', 'image_products.product_id')
        ->select('image_products.file_name as image_products')->where('image_products.product_id','=',$id)->get();
        return $product;
    }
    public function trendingProduct()
    {
        $trendingPro = DB::table('order_details')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.*, count(order_details.product_id) totalByQuan')
            ->groupBy('order_details.product_id')
            ->orderBy('totalByQuan', 'DESC')
            ->take(8)
            ->get();
        return $trendingPro;
    }
    public function countReviewStar($id)
    {
        $product = $this->model->find($id);
        foreach ($product->reviews as $key =>  $value) {
            $review = [
                'oneStar' => count($value->where('vote', '1')->where('product_id', $product->id)->pluck('vote')->all()),
                'twoStar' => count($value->where('vote', '2')->where('product_id', $product->id)->pluck('vote')->all()),
                'threeStar' => count($value->where('vote', '3')->where('product_id', $product->id)->pluck('vote')->all()),
                'fourStar' => count($value->where('vote', '4')->where('product_id', $product->id)->pluck('vote')->all()),
                'fiveStar' => count($value->where('vote', '5')->where('product_id', $product->id)->pluck('vote')->all()),
            ];
        }
        return $review;
    }
}
