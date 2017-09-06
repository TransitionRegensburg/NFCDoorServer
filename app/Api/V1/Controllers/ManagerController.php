<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Book;
use Dingo\Api\Routing\Helpers;
use App\Door;
use App\Manager;
use App\User;
use App\Http\Controllers\Controller;
use App\DoorUserGrant;
use Tymon\JWTAuth\Facades\JWTFactory;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    use Helpers;
    public function index()
    {
      return Manager::all();
    }
    public function show( $id){
      return Manager::findOrFail($id);
    }
    public function store(Request $request)
    {
      return Manager::create($request->all());
    }
    public function update(Request $request, $id){
      return ['saved' => Manager::findOrFail($id)->update($request->all())];
    }
    public function destroy(Request $request, $id){
      return ['removed' => Manager::findOrFail($id)->delete()];
    }
}
