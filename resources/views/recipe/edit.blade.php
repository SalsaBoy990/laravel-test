@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header cart-header-page-title uppercase">Edit Recipe</div>
                    <div class="card-body">
                        <form id="edit-recipe" autocomplete="off" action="/recipe/{{ $recipe->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- name input -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="name" name="name" value="{{ old('name') ?? $recipe->name }}">
                                <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                            </div>

                            <!-- image view -->
                            @if (file_exists('img/recipes/' . $recipe->id . '_large.jpg'))
                            <div class="mb-2" style="position: relative;max-width: 400px; max-height: 300px;">
                                <img class="img-fluid" style="max-width: 400px; max-height: 300px;" src="/img/recipes/{{ $recipe->id }}_large.jpg" alt="">
                                <div style="position: absolute; top: 16px; right: 16px;">
                                    <input form="delete-image" type="submit" value="Delete image" class="btn btn-danger btn-sm">
                                </div>
                            </div>
                            @endif

                            <!-- name input -->
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control {{ $errors->has('image') ? 'border-danger' : '' }}" id="image" name="image" value="">
                                <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                            </div>

                            <!-- description input -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control {{ $errors->has('description') ? 'border-danger' : '' }}" id="description" name="description" rows="5">{{ old('description') ?? $recipe->description }}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                            </div>

                            <!-- save or cancel -->
                            <input class="btn btn-primary mt-4" type="submit" value="Save Recipe">
                            <a class="btn btn-secondary mt-4 ml-2" href="/recipe">Cancel</a>
                        </form>

                        <!-- delete image file -->
                        <form id="delete-image" action="/delete-images/recipe/{{ $recipe->id }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
