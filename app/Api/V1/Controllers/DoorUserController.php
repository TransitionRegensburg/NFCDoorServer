<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Book;
use Dingo\Api\Routing\Helpers;
use App\Door;
use App\DoorUser;
use App\Http\Controllers\Controller;
use App\Manager;
use App\DoorUserGrant;
use Tymon\JWTAuth\Facades\JWTFactory;

use Illuminate\Http\Request;

class DoorUserController extends Controller
{
    use Helpers;
    public function index()
    {
      return DoorUser::all();
    }
    public function show( $id){
      return DoorUser::findOrFail($id);
    }
    public function store(Request $request)
    {
      return DoorUser::create($request->all());
    }
    public function update(Request $request, $id){
      return ['saved' => DoorUser::findOrFail($id)->update($request->all())];
    }
    public function destroy(Request $request, $id){
      return ['removed' => DoorUser::findOrFail($id)->delete()];
    }
}
