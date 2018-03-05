<?php

namespace App\Http\Controllers\views\admin;

use Hash;
use Mail;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = null;
        if ( $request->has('role') && $request->role != '' ) {
            $role = Role::where('name', $request->role)->first();
        }

        $keywords = $request->keywords;
        $users = User::when($keywords, function($query) use ($keywords) {
            return $query->where('firstname', 'rlike', $keywords)
            ->orWhere('lastname', 'rlike', $keywords)
            ->orWhere('username', 'rlike', $keywords);
        })
        ->when($role, function($query) use ($role) {
            return $query->where('role_id', $role->id);
        })
        ->orderBy('id', 'desc')
        ->paginate(50);

        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }


    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user = User::find($id);
        if ( !$user  ) {
            return redirect()->route('users.index');
        }

        $roles = Role::get();
        return view('admin.users.edit', compact('user', 'roles'));
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
        $validator = Validator::make($request->all(), [
             'email'  => 'required',
             'firstname'  => 'required',
             'lastname'  => 'required'
         ]);


         if($validator->fails())
             return redirect()->back()->withErrors(['validator' => 'Email, first name & last name are required!']);


         $user = User::find($id);
         if ( !$user ) {
             return redirect()->back()->withErrors(['user' => 'Unknown user!']);
         }

         if ( preg_match('/\s/', $request->username) ) {
             return redirect()->back()->withErrors(['validator' => 'Username cannot contain white spaces']);
         }

         $user->phone          = $request->has('phone') ? $request->phone : $user->phone;
         $user->email          = $request->has('email') ? $request->email : $user->email;
         $user->firstname      = $request->has('firstname') ? $request->firstname : $user->firstname;
         $user->lastname       = $request->has('lastname') ? $request->lastname : $user->lastname;
         $user->role_id        = $request->has('role_id') ? $request->role_id : $user->role_id;
         $user->is_active      = $request->has('is_active') ? $request->is_active : $user->is_active;
         $user->save();

         return redirect()->back()->with('message', 'User successfully updated');
    }

}
