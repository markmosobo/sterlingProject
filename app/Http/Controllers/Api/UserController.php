<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    /**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$users = User::all();
return response()->json([
"success" => true,
"message" => "User List",
"data" => $users
]);
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$input = $request->all();
$validator = Validator::make($input, [
'username' => 'required',
'email' => 'required'
]);
if($validator->fails()){
return $this->sendError('Validation Error.', $validator->errors());       
}
$user = User::create($input);
return response()->json([
"success" => true,
"message" => "User created successfully.",
"data" => $user
]);
} 
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$user = User::find($id);
if (is_null($user)) {
return $this->sendError('User not found.');
}
return response()->json([
"success" => true,
"message" => "User retrieved successfully.",
"data" => $user
]);
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, User $user)
{
$input = $request->all();
$validator = Validator::make($input, [
'username' => 'required',
'email' => 'required'
]);
if($validator->fails()){
return $this->sendError('Validation Error.', $validator->errors());       
}
$user->username = $input['username'];
$user->email = $input['email'];
$user->save();
return response()->json([
"success" => true,
"message" => "User updated successfully.",
"data" => $user
]);
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy(User $user)
{
$user->delete();
return response()->json([
"success" => true,
"message" => "User deleted successfully.",
"data" => $user
]);
}
}
