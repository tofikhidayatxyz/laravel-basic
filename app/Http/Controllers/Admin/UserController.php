<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Storage;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * For view all users
     * @param request
     * @return view
     */

    public function index(Request $request) {
        
        $key =  $request->has('query') ? $request->get('query') : null;
        if($key) {
            $users = User::where('name', 'LIKE', '%'. $key .'%')
                          ->orWhere('email', 'LIKE', '%'. $key .'%')
                          ->orWhere('address', 'LIKE', '%'. $key .'%')
                          ->orWhere('phone', 'LIKE', '%'. $key .'%')
                          ->orWhere('born', 'LIKE', '%'. $key .'%')
                          ->orWhere('hobby', 'LIKE', '%'. $key .'%')
                          ->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        
        return view('admin.user.index', compact('users'));
    }

    /**
     * For creating user
     */
    public function create() {
        
        return view('admin.user.create');
    }
    /**
     * For storeing user data
     * @param request 
     * @param id
     * @return session
     */
    public function store(Request $request) {
       
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|string|min:5|unique:users',
            'address' => 'required|string',
            'born' => 'required|date',
            'hobby' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|string|confirmed',
            'profile' => 'required|file|image'
        ]);
        $file =  $request->file('profile');

        $fileName =  sha1($file->getClientoriginalName() . Carbon::now() . mt_rand()). '.' .$file->getClientOriginalExtension();
        $user = (object) $request->all();
        $file->storeAs('public/user/images/', $fileName);
        $user->password =  bcrypt($request->password);
        $user->profile = $fileName;

        User::create((array) $user);

        return redirect()->route('admin.user.index')->with('success', 'Sucessfuly create new user');
    }

    /**
     * For view edit
     * @param id
     */
    public function edit($id) {
        
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * For updating user
     */

     public function update(Request $request) {

        $user =  User::findOrFail($request->id);

        $request->validate([
            'name' => 'required|string|min:5',
            'email' => [
                'required',
                'string',
                'min:5',
                Rule::unique('users')->ignore($user->id)   
            ],
            'address' => 'required|string',
            'born' => 'required|date',
            'hobby' => 'required|string',
            'phone' => 'required|string'
        ]);

        if($request->profile) {
            $request->validate(['profile' => 'required|file|image']);

            $file =  $request->file('profile');
            $fileName =  sha1($file->getClientoriginalName() . Carbon::now() . mt_rand()). '.' .$file->getClientOriginalExtension();
            $file->storeAs('public/user/images/', $fileName);

            $path = 'public/user/images/'. $user->profile;

            if(Storage::exists($path)) {
                Storage::delete($path);
            }

            $user->profile = $fileName;
        }

        if($request->password) {
            $request->validate(['password' => 'required|string|confirmed']);
            $user->password = bcrypt($request->password);
        }

        $user->name =  $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->born = $request->born;
        $user->hobby = $request->hobby;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('admin.user.index')->withSuccess('Successfully updating user');

     }

     /**
      * For deleting user
      */
      public function delete(Request $request) {
          $user = User::findOrFail($request->id);
          $path = 'public/user/images/'. $user->profile;
          if(Storage::exists($path)) {
            Storage::delete($path);
          }
            
          $user->delete();
          return redirect()->route('admin.user.index')->withSuccess('Successfully Deleting user');
      }


    
}
