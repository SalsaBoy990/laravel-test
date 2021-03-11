@extends('layouts.app')

@section('content')
<div class="bg-home-lightgray mb-3" style="width: 100%">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-9 mt-4">
                <h2>Hello {{ auth()->user()->name }}</h2>


                <h5 class="mt-4">Your Motto</h5>

                <!-- User's motto -->
                <p id="user-motto" class="mb-1">{{ auth()->user()->motto ?? '' }}</p>
                <form action="update-motto/user/{{ auth()->user()->id }}" method="post" class="mb-4"> 
                    @csrf
                    @method('PUT')

                    <div id="user-motto-input" class="form-group">
                        <input type="text" class="form-control {{ $errors->has('motto') ? 'border-danger' : '' }}" id="motto" name="motto" value="{{ auth()->user()->motto }}">
                        <small class="form-text text-danger">{!! $errors->first('motto') !!}</small>
                    </div>

                    <button id="user-motto-edit" type="button" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</button>
                    <input id="user-motto-save" type="submit" class="btn btn-sm btn-primary" value="Save">
                    <button id="user-motto-cancel" type="button" class="btn btn-sm btn-secondary">Cancel</button>
                </form>


                <h5>Your "About Me" - Text</h5>

                <!-- User's about me text -->
                <p id="user-about-me-par" class="mb-1">{{ auth()->user()->about_me ?? '' }}</p>
                <form action="update-about-me/user/{{ auth()->user()->id }}" method="post" class="mb-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-0">
                        <textarea id="user-about-me-textarea" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }}" id="about-me" name="about-me" rows="5">{{ auth()->user()->about_me ?? '' }}</textarea>
                        <small class="form-text text-danger">{!! $errors->first('about-me') !!}</small>
                    </div>
                    <button id="user-about-me-edit" type="button" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</button>
                    <input id="user-about-me-save" type="submit" class="btn btn-sm btn-primary" value="Save">
                    <button id="user-about-me-cancel" type="button" class="btn btn-sm btn-secondary">Cancel</button>
                </form>

            </div>
            <div class="col-md-3">

                <!-- User's profile photo -->
                @if (file_exists('img/users/' . auth()->user()->id . '_large.jpg'))
                <a href="/img/users/{{ auth()->user()->id }}_large.jpg" data-lightbox="img/users/{{ auth()->user()->id }}_large.jpg" data-title="{{ auth()->user()->name }}">
                    <img class="img-fluid" src="/img/users/{{ auth()->user()->id }}_large.jpg" alt="">
                    <i class="fa fa-search-plus"></i> Click image to enlarge
                </a>
                @else
                <img class="img-thumbnail" src="/img/300x400.jpg" alt="Placeholder image">
                @endif

                <form action="upload-images/user/{{ auth()->user()->id }}" method="post" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group" id ="user-image-input"> 
                        <input id="user-profile-image" type="file" class="form-control {{ $errors->has('profile-image') ? 'border-danger' : '' }}" id="profil-image" name="profile-image" value="">
                        <small class="form-text text-danger">{!! $errors->first('profile-image') !!}</small>
                    </div>

                    <button id="user-image-edit" type="button" class="btn btn-sm btn-info float-right mt-2"><i class="fas fa-edit"></i> Edit</button>
                    <input id="user-image-save" type="submit" class="btn btn-sm btn-primary" value="Save">
                    <button id="user-image-cancel" type="button" class="btn btn-sm btn-secondary">Cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="card border-none mt-3">
                <div class="card-header cart-header-page-title uppercase">
                    {{ __('Your recipes') }}
                </div>
               
                <div class="card-body">
                    @isset($recipes)
                        @if ($recipes->count() === 0)
                        <p>A vásárlás után itt fognak megjelenni a receptek</p>
                    @endif  
                    <div class="mt-3">
                        <a class="btn btn-success btn-sm uppercase" href="/recipe/create">
                            <i class="fas fa-plus-circle"></i>
                            {{ __('Create new recipe') }}
                        </a> 
                    </div>
                        <ul class="list-group list-group-no-bullets">  
                        @foreach($recipes as $recipe)
                            <li class="list-group-item mt-1 border-top-0 border-right-0 border-left-0" style="padding: 5px;">
                                @if (file_exists('img/recipes/' . $recipe->id . '_thumb.jpg'))
                                <a title="Show details" class="recipe-title-link" style="font-weight: bold;text-decoration: none !important;" href="/recipe/{{ $recipe->id }}">
                                  <img class="rounded mr-1" src="/img/recipes/{{ $recipe->id }}_thumb.jpg" alt="recipe thumbnail">
                                </a>
                                @endif
                                <a title="Show details" class="recipe-title-link" style="font-weight: bold;" href="/recipe/{{ $recipe->id }}">
                                  {{ $recipe->name }}</a>
                                <br>
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
