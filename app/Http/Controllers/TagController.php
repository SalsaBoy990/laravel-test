<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index')->with([
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validáció
        $request->validate([
            'name' => 'required|string|min:3|max:60|unique:tags,name',
            'description' => 'sometimes|min:10|string|nullable',
            'style' => 'required|string',
        ]);

        // létrehozás
        $tag = new Tag([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => Str::slug($request->input('name'), '-'),
            'style' => $request->input('style'),
        ]);

        // mentés
        $tag->save();

        // átirányítás
        return $this->index()->with([
            'message_success' => "The tag <b>" . $tag->name . "</b> was created."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tags
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        // ez nem is kell
        return view('tag.show')->with([
            'tag' => $tag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tags
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tag.edit')->with([
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        // validáció
        $request->validate([
            'name' => [
                'required', 
                'string',
                'min:3',
                'max:60',
                Rule::unique('tags', 'name')->ignore($tag->id),
            ],
            'description' => 'sometimes|min:10|string|nullable',
            'style' => 'sometimes|string',
        ]);

        // frissítés
        $tag->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'slug' => Str::slug($request->input('name'), '-'),
            'style' => $request->input('style'),
        ]);


        // átirányítás
        return $this->index()->with([
            'message_success' => "The tag <b>" . $tag->name . "</b> was updated."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $oldName = $tag->name;
        $tag->delete();

        return $this->index()->with([
            'message_success' => "The tag <b>" . $oldName . "</b> was deleted."
        ]);
    }
}
