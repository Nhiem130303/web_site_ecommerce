<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('type', 0)->paginate(5);

        return view('admin.users.index',['users' => $users]);
    }

    public function updateStatus(Request $request)
    {
        if ($request->ajax()){
            $userId = $request->id;

            $user = User::where('id', $userId)->first();

            if ($request->status == 0){
                $status = 1;
            }else{
                $status = 0;
            }

            $user->status = $status;
            $user->save();

            return response()->json(['status' => $status]);
        }
    }
}
