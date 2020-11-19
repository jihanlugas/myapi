<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ItemController extends Controller
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

    public function index(){
        $users = User::paginate(15);
        return $this->handleResponse('Request Success', $users);
    }

    public function create(){
        $users = new User;
        return $this->handleResponse('Request Success', $users->getDefault());
    }

    public function store(Request $request){
        return response()->json('store');
    }

    public function show($id){
        return response()->json('show');
    }

    public function edit($id){
        return response()->json('edit');
    }

    public function update($id, Request $request){
        return response()->json('update');
    }

    public function destroy($id){
        return response()->json('destroy');
    }

}
