<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_tbl;
use Illuminate\Support\Facades\log;

class RegisterListController extends Controller
{
    public function showRegistrationList()
    {
        $userDatas = user_tbl::all();
        if ($userDatas) {
            return view('auth/registerList',['userDatas'=>$userDatas]);
          }
        return abort(404);
    }
}
