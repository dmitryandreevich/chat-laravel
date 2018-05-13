<?php

namespace App\Http\Controllers;

use App\Publication;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    protected $redirectTo = '/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friendsIds = array(Auth::user()->id);
        $friends = FriendsController::getAllFriends(Auth::user()->id);
        // формируем массив идентификаторов друзей юзера
        foreach ($friends as $friend)
            array_push($friendsIds, $friend->id);
        // забираем все публикации друзей
        $friendsPublications = Publication::whereIn('author_id',$friendsIds)->orderBy('created_at','desc')->get();
        // добавляем в каждую публикацию, коллекцию автора
        foreach ($friendsPublications as $publication)
            $publication->author = User::findOrFail($publication->author_id);
        return view('publications', compact('friendsPublications'));
    }
    public function giveLike(Request $request){

        $pId = $request->pId;
        $publication = Publication::where('id', $pId)->first();
        $likes = $publication->likes;
        $publication->likes = $likes + 1;
        $publication->save();
        return $likes + 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['postText' => 'required|string|min:1']);
        Publication::create(['author_id' => Auth::user()->id, 'text' => $request->input('postText')]);
        return redirect( route('profile') );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
