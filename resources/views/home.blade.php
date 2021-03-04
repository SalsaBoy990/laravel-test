@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h2>{{ Auth::user()->name }}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mt-3">
                        <a class="btn btn-success btn-sm uppercase" href="/recipe/create">
                            <i class="fas fa-plus-circle"></i>
                            {{ __('Create new recipe') }}
                        </a> 
                    </div>

                    <div>
                        @isset($recipes)
                            @if ($recipes->count() > 0)
                            <h3 class="gray h5">Your recipes</h3> 
                            @endif
                        <ul class="list-group list-group-no-bullets">  
                            @foreach($recipes as $recipe)
                            <li class="list-group-element mt-1" style="padding: 5px;">
                              <a title="Show details" class="recipe-title-link" style="font-weight: bold;" href="/recipe/{{ $recipe->id }}">{{ $recipe->name }}</a>
                              <br>
                              @auth
                              <form style="display: inline;" class="float-right" action="/recipe/{{ $recipe->id }}" method="post">
                                @csrf()
                                @method('DELETE')
                                <button onClick="confirm('Are you sure you want to delete {{ $recipe->name }}');" type="submit" class="btn btn-sm btn-outline-danger uppercase">
                                 <i class="fas fa-trash"></i> Delete
                                </button>
                                <a href="/recipe/{{ $recipe->id }}/edit" class="btn btn-sm btn-light mr-2 uppercase"><i class="fas fa-edit"></i> Edit</a>
                              </form>
                              @endauth
                              <br>
                              <span style="font-size: 12px; color: #999;">{{ $recipe->created_at->diffForHumans() }}</span>
                              <br>
                              @foreach ($recipe->tags as $tag)
                                <a href="/recipe/tag/{{ $tag->id }}"><span class="badge badge-{{ $tag->style }}">{{ $tag->name }}</span></a> 
                              @endforeach
                            </li>
                            @endforeach
                          </ul>
                          @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
