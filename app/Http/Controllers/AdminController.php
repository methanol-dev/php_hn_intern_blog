<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Admin\AdminRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminRepo;

    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function index()
    {
        $users = $this->adminRepo->getUser();

        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = $this->adminRepo->findOrFail($id);

        return view('admin.user.update', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $status = $request->input('status');
            $this->adminRepo->updateUserStatus($id, $status);
        } catch (\Exception $th) {
            return redirect()->back()->with('err', trans('me.update_fail'));
        }

        return redirect()->back();
    }
}
