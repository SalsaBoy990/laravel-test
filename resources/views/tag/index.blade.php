@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="card">
        <div class="card-header">{{ __('Recipe tags') }}</div>
        <div class="card-body">
          @auth
          <div class="mt-1 mb-5">
            <a class="btn btn-success btn-sm uppercase" href="/tag/create"><i class="fas fa-plus-circle"></i>Create new tag</a>
          </div>
          @endauth
          <ul class="list-group list-group-no-bullets">
            @forelse($tags as $tag)
              <li class="list-group-element" style="padding: 5px;">
                <a title="Show details" href="/tag/{{ $tag->id }}" class="btn btn-sm btn-{{ $tag->style ?? 'secondary' }} tag-btn">{{ $tag->name }}</a>
                <a href="/recipe/tag/{{ $tag->id }}" class="ml-2 mr-2 medium">
                  {{ $tag->recipes->count() }} recept
                </a>

                @auth
                <form style="display: inline;" class="float-right" action="/tag/{{ $tag->id }}" method="post">
                  @csrf()
                  @method('DELETE')
                  <button onClick="confirm('Are you sure you want to delete {{ $tag->name }}');" type="submit" class="btn btn-sm btn-outline-danger uppercase">
                    <i class="fas fa-trash"></i> Delete
                  </button>
                    <a href="/tag/{{ $tag->id }}/edit" class="btn btn-sm btn-light ml-2"><i class="fas fa-edit"></i> Edit</a>
                </form>
                @endauth

              </li>
              @empty
                <li class="list-group-element" style="padding: 5px;">
                You have not added any tags to the list yet...
                </li>
            @endforelse
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
