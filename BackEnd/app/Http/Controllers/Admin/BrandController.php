<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreBrandRequest;
use App\Http\Requests\Update\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\Brand\BrandServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $brandService;

    public function __construct(BrandServiceInterface $brandService)
    {
        $this->brandService = $brandService;
    }
    public function index(Request $request)
    {
        try {
            $brands = $this->brandService->all($request);
            return  view('backend.brands.index', compact('brands'));
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        // $brands = new Brand();
        // $brands->name = $request->name;
        // if ($request->hasFile('image')) {
        //     $file = $request->image;
        //     $fileExtension = $file->getClientOriginalExtension(); //jpg,png lấy ra định dạng file và trả về
        //     $fileName = time(); //45678908766 tạo tên file theo thời gian
        //     $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
        //     $path = 'storage/' . $request->file('image')->store('image', 'public'); //lưu file vào mục public/images với tê mới là $newFileName
        //     $brands->image = $path;
        // }

        try {
            // $brands->save();
             $this->brandService->create($request->all());
            Session::flash('success', 'Tạo mới thành công');
            //tao moi xong quay ve trang danh sach task
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('brands.index')->with('error', 'Tạo mới không thành công');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brandService->find($id);
        $params = [
            'brand' => $brand
        ];
        return view('backend.brands.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        try {
            // $brands->save();
            $brands = $this->brandService->update($id, $request->all());

            //dung session de dua ra thong bao
            Session::flash('success', 'Cập nhật thành công');
            //tao moi xong quay ve trang danh sach product
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('brands.index')->with('error', 'cập nhật không thành công');
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
        try {
            $this->brandService->delete($id);
            // dd(1);
            Session::flash('success', 'Đưa vào thùng rác thành công!');
            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Đưa vào thùng rác không thành công!');
            return redirect()->route('brands.index');
        }
    }
    public function trashedItems(Request $request)
    {
        $brands = $this->brandService->trashedItems();
        return view('backend.brands.trash', compact('brands'));
    }

    public function force_destroy($id)
    {
        try {
            $this->brandService->force_destroy($id);
            Session::flash('success', 'Xóa thành công!');
            return redirect()->route('brands.trash');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Xóa không thành công!');
            return redirect()->route('brands.trash');
        }
       
    }

    public function restore($id)
    {

        try {
            $this->brandService->restore($id);
            Session::flash('success', 'Khôi phục thành công!');
            return redirect()->route('brands.trash');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Khôi phục không thành công!');
            return redirect()->route('brands.trash');
        }
    }
    public function searchByName(Request $request)
    {
        $brands=[];
        try {
                   $keyword = $request->input('keyword');
        $brands = $this->brandService->searchBrand($keyword);
        return response()->json($brands,200);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            return response()->json($brands,500);
        }

    }
    public function searchBrand(Request $request)
    {
        $brands=[];
        try {
            $keySearch=$request->keySearch;
            $brands =$this->brandService->searchBrand($keySearch);
        $params = [
            'brands' => $brands
        ];
        return  view('backend.brands.index', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            return response()->json(['brands' => $brands],500);
        }

    }
}
