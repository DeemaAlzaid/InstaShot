<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */


    //i think create should be timeline in my case
    public function create()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('timeline', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'image_path' => 'required | mimes: jpeg,png,bmp,gif,svg | max:5048',
            'description' => 'required'
        ]);

        $image_path = $request['image_path'];
        $description = $request['description'];


        $post = new Post();
        $post->image_path = $image_path;
        $post->description = $description;
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect()->route('timeline');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $post = Post::find($id);
        return view('editPost')->with('post', $post);
//        return redirect()->route('editPost');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $this->validate($request, [
            'description' => 'required'
        ]);

        if($request->hasFile('image_path')){
            $post->image_path = $request['image_path'];
        }

        $post->description = $request['description'];;
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect()->route('timeline');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $post = Post::find($id);

        if (Auth::User() != $post->user) {
            return redirect()->back();
        }

        $post->delete();

        return redirect()->route('timeline');
    }

}
