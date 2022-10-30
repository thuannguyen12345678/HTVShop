<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreCategoryRequest;
use App\Http\Requests\Update\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $categoryService;
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        $this->authorize('viewAny', Category::class);
        $categories = $this->categoryService->all($request);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $categories = new Category();
        $categories->name = $request->input('name');
        try {
            $categories->save();
            Session::flash('success', 'Tạo mới thành công');
            //tao moi xong quay ve trang danh sach task
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', 'Tạo mới không thành công');
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
        $this->authorize('update', Category::class);
        $categories = $this->categoryService->find($id);
        return view('backend.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $categories = Category::findOrFail($id);
        $categories->name = $request->input('name');
        try {
            $categories->save();
            //dung session de dua ra thong bao
            Session::flash('success', 'Cập nhật thành công');
            //tao moi xong quay ve trang danh sach product
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories.index')->with('error', 'cập nhật không thành công');
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
        $this->authorize('delete',Category::class);
        try {
            $category = $this->categoryService->delete($id);
            // dd(1);
            Session::flash('success', 'Đưa vào thùng rác thành công!');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Đưa vào thùng rác không thành công!');
            return redirect()->route('categories.index');
        }
    }

    public function trashedItems(Request $request)
    {
        $categories = $this->categoryService->trashedItems();
        return view('backend.categories.trash', compact('categories'));
    }
    public function force_destroy($id)
    {
        $this->authorize('delete', Category::class);
        try {
            $this->categoryService->force_destroy($id);
            Session::flash('success', 'Xóa thành công!');
            return redirect()->route('categories.trash');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Xóa không thành công!');
            return redirect()->route('categories.trash');
        }
    }

    public function restore($id)
    {
        $this->authorize('restore', Category::class);
        try {
            $this->categoryService->restore($id);
            Session::flash('success', 'Khôi phục thành công!');
            return redirect()->route('categories.trash');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Khôi phục không thành công!');
            return redirect()->route('categories.trash');
        }
    }
    public function showStatus($id)
    {
        $this->authorize('view', Category::class);
        $categories = Category::findOrFail($id);
        $categories->status = '1';
        if ($categories->save()) {
            return redirect()->back();
        }
    }
    public function hideStatus($id)
    {
        $categories = Category::findOrFail($id);
        $categories->status = '0';
        if ($categories->save()) {
            return redirect()->back();
        }
    }
}
