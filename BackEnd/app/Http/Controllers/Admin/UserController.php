<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userService;
    public function __construct(UserServiceInterface $UserService)
    {
        $this->userService = $UserService;
    }
    public function index(Request $request)
    {
        return $this->userService->all($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view('backend.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($this->userService->create($data)){
            return redirect()->route('users.index')->with('success','thêm mới thành công');
        }
        return redirect()->route('users.index')->with('error','thêm mới không thành công');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $user = $this->userService->find($id);
    //    return redirect()->route('users.v')
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = $this->userService->find($id);
        return view('backend.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $user = User::find($id);
        // dd($id);
        $data = $request->all();
        if($this->userService->update($id,$data)){
        return redirect()->route('users.index')->with('success','cập nhật thành công');
        }
        return redirect()->route('users.index')->with('error','cập nhật không thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->userService->deletes($id);
    }
    function softDeletes($id){
        if($this->userService->SoftDeletes($id)){
            return redirect()->route('users.index')->with('success','xóa thành công');
            }
            return redirect()->route('users.index')->with('error','Xóa không thành công');
    }
    function trash(Request $request){
       return $this->userService->trash($request);
    }
    public function restore($id){
    //   return $this->userService->restore($id);
      if($this->userService->restore($id)){
        return redirect()->route('users.trash')->with('success','khôi phục thành công');
        }
        return redirect()->route('users.trash')->with('error','khôi phục không thành công');
    }
    public function login() {
        if (Auth::check()) {
            return redirect()->route('users.index');
        } else {
            return view('backend.login.login');
        }
    }
    public function loginProcessing(Request $request){
     $data=[
        'email' => $request->email,
        'password' => $request->password
    ];
        return $this->userService->loginProcessing($data);
    }
    public function logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
