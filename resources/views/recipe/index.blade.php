@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="card">
        <div class="card-header">{{ __('Recipes') }}</div>
        <div class="card-body">
          <ul class="list-group">
            @foreach($recipes as $recipe)
            <li class="list-group-element" style="padding: 5px;">
              <a title="Show details" href="/recipe/{{ $recipe->id }}">{{ $recipe->name }}</a>
              <a href="/recipe/{{ $recipe->id }}/edit" class="btn btn-sm btn-light ml-2"><i class="fas fa-edit"></i> Edit Recipe</a>
              <form style="display: inline;" class="float-right" action="/recipe/{{ $recipe->id }}" method="post">
                @csrf()
                @method('DELETE')
                <input onClick="confirm('Are you sure you want to delete {{ $recipe->name }}');" type="submit" value="Delete" class="btn btn-sm btn-outline-danger">
              </form>
            </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="mt-2">
        <a class="btn btn-success btn-sm" href="/recipe/create"><i class="fas fa-plus-circle"></i>Create new Recipe</a>
      </div>
    </div>
  </div>
</div>
@endsection
