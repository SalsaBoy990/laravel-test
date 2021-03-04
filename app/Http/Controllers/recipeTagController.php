<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Recipe;

class recipeTagController extends Controller
{
    public function getFilteredRecipes($tag_id) {
        $tag = new Tag();
        $recipes = $tag::findOrFail($tag_id)->filteredRecipes()->paginate( 10 );

        $filter = $tag::find($tag_id);

        return view('recipe.index')->with([
            'recipes' => $recipes,
            'filter' => $filter,
        ]);
    }

    public function attachTag($recipe_id, $tag_id) {
        $recipe = Recipe::find($recipe_id);
        $tag = Tag::find($tag_id);
        $recipe->tags()->attach($tag_id);

        return back()->with([
            'message_success' => "The tag <b>" . $tag->name . "</b> was added."
        ]);
    }

    public function detachTag($recipe_id, $tag_id) {
        $recipe = Recipe::find($recipe_id);
        $tag = Tag::find($tag_id);
        $recipe->tags()->detach($tag_id);
        
        return back()->with([
            'message_success' => "The tag <b>" . $tag->name . "</b> was removed."
        ]);
    }
}
