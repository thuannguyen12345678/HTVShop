<?php
namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\BaseRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    function getModel()
    {
        return Customer::class;
    }
    public function all($request)
    {
        $key        = $request->key ?? '';
        $name      = $request->name ?? '';
        $phone      = $request->phone ?? '';
        $email      = $request->email ?? '';
        $id         = $request->id ?? '';
        $query = Customer::query(true);
        $query->orderBy('id', 'ASC');
        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%')->where('deleted_at', '=', null);
        }
        if ($phone) {
            $query->where('phone', 'LIKE', '%' . $phone . '%')->where('deleted_at', '=', null);
        }
        if ($email) {
            $query->where('email', 'LIKE', '%' . $email . '%')->where('deleted_at', '=', null);
        }
        if ($id) {
            $query->where('id', $id)->where('deleted_at', '=', null);
        }
        if ($key) {
            $query->orWhere('id', $key)->where('deleted_at', '=', null);
            $query->orWhere('name', 'LIKE', '%' . $key . '%')->where('deleted_at', '=', null);
            $query->orWhere('phone', 'LIKE', '%' . $key . '%')->where('deleted_at', '=', null);
            $query->orWhere('email', 'LIKE', '%' . $key . '%')->where('deleted_at', '=', null);
        }
        return $query->where('deleted_at', '=', null)->paginate(5);
        // $params = [
        //     'f_id'        => $id,
        //     'f_name'     => $name,
        //     'f_phone'     => $phone,
        //     'f_email'     => $email,
        //     'f_key'       => $key,
        //     'customers'    => $customers,
        // ];
        // return view('backend.customers.index', $params);
    }
    public function changeStatus($id,$data){
        $object = $this->model->find($id);
        return $object->update($id,$data);
    }
    public function getTrash()
    {
        $query=  $this->model->onlyTrashed();
        $query ->orderBy('id', 'asc');
        $customer = $query->paginate(8);
        return $customer;
    }
    public function delete($id)
    {
        $customer = $this->model->findOrFail($id);
        try {
            $customer->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $customer;
    }
    public function restore($id){
        return  $this->model->withTrashed()->where('id', $id)->restore();
    }
    public function forceDelete($id)
    {
        return  $this->model->withTrashed()->where('id', $id)->forceDelete();
    }
    public function searchCustomer($name){
       $customer = $this->model::where('name', 'like', '%' . $name . '%')
                            ->orWhere('phone', 'like', '%' . $name . '%')
                            ->orWhere('email', 'like', '%' . $name . '%');
        if(Route::currentRouteName() =='customer.searchKey'){
          return  $customer   ->get();
        }
        return  $customer   ->paginate(8);
    }
}