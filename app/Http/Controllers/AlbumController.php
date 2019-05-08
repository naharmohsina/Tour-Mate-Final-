<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\User;
use Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $albums = Album::where('userId',Auth::user()->id)->get();
    return view('album.index',compact('albums'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(User::find(Auth::user()->id) != "general-user"){
            $status = 1;
        }
        else{

            $status = 0;
        }

        $uploadPath = 'public/Image/';
         if(!empty($request['photo'])){
         $cover_photo = $request->file('photo');
        $name = $cover_photo->getClientOriginalName();
        $cover_photo->move($uploadPath, $name);
        $imageUrl = $uploadPath . $name;
    }
    else{

          $imageUrl =  $uploadPath.'cover.JPG';
    }

        $albums = new Album();
        $albums->title = $request->title;
        $albums->userId = Auth::user()->id;
        $albums->description = $request->description;
        $albums->status = $status;
        $albums->cover_image = $imageUrl;
        $albums->save();

        return redirect('/myAlbum')->with('message','Album Create Successfully');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }
}
