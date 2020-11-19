<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    protected function uservalidatorstore(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone_no' => ['required', 'numeric'],
        ]);
    }

    protected function uservalidatorupdate(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'numeric'],
            'phone_no' => ['required', 'numeric'],
        ]);
    }

    public function index()
    {
        $users = User::paginate(15);
        return $this->handleResponse('Request Success', $users);
    }

    public function create()
    {
        $users = new User;
        return $this->handleResponse('Request Success', $users->getDefault());
    }

    public function store(Request $request)
    {
        $validate = $this->uservalidatorstore($request->all())->getMessageBag();

        if (empty($validate->getMessages())) {
            DB::beginTransaction();
            try {
                $users = new User;
                $users->email = $request->email;
                $users->name = $request->name;
                $users->phone_no = $request->phone_no;
                $users->password = Hash::make($request->password);
                $users->role_id = $request->role_id;
                $users->lastlogin_at = $request->lastlogin_at;
                $users->save();
                DB::commit();
                return $this->handleResponse("Success", $users);
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->handleResponse("Internal Server Error", $e->getMessage());
            }
        } else {
            return $this->handleResponse("Validation Error", $validate->getMessages());
        }
    }

    public function show($id)
    {
        try
        {
            $users = User::findOrFail($id);
            return $this->handleResponse('Request Success', $users);
        }
        catch(ModelNotFoundException $e)
        {
//            dd(get_class_methods($e)); // lists all available methods for exception object
            dd($e->getMessage());
        }
    }

    public function edit($id)
    {
        try
        {
            $users = User::findOrFail($id);
            return $this->handleResponse('Request Success', $users);
        }
        catch(ModelNotFoundException $e)
        {
//            dd(get_class_methods($e)); // lists all available methods for exception object
            dd($e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        $validate = $this->uservalidatorupdate($request->all())->getMessageBag();
        if (empty($validate->getMessages())) {
            DB::beginTransaction();
            try {
                $users = User::findOrFail($id);
                $users->email = $request->email;
                $users->name = $request->name;
                $users->phone_no = $request->phone_no;
                $users->role_id = $request->role_id;
                $users->save();
                DB::commit();
                return $this->handleResponse("Success", $users);
            } catch (ModelNotFoundException $e) {
                DB::rollBack();
                dd($e->getMessage());
            }
        } else {
            return $this->handleResponse("Validation Error", $validate->getMessages());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $users = User::findOrFail($id);
            $users->delete();
            DB::commit();
            return $this->handleResponse("Success");
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }


//    public function __construct()
//    {
//        //
//    }
//
//    protected function uservalidator(array $data)
//    {
//        return Validator::make($data, [
//            'id' => ['numeric'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'name' => ['required', 'string', 'max:255'],
//            'password' => ['required', 'string', 'min:6', 'confirmed'],
//            'phone_no' => ['required', 'numeric'],
//        ]);
//    }
//
//    public function filter(){
//        return 'filter';
//    }
//
//    public function data(Request $request){
//        if (!empty($request->id)){
//            $users = User::where('id', $request->id)->first();
//        } else {
//            $users = new User;
//            $users->getDefault();
//        }
//        $users = new User;
//        $users->getDefault();
//
//        return $this->handleResponse('Request Success', $users->getDefault());
//    }
//
//    public function raw(){
//        return 'raw';
//    }
//
//    public function save(Request $request){
//        $validate = $this->uservalidator($request->all())->getMessageBag();
//
//        if (empty($validate->getMessages())){
//            DB::beginTransaction();
//            try {
//                $users = new User;
//                $users->name = $request->name;
//                $users->email = $request->email;
//                $users->password = Hash::make($request->password);
//                $users->phone_no = $request->phone_no;
//                $users->role_id = 2;
//                $users->lastlogin_at = null;
//                $users->save();
//                DB::commit();
//                return $this->handleResponse("Success", $users);
//            } catch (\Exception $e) {
//                DB::rollBack();
//                return $this->handleResponse("Internal Server Error", $e->getMessage());
//            }
//        }else{
//            return $this->handleResponse("Validation Error", $validate->getMessages());
//        }
//    }
//
//    public function delete(){
//        return 'delete';
//    }
}
