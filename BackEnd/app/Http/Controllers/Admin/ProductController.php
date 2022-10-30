<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreProductRequest;
use App\Http\Requests\Update\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\Product\ProductServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $productService;
    public function __construct(ProductServiceInterface $productService){
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);
        $products = $this->productService->all($request);
        $categories = Category::all();
        $brands = Brand::all();
        $params = [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ];
        return view('backend.products.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        $categories = Category::all();
        $brands = Brand::all();
        $params = [
            'categories' => $categories,
            'brands' => $brands,
        ];

        return view('backend.products.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            // dd(123);
            $this->productService->create($request);
            Session::flash('success', 'Tạo mới thành công');
            //tao moi xong quay ve trang danh sach task
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', 'Tạo mới không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Product::class);
        $products = $this->productService->find($id);
        return view('backend.products.show',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Product::class);
        $products = $this->productService->find($id);
        $categories = Category::get();
        $brands = Brand::get();
        $params = [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
        ];

        return view('backend.products.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {

        try {
            // $brands->save();
            $products = $this->productService->update($id, $request->all());

            //dung session de dua ra thong bao
            Session::flash('success', 'Cập nhật thành công');
            //tao moi xong quay ve trang danh sach product
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error', 'cập nhật không thành công');
        }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Product::class);
        try {
            $this->productService->delete($id);
            // dd(1);
            Session::flash('success', 'Đưa vào thùng rác thành công!');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Đưa vào thùng rác không thành công!');
            return redirect()->route('products.index');
        }
    }
    public function trashedItems(Request $request)
    {
        $products = $this->productService->trashedItems();
        return view('backend.products.trash', compact('products'));
    }
    public function force_destroy($id)
    {

        $this->authorize('forceDelete', Product::class);
        try {
            $this->productService->force_destroy($id);
            Session::flash('success', 'Xóa thành công!');
            return redirect()->route('products.trash');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Xóa không thành công!');
            return redirect()->route('products.trash');
        }
    }

    public function restore($id)
    {

        $this->authorize('restore', Product::class);

        try {
            $this->productService->restore($id);
            Session::flash('success', 'Khôi phục thành công!');
            return redirect()->route('products.trash');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Khôi phục không thành công!');
            return redirect()->route('products.trash');
        }
    }

    public function showStatus($id){
        $products = Product::findOrFail($id);
        $products->status = '1';
        if ($products->save()) {
            return redirect()->back();
        }
    }
    public function hideStatus($id){
        $products = Product::findOrFail($id);
        $products->status = '0';
        if ($products->save()) {
            return redirect()->back();
        }
    }
    public function exportProducts(Request $request){
        return Excel::download(new ProductsExport, 'users.xlsx');
    }
}
