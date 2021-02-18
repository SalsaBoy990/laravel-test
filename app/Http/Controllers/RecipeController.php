<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd( $name . " is " . $age . " years old" );
        $recipes = Recipe::all();

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

        // dd('store');
        // $request['name'];
        $recipe = new Recipe([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        $recipe->save();
        return $this->index()->with([
            'message_success' => "The recipe <b>" . $recipe->name . "</b> was created."
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
        return view('recipe.show')->with([
            'recipe' => $recipe
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
        // dd($recipe);
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

        return $this->index()->with([
            'message_success' => "The recipe <b>" . $oldName . "</b> was deleted."
        ]);
    }
}
