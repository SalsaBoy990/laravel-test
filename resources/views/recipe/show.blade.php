@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="card">
        <div class="card-header cart-header-page-title uppercase">{{ __('Recipe Detail') }}</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">
              <h1>{{ $recipe->name }}</h1>
              <p>{{ $recipe->description }}</p>
    
              @if ($recipe->tags->count() > 0)
                <small>Used tags: (Click to remove)</small>
                <p>
                  @foreach ($recipe->tags as $tag)
                  <a href="/recipe/{{ $recipe->id }}/tag/{{ $tag->id }}/detach"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a> 
                  @endforeach
                </p>
              @endif
              @if ($availableTags->count() > 0)
                <small>Available tags: (Click to add)</small>
                <p>
                  @foreach ($availableTags as $tag)
                  <a href="/recipe/{{ $recipe->id }}/tag/{{ $tag->id }}/attach"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a> 
                  @endforeach
                </p>
              @endif
            </div>
            <div class="col-md-3">
              @if (Auth::user() && file_exists('img/recipes/' . $recipe->id . '_large.jpg'))   
              <a href="/img/recipes/{{ $recipe->id }}_large.jpg" data-lightbox="img/recipes/{{ $recipe->id }}_large.jpg" data-title="{{ $recipe->name }}">
                <img class="img-fluid" src="/img/recipes/{{ $recipe->id }}_large.jpg" alt="">
                <i class="fa fa-search-plus"></i> Click image to enlarge
              </a>
              @endif

              @if ( !Auth::user() && file_exists('img/recipes/' . $recipe->id . '_pixelated.jpg'))
                <img class="img-fluid" src="/img/recipes/{{ $recipe->id }}_pixelated.jpg" alt="">
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="mt-2">
        <a class="btn btn-primary btn-sm uppercase" href="{{ URL::previous() === URL::current() ? '/recipe' : URL::previous() }}"><i class="fas fa-arrow-circle-up"></i>Back to Recipe List</a>
      </div>
    </div>
  </div>
</div>
@endsection
