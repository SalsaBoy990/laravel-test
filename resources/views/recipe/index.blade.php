@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card shadow border-0">
      @isset($filter)
      <div class="card-header">{{ __('Filtered recipes by') }} <span class="badge badge-{{ $filter->style }}">{{ $filter->name }}</span>
        <a href="/recipe" class="float-right medium">{{ __('Show all recipes') }}</a>
      </div>
      @else
      <div class="card-header cart-header-page-title uppercase">{{ __('Recipes') }}</div>
      @endisset
        <div class="card-body">
          @auth
          <div class="mt-1 mb-4">
            <a class="btn btn-success btn-sm uppercase" href="/recipe/create"><i class="fas fa-plus-circle"></i>Create new Recipe</a>
          </div>
          @endauth
          <ul class="list-group list-group-no-bullets">
            @foreach($recipes as $recipe)
            <li class="list-group-item mt-1 border-top-0 border-right-0 border-left-0" style="padding: 5px;">
              @if (file_exists('img/recipes/' . $recipe->id . '_thumb.jpg'))
              <a title="Show details" class="recipe-title-link" style="font-weight: bold;text-decoration: none !important;" href="/recipe/{{ $recipe->id }}">
                <img class="rounded mr-1" src="/img/recipes/{{ $recipe->id }}_thumb.jpg" alt="recipe thumbnail">
              </a>
              @endif
              <h2 class="h3" style="display: inline-block">
              <a title="Show details" class="recipe-title-link" style="font-weight: bold;" href="/recipe/{{ $recipe->id }}">
                {{ $recipe->name }}</a>
              </h2>
              <br>
              <span class="small">
                  by: <a href="/user/{{ $recipe->user_id }}">{{ $recipe->user->name }}</a><span style="font-size: 10px;"> ({{ $recipe->user->recipes->count() }} Recipes)</span></span>
            </span>
            @if (file_exists('img/users/' . $recipe->user_id . '_thumb.jpg'))
            <a title="Show details" class="recipe-title-link" style="font-weight: bold;text-decoration: none !important;" href="/user/{{ $recipe->user_id }}">
              <img class="rounded mr-1" src="/img/users/{{ $recipe->user_id }}_thumb.jpg" alt="author thumbnail">
            </a>
            @endif

              @auth
              <form style="display: inline;" class="float-right" action="/recipe/{{ $recipe->id }}" method="post">
                @csrf()
                @method('DELETE')
                <button onClick="confirm('Are you sure you want to delete {{ $recipe->name }}');" type="submit" class="btn btn-sm btn-warning uppercase">
                 <i class="fas fa-trash"></i> Delete
                </button>
                <a href="/recipe/{{ $recipe->id }}/edit" class="btn btn-sm btn-info mr-2 uppercase"><i class="fas fa-edit"></i> Edit</a>
              </form>
              @endauth
              <br>
              <span style="font-size: 12px">{{ $recipe->created_at->diffForHumans() }}</span>
              <br>
              @foreach ($recipe->tags as $tag)
                <a href="/recipe/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a> 
              @endforeach
            </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="mt-5">
        {{ $recipes->links() }}
      </div>

    </div>
  </div>
</div>
@endsection
