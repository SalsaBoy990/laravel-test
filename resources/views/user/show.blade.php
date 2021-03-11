@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header cart-header-page-title uppercase">{{ $user->name }}</div>
        <div class="card-body">
          <h1>{{ $user->name }}</h1>
          <p class="medium gray-6">{{ $user->email }}</p>
          <p class="medium gray-9">Motto: <i>"{{ $user->motto }}"</i></p>

          <h2 class="small gray-6 mt-4 mb-2 uppercase">About me</h2>
          <p class="gray-3">{{ $user->about_me }}</p>

          <h2 class="gray h5">Your recipes</h3> 

          <ul class="list-group list-group-no-bullets">  
            @foreach($recipes as $recipe)
            <li class="list-group-item mt-1" style="padding: 5px;">
                @if (file_exists('img/recipes/' . $recipe->id . '_thumb.jpg'))
                <a title="Show details" class="recipe-title-link" style="font-weight: bold;text-decoration: none !important;" href="/recipe/{{ $recipe->id }}">
                  <img class="rounded mr-1" src="/img/recipes/{{ $recipe->id }}_thumb.jpg" alt="recipe thumbnail">
                </a>
                @endif
                <a title="Show details" class="recipe-title-link" style="font-weight: bold;" href="/recipe/{{ $recipe->id }}">
                  {{ $recipe->name }}</a>
                <br>
              <span style="font-size: 12px; color: #999;">{{ $recipe->created_at->diffForHumans() }}</span>
              <br>
              @foreach ($recipe->tags as $tag)
                <a href="/recipe/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a> 
              @endforeach
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      @if (Auth::user() && file_exists('img/users/' . $user->id . '_large.jpg'))   
      <img class="img-thumbnail" src="/img/users/{{ $user->id }}_large.jpg" alt="{{ $user->name }}">
      <i class="fa fa-search-plus"></i> Click image to enlarge
      @endif

      @if ( !Auth::user() && file_exists('img/users/' . $user->id . '_pixelated.jpg'))
        <img class="img-thumbnail" src="/img/users/{{ $user->id }}_pixelated.jpg" alt="{{ $user->name }}">
      @endif
    </div>
  </div>
</div>
@endsection
