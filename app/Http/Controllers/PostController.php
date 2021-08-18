<?php 

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;


class PostController extends Controller {


    public function getTimeline(){
        
        $posts = Post::orderBy('created_at', 'desc')->get();
        
     return view('timeline', ['posts' => $posts]);
    }


    public function postCreatePost(Request $request){

       
        $this->validate($request, [
            'image' => 'required | mimes: jpg,png,jpeg | max:5048',
            'description' => 'required | max:1000'
        ]);

        
        $image = $request->file('image');
        $newImageName = time() . '-' . $image->name . '.' . $image->extension();

        $image->move(public_path(images), $newImageName);

        $description = $request['description'];
       

        $post = new $Post();
        $post->image = $newImageName;
        $post->description = $description;

        dd($post);
        $post->save();
        // $message = 'There was an error';
        // if($request->user()->posts()->save($post)){
        //     $message = 'Your post has succsessfuly created!';
        // }

        return redirect()->route('timeline');
    }


    public function getDeletePost($post_id){
        $post = Post::find($post_id)->first();

        if(Auth::User() != $post->user){
            return redirect()->back();
        }
        $post = delete();

        return redirect()->route('timeline')->with(['message' => 'Post Deleted!']);
    }

    public function postEditPost(Request $request){


        $this->validate($request, [
            'body' => 'required'
        ]);

        if(Auth::User() != $post->user){
            return redirect()->back();
        }

        $post = Post::find($request['postId']);
        $post->body = $request['body'];
        $post->update();
        
        return response()->json(['new_body' => $post -> body], 200);
    }

    public function addComment (Request $request, $post_id){

        $this->validate($request, [
            'image' => 'required | mimes: jpg,png,jpeg | max:5048',
            'description' => 'required | max:1000'
        ]);
        return $post_id;
    }

}