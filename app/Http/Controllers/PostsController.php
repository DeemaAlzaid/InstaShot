<?php

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Validator;


class PostsController extends Controller
{


    public function getTimeline()
    {

        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('timeline', ['posts' => $posts]);
    }


    public function postCreatePost(Request $request)
    {

        $this->validate($request, [
            'image_path' => 'required| mimes: jpg,png,jpeg | max:5048',
            'description' => 'required | max:1000'
        ]);


        $image_path = $request->file('image_path');
        $newImageName = time() . '-' . '.' . $image_path->extension();

        $request->image_path->move(public_path('images'), $newImageName);
        $description = $request['description'];
        $user_id = Auth::user()->id;


        $post = new Post();
        $post->image_path = $newImageName;
        $post->description = $description;
        $post->user_id = $user_id;

        $post->save();
        dd($post);
//        $request->user()->posts()->save($post);

//        $message = 'There was an error';
//        if($request->user()->posts()->save($post)){
//            $message = 'Your post has successfully created!';
//        }


        return redirect()->route('timeline');
    }


    public function getDeletePost($post_id)
    {
        $post = Post::find($post_id)->first();

        if (Auth::User() != $post->user) {
            return redirect()->back();
        }
        $post = delete();

        return redirect()->route('timeline')->with(['message' => 'Post Deleted!']);
    }

    public function postEditPost(Request $request)
    {


        $this->validate($request, [
            'description' => 'required'
        ]);

        if (Auth::User() != Post()->user) {
            return redirect()->back();
        }

        $post = Post::find($request['id']);
        $post->description = $request['description'];
        $post->update();

        return response()->json(['new_description' => $post->description], 200);
    }

    // This method is not completed, unfortunately...
    public function addComment(Request $request, $post_id)
    {

        $this->validate($request, [
            'image_path' => 'required | mimes: jpg,png,jpeg | max:5048',
            'description' => 'required | max:1000'
        ]);
        return redirect()->back();;
    }

}
