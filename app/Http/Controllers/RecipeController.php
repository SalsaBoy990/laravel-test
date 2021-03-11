<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as Image;

class RecipeController extends Controller
{

    // can only execute the show method
    public function __construct() {
        $this->middleware('auth')->except([ 'index', 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $recipes = Recipe::paginate( 10 );
        $recipes = Recipe::orderBy('created_at', 'DESC')->paginate( 10 );

        //dd( $recipes );
        return view('recipe.index')->with([
            'recipes' => $recipes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('recipe.create');
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
            'name' => 'required|min:3',
            'image' => 'sometimes|file|mimes:jpg,jpeg,bmp,png,gif|max:512',
            'description' => 'required|min:5',
        ]);

        $recipe = new Recipe([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);
        $recipe->save();

        // save images in the appropriate image sizes
        if ($request->has('image')) {
            $this->saveImages($request->file('image'), $recipe->id);
        }

        return redirect('/recipe/' . $recipe->id)->with([
            'message_warning' => "Please assign some tags now"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $allTags = Tag::all();
        $usedTags = $recipe->tags;

        $availableTags = $allTags->diff($usedTags);

        return view('recipe.show')->with([
            'recipe' => $recipe,
            'availableTags' => $availableTags,
            'message_success' => Session::get('message_success'),
            'message_warning' => Session::get('message_warning')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        // Route-model binding
        return view('recipe.edit')->with([
            'recipe' => $recipe,
            'message_success' => Session::get('message_success'),
            'message_warning' => Session::get('message_warning')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'sometimes|file|mimes:jpg,jpeg,bmp,png,gif|max:512',
            'description' => 'required|min:5',
        ]);

        // save images in the appropriate image sizes
        if ($request->has('image')) {
            $this->saveImages($request->file('image'), $recipe->id);
        }

        $recipe->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        return $this->index()->with([
            'message_success' => "The recipe <b>" . $recipe->name . "</b> was updated."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $oldName = $recipe->name;
        $recipe->delete();
        
        return redirect()->back()->with([
            'message_success' => "The recipe <b>" . $oldName . "</b> was deleted."
        ]);
    }

    public function saveImages ($imageInput, $recipeId) {
        $image = Image::make($imageInput);
        if ( $image->width() > $image->height() ) { // Landscape
            $image->widen(1200)
                ->save(public_path() . '/img/recipes/' . $recipeId . '_large.jpg')
                ->widen(400)->pixelate(6)
                ->save(public_path() . '/img/recipes/' . $recipeId . '_pixelated.jpg');
            
            $image = Image::make($imageInput);
            $image->widen(80)
                ->save(public_path() . '/img/recipes/' . $recipeId . '_thumb.jpg');
        } else { // Portrait
            $image->heighten(900)
            ->save(public_path() . '/img/recipes/' . $recipeId . '_large.jpg')
            ->heighten(400)->pixelate(6)
            ->save(public_path() . '/img/recipes/' . $recipeId . '_pixelated.jpg');
        
            $image = Image::make($imageInput);
            $image->heighten(80)
                ->save(public_path() . '/img/recipes/' . $recipeId . '_thumb.jpg');
        }
    }

    public function deleteImages ($recipeId) {
        $fileLink = public_path() . '/img/recipes/';

        if ( file_exists($fileLink . $recipeId . '_large.jpg')) {
            unlink($fileLink . $recipeId . '_large.jpg');
        }
        if ( file_exists($fileLink . $recipeId . '_pixelated.jpg')) {
            unlink($fileLink . $recipeId . '_pixelated.jpg');
        }
        if ( file_exists($fileLink . $recipeId . '_thumb.jpg')) {
            unlink($fileLink . $recipeId . '_thumb.jpg');
        }
        return back()->with([
            'message_success' => "The image was deleted."
        ]);
    }
}
