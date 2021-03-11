@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow border-0">
                    <div class="card-header cart-header-page-title uppercase">Update Tag</div>
                    <div class="card-body">
                        <form action="/tag/{{ $tag->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="name" name="name" value="{{ old('name') ?? $tag->name }}">
                                <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="description" name="description" rows="5">{{ old('description') ?? $tag->description  }}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="style">Style</label>
                                <select name="style" id="style" class="form-control {{ $errors->has('style') ? 'border-danger' : '' }}">
                                    @foreach ($uniqueTags as $tagStyle)
                                    <option value="{{ $tagStyle }}" {{ $tag->style === $tagStyle ? 'selected' : '' }}>{{ $tagStyle }}</option>  
                                    @endforeach
                                </select>
                                <small class="form-text text-danger">{!! $errors->first('style') !!}</small>
                            </div>

                            <input class="btn btn-primary mt-4" type="submit" value="Update Tag">
                            <a class="btn btn-secondary mt-4 ml-2" href="/tag">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
