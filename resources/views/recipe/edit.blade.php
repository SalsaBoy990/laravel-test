@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Recipe</div>
                    <div class="card-body">
                        <form action="/recipe/{{ $recipe->id }}" method="post">
                          @csrf
                          @method('PUT')
                          <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="name" name="name" value="{{ $recipe->name ?? old('name') }}">
                                <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="description" name="description" rows="5">{{ $recipe->description ?? old('description') }}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                              </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save Recipe">
                        </form>
                        <a class="btn btn-primary float-right" href="/recipe"><i class="fas fa-arrow-circle-up"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
