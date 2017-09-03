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
    public function grants(){
        $payload = JWTAuth::parseToken()->getPayload();
        return DoorUserGrant::where('door', '=', $payload['door'])->get();
    }
    public function storeUser(Request $request){

    }
    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $door = Door::create($request->all());

        $door->save();

        $customClaims = ['door' => $door->id];

        $payload = JWTFactory::make($customClaims);

        $door->token = JWTAuth::encode($payload);

        $door->save();

        return $door;
    }
}
