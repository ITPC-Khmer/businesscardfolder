<?php

namespace App\Modules\Blog\Http\Controllers;

use App\Modules\Blog\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use const null;
use function response;
use function view;

class PostController extends Controller
{
    function index(Request $request)
    {
        return view('blog::post.index');
    }

    function indexAjax(Request $request)
    {
        $rows = Post::getPaginate($request);
        return response()->json($rows);
    }

    function form(Request $request)
    {
        $row = null;
        return view('blog::post.form',['row'=>$row]);
    }

    function edit(Request $request)
    {
        $id = $request->id;
        $row = null;
        if($id > 0)
        {
            $row = Post::find($id);
        }

        return view('blog::post.form',['row'=>$row]);
    }



    function save(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if(Post::saveData($request) !=null)
        {
            return redirect('blog/admin/post');
        }else{
            return redirect()->back()->withErrors([_t('Save error')]);
        }

    }


}
