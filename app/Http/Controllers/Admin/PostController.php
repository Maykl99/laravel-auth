<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


/* use Illuminate\Support\Str;
$data['slug']=Str::slug($data['title'],'-'); */


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #prelevo solo i post dove la user_id è uguale al id del admin loggato
        #$posts= Post::all();


        $posts= Post::where('user_id', Auth::id())->orderBy('created_at','desc')->get(); #istruzione ->get() obbligatoria se <> da ::all()
        
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags= Tag::all();
        return view('admin.posts.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|min:5|max:100',
            'body' => 'required|min:5|max:500',
        ]);

        $data= $request->all(); #mi prendo i dati restiuiti sotto forma di array

        $data['user_id'] = Auth::id(); #id autentificato
        $data['slug'] = Str::slug($data['title'],'-');

        $newPost= new Post();
        $newPost->fill($data); #riempio i vari campi di questa istanza
        
        
        $saved= $newPost->save();

        $newPost->tags()->attach($data['tags']);

        #dd($saved);

        if($saved){
            return redirect()->route('posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        #dd($post);
        #$data= $post
        /* if(empty($post)){
            abort(404);
        }
        return view('admin.posts.show',compact('post')); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        #dd($post);
        $tags= Tag::all();
        return view('admin.posts.edit', compact('post','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        #dd($request->all());
        #dd($request);

        $request->validate([
            'title' => 'required|min:5|max:100',
            'body' => 'required|min:5|max:500',
        ]);

        $data=$request->all(); #array di dati 
        $data['slug']= Str::slug($data['title'],'-'); #modifica
        #dd($post->user_id);

        $post->tags()->sync($data['tags']);

        $post->update($data); # istruzione update sql 
        #$post->save(); # istruzione insert sql 
        
        return  redirect()->route('posts.index')->with('statusModifica','Hai modificato correttamente il post del id ' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('statusCancella','Hai cancellato correttamente il post del id ' . $post->id);
    }
}
