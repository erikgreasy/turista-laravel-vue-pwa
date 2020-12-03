<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'users.index', [
            'users' => User::all()
        ] );
    }



    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view( 'users.show', [
            'user'  => $user
        ] );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize( 'update', $user );
        return view( 'users.edit', [
            'user'  => $user
        ] );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize( 'update', $user );


        // print_r( $_POST );
        

        $request->validate([
            'name'  => 'required'
        ]);

        if( isset( $request->avatar ) ) {

            // User had profile picture before, delete that picture
            if( $user->avatar_path != '/storage/avatars/default.png' ) {
                $exploded_path = explode( '/', $user->avatar_path );
                $file = $exploded_path[ count( $exploded_path ) -1 ];
                Storage::delete( '/public/avatars/' . $file );
            }
            $avatar = $request->file( 'avatar' );
            $path = Storage::disk('public')->putFile('avatars', $avatar );

            $user->avatar_path = '/storage/' . $path;
            
        }

        $user->name = $request->name;
        $user->save();

        return redirect( '/my-profile' );
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


    
}
