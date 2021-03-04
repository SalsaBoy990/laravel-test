<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;

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
            'description' => 'required|min:5',
        ]);

        $recipe = new Recipe([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);
        $recipe->save();

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
            'recipe' => $recipe
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
            'description' => 'required|min:5',
        ]);

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
}
