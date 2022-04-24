<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\Admin\AdminRepositoryInterface;

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

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $status = $request->input('status');
            $user = $this->adminRepo->updateUserStatus($id, $status);
            if ($user->status == User::BLOCK) {
                Alert::alert()->success(trans('me.user_block'), trans('me.successfully'));
            } else {
                Alert::alert()->success(trans('me.user_unblock'), trans('me.successfully'));
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('err', trans('me.update_fail'));
        }

        return redirect()->back();
    }
}
