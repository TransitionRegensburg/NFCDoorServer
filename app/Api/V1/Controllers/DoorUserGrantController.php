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

class DoorUserGrantController extends Controller
{
    use Helpers;
    public function index()
    {
      return DoorUserGrant::all();
    }
    public function show( $id){
      return DoorUserGrant::findOrFail($id);
    }
    public function store(Request $request)
    {
      return DoorUserGrant::create($request->all());
    }
    public function update(Request $request, $id){
      return ['saved' => DoorUserGrant::findOrFail($id)->update($request->all())];
    }
    public function destroy(Request $request, $id){
      return ['removed' => DoorUserGrant::findOrFail($id)->delete()];
    }
}
