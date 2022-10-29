<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\BannerStoreRequest; 
use App\Http\Requests\Update\BannerUpdateRequest;
use App\Models\Banner;
use App\Services\Banner\BannerServiceInterface;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    protected $bannerService;
    function __construct(BannerServiceInterface $bannerService)
    {
        $this->bannerService = $bannerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (Gate::denies('List_Banner', 'List_Banner')) {
        //     abort(403);
        // }
        $banners = $this->bannerService->all($request);
        $params = [
            'banners' => $banners,
        ];
        return view('backend.banners.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (Gate::denies('Add_Banner', 'Add_Banner')) {
        //     abort(403);
        // }
        return view('backend.banners.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerStoreRequest $request)
    {
        // if (Gate::denies('Add_Banner', 'Add_Banner')) {
        //     abort(403);
        // }
        try {
            $this->bannerService->create($request);
            Session::flash('success', 'Tạo mới thành công');
            //tao moi xong quay ve trang danh sach task
            return redirect()->route('banners.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('banners.index')->with('error', 'Tạo mới không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        // if (Gate::denies('Show_Banner', 'Show_Banner')) {
        //     abort(403);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (Gate::denies('Edit_Banner', 'Edit_Banner')) {
        //     abort(403);
        // }
        $banner = $this->bannerService->find($id);
        $params = [
            'banner' => $banner,
        ];
        return view('backend.banners.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdateRequest $request, $id, $status = null)
    {
        // if (Gate::denies('Edit_Banner', 'Edit_Banner')) {
        //     abort(403);
        // }
        try {
            $this->bannerService->update($request, $id, $status);
            //dung session de dua ra thong bao
            Session::flash('success', 'Cập nhật thành công');
            //tao moi xong quay ve trang danh sach product
             return redirect()->route('banners.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
             return redirect()->route('banners.index')->with('error', 'cập nhật không thành công');
        }
    }
    public function updateStatus($id, $status)
    {
        // if (Gate::denies('Edit_Banner', 'Edit_Banner')) {
        //     abort(403);
        // }
        $this->bannerService->updateStatus($id, $status);
        return redirect()->route('banners.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (Gate::denies('Delete_Banner', 'Delete_Banner')) {
        //     abort(403);
        // }
        try {
            $this->bannerService->delete($id);
            Session::flash('success', 'Xóa thành công!');
            return redirect()->route('banners.index');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', 'Xóa không thành công!');
            return redirect()->route('banners.index');
        }
    }
    public function showStatus($id){

        $banners = Banner::findOrFail($id);
        $banners->status = '1';
        if ($banners->save()) {
            return redirect()->back();
        }
    }
    public function hideStatus($id){

        $banners = Banner::findOrFail($id);
        $banners->status = '0';
        if ($banners->save()) {
            return redirect()->back();
        }
    }
}