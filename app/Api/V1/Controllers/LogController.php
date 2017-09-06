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
use App\Log;
use Tymon\JWTAuth\Facades\JWTFactory;

use Illuminate\Http\Request;

class LogController extends Controller
{
    use Helpers;

    public function index()
    {
      return Log::all();
    }
    public function show( $id){
      return Log::findOrFail($id);
    }
    public function store(Request $request)
    {
      return Log::create($request->all());
    }
    public function update(Request $request, $id){
      return ['saved' => Log::findOrFail($id)->update($request->all())];
    }
    public function destroy(Request $request, $id){
      return ['removed' => Log::findOrFail($id)->delete()];
    }
}
