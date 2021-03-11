<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{
    // can only execute the show method
    //public function __construct() {
    //    $this->middleware('auth')->except(['show']);
    //}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $recipes = $user->recipes()->get();
        return view('user.show')->with([
            'user' => $user,
            'recipes' => $recipes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    /**
     * @param Request $request
     * @param User $user
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function modifyUserMotto(Request $request, $id) {
        
        $request->validate([
            'motto' => 'sometimes|min:10',
        ]);
        
        $user = User::findOrFail($id);
        $user->update([
            'motto' => $request->input('motto'),
        ]);
        
        return redirect('/home')->with([
            'message_success' => "Your motto was updated."
        ]);
    }

        /**
     * @param Request $request
     * @param User $user
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function modifyUserAboutMeText(Request $request, $userId) {
        
        $request->validate([
            'about-me' => 'sometimes|min:10',
        ]);

        $user = User::findOrFail($userId);
        $user->update([
            'about_me' => $request->input('about-me'),
        ]);
        
        return redirect('/home')->with([
            'message_success' => "Your about me text was updated."
        ]);
    }

    public function updateProfileImage(Request $request, $userId) {

        $request->validate([
            'profile-image' => 'sometimes|file|mimes:jpg,jpeg,bmp,png,gif|max:512',
        ]);

         // save images in the appropriate image sizes
         if ($request->has('profile-image')) {
            $this->saveImages($request->file('profile-image'), $userId);
        }

        return redirect('/home')->with([
            'message_success' => "Your profile image was updated."
        ]);
       
    }


    private function saveImages ($imageInput, $userId) {
        $image = Image::make($imageInput);
        if ( $image->width() > $image->height() ) { // Landscape
            $image->widen(500)
                ->save(public_path() . '/img/users/' . $userId . '_large.jpg')
                ->widen(300)->pixelate(6)
                ->save(public_path() . '/img/users/' . $userId . '_pixelated.jpg');
            
            $image = Image::make($imageInput);
            $image->widen(60)
                ->save(public_path() . '/img/users/' . $userId . '_thumb.jpg');
        } else { // Portrait
            $image->heighten(500)
            ->save(public_path() . '/img/users/' . $userId . '_large.jpg')
            ->heighten(300)->pixelate(6)
            ->save(public_path() . '/img/users/' . $userId . '_pixelated.jpg');
        
            $image = Image::make($imageInput);
            $image->heighten(60)
                ->save(public_path() . '/img/users/' . $userId . '_thumb.jpg');
        }
    }

    private function deleteImages ($userId) {
        $fileLink = public_path() . '/img/users/';

        if ( file_exists($fileLink . $userId . '_large.jpg')) {
            unlink($fileLink . $userId . '_large.jpg');
        }
        if ( file_exists($fileLink . $userId . '_pixelated.jpg')) {
            unlink($fileLink . $userId . '_pixelated.jpg');
        }
        if ( file_exists($fileLink . $userId . '_thumb.jpg')) {
            unlink($fileLink . $userId . '_thumb.jpg');
        }
        return back()->with([
            'message_success' => "The profile image was deleted."
        ]);
    }




}
