<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreGroupRequest;
use App\Http\Requests\Update\UpdateGroupRequest;
use App\Models\Group;
use App\Models\Role;
use App\Services\Group\GroupServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class GroupController extends Controller
{
    private $groupService;
    public function __construct(GroupServiceInterface $GroupService)
    {
        $this->groupService = $GroupService;
    }
    function index(Request $request)
    {
        $this->authorize('viewAny', Group::class);
        return $this->groupService->all($request);
    }
    function create()
    {
        $this->authorize('create', Group::class);
        return view('backend.groups.add');
    }
    function store(StoreGroupRequest $request)
    {
        $data = $request->all();
        if ($this->groupService->create($data)) {
            return redirect()->route('groups.index')->with('success', 'thêm mới thành công');
        }
        return redirect()->route('groups.index')->with('error', 'thêm mới không thành công');
    }
    function edit($id)
    {
        $this->authorize('update', Group::class);
        $group = Group::find($id);
        $roles = Role::all()->toArray();
        $userRoles = $group->roles->pluck('id', 'name')->toArray();
        $group_names = [];
        foreach ($roles as $role) {
            $group_names[$role['group_name']][] = $role;
        }
        $params = [
            'group' => $group,
            'userRoles' => $userRoles,
            'group_names' => $group_names
        ];
        return view('backend.groups.edit', $params);
    }
    function update(UpdateGroupRequest $request, $id)
    {
        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->description = $request->description;
        // dd($request->all());
        try {
            $group->save();
            //detach xóa hết tất cả các record của bảng trung gian hiện tại
            $group->roles()->detach();
            //attach cập nhập các record của bảng trung gian hiện tại
            $group->roles()->attach($request->roles);
            //dung session de dua ra thong bao
            Session::flash('success', 'Cập nhật thành công');
            return redirect()->route('groups.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('groups.index')->with('error', 'Cập nhật' . ' ' . $request->name . ' ' .  ' không thành công');
        }
    }
    function destroy($id)
    {
        $this->authorize('delete',Group::class);
        if ($this->groupService->delete($id)) {
            return redirect()->route('groups.index')->with('success', 'thêm mới thành công');
        }
        return redirect()->route('groups.index')->with('error', 'thêm mới không thành công');
    }
}
