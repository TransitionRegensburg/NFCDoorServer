<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Book;
use Dingo\Api\Routing\Helpers;
use App\Door;
use App\Http\Controllers\Controller;
use App\Manager;
use App\DoorUserGrant;
use Tymon\JWTAuth\Facades\JWTFactory;

use Illuminate\Http\Request;

class DoorController extends Controller
{
    use Helpers;
    public function index()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        //is user superadmin? give him glory
        if ($currentUser->is_superadmin) {
            return Door::all();
        }
        //otherwise give data of managed doors
        $managedDoors = Manager::where('user', $currentUser->id)->get();
        $arrDoors = [];
        foreach($managedDoors as $managedDoor){
          $arrDoors[] = Door::find($managedDoor->door);
        }
        return $arrDoors;
    }
    public function show($id){
      return Door::findOrFail($id);
    }

    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        if(!$currentUser->is_superadmin){
          return ['error' => 'only superadmin can do this.'];
        }

        $door = Door::create($request->all());

        $customClaims = ['door' => $door->id];

        $payload = JWTFactory::make($customClaims);

        $door->token = JWTAuth::encode($payload);

        $door->save();

        return $door;
    }

    public function update(Request $request, $id){
      return ['saved' => Door::findOrFail($id)->update($request->all())];
    }
    public function destroy(Request $request, $id){
      return ['removed' => Door::findOrFail($id)->delete()];
    }
}
