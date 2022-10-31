<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    function getModel()
    {
        return User::class;
    }
    public function all($request)
    {
        $key                    = $request->key ?? '';
        $name                   = $request->name ?? '';
        $id                     = $request->id ?? '';
        $email                  = $request->email  ?? '';
        // thực hiện query
        $query = User::select('*');
        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if ($email) {
            $query->where('email', 'LIKE', '%' . $email . '%');
        }
        if ($id) {
            $query->where('id', $id);
        }
        if ($key) {
            $query->orWhere('id', $key);
            $query->orWhere('name', 'LIKE', '%' . $key . '%');
            $query->orWhere('email', 'LIKE', '%' . $key . '%');
        }
        //Phân trang
        $users = $query->orderBy('id', 'DESC')->paginate(5);
        $params = [
            'f_id'           => $id,
            'f_name'         => $name,
            'f_key'          => $key,
            'f_email'        => $email,
            'users'          => $users
        ];
        return view('backend.users.index', $params);

    }
    public function update($id, $data)
    {
        $user = User::find($id);
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->gender = $data['gender'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->group_id = $data['group_id'];
        $user->day_of_birth = $data['day_of_birth'];
        $user->phone = $data['phone'];
        // dd($data['avatar']);
   if (!empty($data['avatar'])) {
            $file = $data['avatar'];
            $fileExtension = $file->getClientOriginalExtension(); //jpg,png lấy ra định dạng file và trả về
            $fileName = time(); //45678908766 tạo tên file theo thời gian
            $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
            $path = 'storage/' . $data['avatar']->store('images', 'public'); //lưu file vào mục public/images với tê mới là $newFileName
            $user->avatar = $path;
        }
        try {
        $user->save();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
    public function create($data)
    {
        $user = $this->model;
        $user->name = $data['name'];
        $user->address = $data['address'];
        $user->gender = $data['gender'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->day_of_birth = $data['day_of_birth'];
        $user->password= bcrypt('admin');
        $user->phone = $data['phone'];
        $user->group_id = $data['group_id'];
        if ($data['avatar']) {
            $file = $data['avatar'];
            $fileExtension = $file->getClientOriginalExtension(); //jpg,png lấy ra định dạng file và trả về
            $fileName = time(); //45678908766 tạo tên file theo thời gian
            $newFileName = $fileName . '.' . $fileExtension; //45678908766.jpg
            $path = 'storage/' . $data['avatar']->store('images', 'public'); //lưu file vào mục public/images với tê mới là $newFileName
            $user->avatar = $path;
        }
        try {
            $user->save();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }

    }
    public function softDeletes($id){
           $user = $this->model->findOrFail($id);
           $user->deleted_at = date("Y-m-d h:i:s");
           try {
            $user->save();
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
    $users = $this->model->withTrashed()->findOrFail($id);
    // $this->authorize('restore', User::class);
    $users->deleted_at = null;
    try {
        $users->save();
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
        $query = User::withTrashed();

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
        $users = $query->orderBy('id', 'DESC')->where('deleted_at', '!=', null)->paginate(5);
        $params = [
            'f_id'           => $id,
            'f_name'         => $name,
            'f_key'          => $key,
            'f_email'        => $email,
            'users'          => $users
        ];
        return view('backend.users.trash', $params);
  }
   public function deletes($id) {
    try {
        $users = User::withTrashed()->findOrFail($id);
        $image = str_replace('storage', 'public', $users->avatar);
        Storage::delete($image);
        $users->forceDelete();
        Session::flash('success', 'Xóa thành công');
        return redirect()->route('users.trash');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        Session::flash('error', 'Xóa thất bại');
        return redirect()->route('users.trash');
    }
   }
   public function loginProcessing($data){
//    dd($data);
    if (Auth::attempt($data)) {
        return redirect()->route('users.index');
    } else {
        $kq='tài khoản, hoặc mật khẩu không đúng';
        return redirect()->route('login')->with($kq);
    }
   }
   public function logout() {

   }
}
