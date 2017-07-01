<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    function index(Request $request)
    {
        return view('admin::user.index');
    }

    function indexAjax(Request $request)
    {
        $rows = Post::getPaginate($request);
        return response()->json($rows);
    }
}
