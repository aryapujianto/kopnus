<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return \response()->json(User::all());
    }

    public function create(UserCreateRequest $request)
    {
        $user = User::create($request->only('name','email','phone','address'));

        return \response()->json(['message'=>'oke','user'=>$user],202);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return \response()->json(['message'=>'oke','user' => $user]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id)->update($request->only('name','email','phone','address'));

        return \response()->json(['message'=>'oke','user'=>$user]);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return \response()->json(['message'=>'oke']);
    }
}
