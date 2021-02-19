@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="card">
        <div class="card-header">{{ __('Recipe tags') }}</div>
        <div class="card-body">
          <ul class="list-group">
            @forelse($tags as $tag)
              <li class="list-group-element" style="padding: 5px;">
                <a title="Show details" href="/tag/{{ $tag->id }}">{{ $tag->name }}</a>
                <a href="/tag/{{ $tag->id }}/edit" class="btn btn-sm btn-light ml-2"><i class="fas fa-edit"></i> Edit tag</a>
                <form style="display: inline;" class="float-right" action="/tag/{{ $tag->id }}" method="post">
                  @csrf()
                  @method('DELETE')
                  <input onClick="confirm('Are you sure you want to delete {{ $tag->name }}');" type="submit" value="Delete" class="btn btn-sm btn-outline-danger">
                </form>
              </li>
              @empty
                <li class="list-group-element" style="padding: 5px;">
                You have not added any tags to the list yet...
                </li>
            @endforelse
          </ul>
        </div>
      </div>

      <div class="mt-2">
        <a class="btn btn-success btn-sm" href="/tag/create"><i class="fas fa-plus-circle"></i>Create new tag</a>
      </div>
    </div>
  </div>
</div>
@endsection
