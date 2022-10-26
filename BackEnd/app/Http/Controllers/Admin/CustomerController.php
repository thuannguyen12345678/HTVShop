<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Customer\CustomerServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }
    public function index(Request $request)
    {
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
    public function destroy(Request $request)
    {
        // if (Gate::denies('Edit_Customer', 'Edit_Customer')) {
        //     abort(403);
        // }
        try {
            DB::beginTransaction();
            $id = $request->id;
            $customer = $this->customerService->find($id);
            $customer->delete();
            DB::commit();
            $messages = 'Deleted successfully.' . $customer->name;
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . '.Line________' . $e->getLine() . ' .File ' . $e->getFile());
            $messages = 'Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 500);
        }
    }
    public function getTrash()
    {
        try {
            $customers = $this->customerService->getTrash();
            $params = ['customers' => $customers];
            return view('backend.customers.softDelete', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->customerService->restore($id);
            DB::commit();
            $messages = 'Restore successfully.';
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 500);
        }
    }
    public function forceDelete(Request $request)
    {
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