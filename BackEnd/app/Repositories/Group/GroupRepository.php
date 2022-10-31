<?php

namespace App\Repositories\Group;

use App\Models\Group;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{

    function getModel()
    {
        return Group::class;
    }
    public function all($request)
    {
        $key                    = $request->key ?? '';
        $name                   = $request->name ?? '';
        $id                     = $request->id ?? '';
        // thực hiện query
        $query = Group::select('*');
        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }

        if ($id) {
            $query->where('id', $id);
        }
        if ($key) {
            $query->orWhere('id', $key);
            $query->orWhere('name', 'LIKE', '%' . $key . '%');
        }
        //Phân trang
        $groups = $query->paginate(5);
        $params = [
            'f_id'           => $id,
            'f_name'         => $name,
            'f_key'          => $key,
            'groups'          => $groups
        ];
        return view('backend.groups.index', $params);

    }
    public function update($id, $data)
    {
        $group = Group::find($id);
        $group = $this->model;
        $group->name = $data['name'];
        $group->description = $data['description'];
        try {
            $group->save();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
    public function create($data)
    {
        $group = $this->model;
        $group->name = $data['name'];
        $group->description = $data['description'];
        try {
            $group->save();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

    }
    public function softDeletes($id){
           $group = $this->model->findOrFail($id);
           $group->deleted_at = date("Y-m-d h:i:s");
           try {
            $group->save();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
    public function delete($id)
    {
        $category = $this->model->findOrFail($id);
        try {
            $category->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $category;
    }
  public function restore($id){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $groups = $this->model->withTrashed()->findOrFail($id);
    // $this->authorize('restore', group::class);
    $groups->deleted_at = null;
    try {
        $groups->save();
        return true;
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return false;
    }
  }
  public function trash($request){
        $key                    = $request->key ?? '';
        $name                   = $request->name ?? '';
        $id                     = $request->id ?? '';
        $email                  = $request->email  ?? '';

        // thực hiện query
        $query = Group::withTrashed();

        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%')->where('deleted_at', '!=', null);
        }
        if ($email) {
            $query->where('email', 'LIKE', '%' . $email . '%')->where('deleted_at', '!=', null);
        }
        if ($id) {
            $query->where('id', $id)->where('deleted_at', '!=', null);
        }
        if ($key) {
            $query->orWhere('id', $key)->where('deleted_at', '!=', null);
            $query->orWhere('name', 'LIKE', '%' . $key . '%')->where('deleted_at', '!=', null);
            $query->orWhere('email', 'LIKE', '%' . $key . '%')->where('deleted_at', '!=', null);
        }

        //Phân trang
        $groups = $query->orderBy('id', 'DESC')->where('deleted_at', '!=', null)->paginate(5);
        $params = [
            'f_id'           => $id,
            'f_name'         => $name,
            'f_key'          => $key,
            'f_email'        => $email,
            'groups'          => $groups
        ];
        return view('backend.groups.trash', $params);
  }
   public function deletes($id) {
    try {
        $groups = Group::withTrashed()->findOrFail($id);
        $image = str_replace('storage', 'public', $groups->avatar);
        Storage::delete($image);
        $groups->forceDelete();
        Session::flash('success', 'Xóa thành công');
        return redirect()->route('groups.trash');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        Session::flash('error', 'Xóa thất bại');
        return redirect()->route('groups.trash');
    }
   }

}
