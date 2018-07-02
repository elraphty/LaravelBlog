<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostController extends Controller
{

       /**
     * Create a new controller instance.
     *
     * @return void
     */
    //Authentication
    public function __construct()
    {
        //Default
       // $this->middleware('auth');

       //With Exceptions
       $this->middleware('auth',['except'=>['index','show']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::select('Select * from posts');
        //Post::where('title',title)->get();
        //Post::all();
        //Limiting results
      //$post=Post::orderBy('title','desc')->take(1)->get();
      //$post=Post::orderBy('title','desc')->get();
      
      $post=Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
       if($request->hasFile('cover_image')){
           //Get filename with extension
           $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
           //Get just filename
           $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
           //Get just extension
           $extension=$request->file('cover_image')->getClientOriginalExtension();
           //File Name To Store
           $fileNameToStore=$filename.'_'.time().'.'.$extension;
           //Upload Image
           $path= $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
       }else{
          $fileNameToStore="noimage.jpg";
       }

        //Create Post
      $post=new Post;
      $post->title=$request->input('title');
      $post->body=$request->input('body');
      $post->user_id=auth()->user()->id;
      $post->cover_image=$fileNameToStore;
      $post->save();

      //Returnin with Flash
      return redirect('/post')->with('success','Post Created');
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
      $post=Post::find($id);
      return view('posts.show')->with('post',$post);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::Find($id);
    
        //Check for Correct User
       if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/post')->with('error','Unauthorized Page');  
        }
        
        return view('posts.edit')->with('post',$post);
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
        //
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);

            //Handle File Upload
       if($request->hasFile('cover_image')){
        //Get filename with extension
        $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
        //Get just filename
        $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
        //Get just extension
        $extension=$request->file('cover_image')->getClientOriginalExtension();
        //File Name To Store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;
        //Upload Image
        $path= $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
    }


      $post=Post::Find($id);
      $post->title=$request->input('title');
      $post->body=$request->input('body');

      if($request->hasFile('cover_image')){
      $post->cover_image=$fileNameToStore;
      }

      $post->save();
        //Returning with Flash
      return redirect('/post')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);
        if($post->cover_image !=="noimage.jpg")
         {
             //Storage Delete
             Storage::delete('/public/cover_images/'.$post->cover_image);

         }

        $post->delete();
        return redirect('/post')->with('success','Post Deleted Successfully');
    }
}
