<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\Customer\CustomerServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }
    public function index(Request $request)
    {
        $this->authorize('viewAny', Customer::class);
        $customers =  $this->customerService->all($request);
        return view('backend.customers.index', compact('customers'));
    }
    public function create()
    {
        // if (Gate::denies('Add_Customer', 'Add_Customer')) {
        //     abort(403);
        // }
    }
    public function store(Request $request)
    {
        // if (Gate::denies('Add_Customer', 'Add_Customer')) {
        //     abort(403);
        // }
    }
    public function show($id)
    {
        $this->authorize('view', Customer::class);
        $customers =  $this->customerService->find($id);
        $provinces =  $this->customerService->all($id);
        $districts =  $this->customerService->all($id);
        $wards =  $this->customerService->all($id);
        $params = [
            'customers' => $customers,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ];
        return view('backend.customers.show', $params);
    }
    public function edit($id)
    {
        // if (Gate::denies('Show_Customer', 'Show_Customer')) {
        //     abort(403);
        // }
    }
    public function update(Request $request, $id)
    {
        // if (Gate::denies('Edit_Customer', 'Edit_Customer')) {
        //     abort(403);
        // }
    }
    public function destroy($id)
    {
        $this->authorize('delete', Customer::class);
        try {
            $category = $this->customerService->delete($id);
            // dd(1);
            Session::flash('success', '????a v??o th??ng r??c th??nh c??ng!');
            return redirect()->route('customers.index');
        } catch (\Exception $e) {
            Log::error('message:' . $e->getMessage());
            Session::flash('error', '????a v??o th??ng r??c kh??ng th??nh c??ng!');
            return redirect()->route('customers.index');
        }
    }

    public function getTrash()
    {

        $customers = $this->customerService->getTrash();
        return view('backend.customers.softDelete', compact('customers'));
        try {
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }
    public function restore(Request $request,$id)
    {
        $this->authorize('restore', Customer::class);
        try {
            DB::beginTransaction();
            $this->customerService->restore($id);
            DB::commit();
            $messages = 'Kh??i ph???c th??nh c??ng ';
            Session::flash('success',$messages );
            return redirect()->route('customers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Kh??i ph???c kh??ng th??nh c??ng ';
            Session::flash('error',$messages );
            return redirect()->route('customers.index');
        }
    }
    public function forceDelete(Request $request)
    {
        $this->authorize('forceDelete', Customer::class);
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->customerService->forceDelete($id);
            DB::commit();
            $messages = 'Force delete successfully!!';
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Force Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 500);
        }
    }
}
