@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card shadow border-0">
        <div class="card-header cart-header-page-title uppercase">{{ __('Tag Detail') }}</div>
        <div class="card-body">
          <h1>{{ $tag->name }}</h1>
          <p>{{ $tag->description }}</p>
        </div>
      </div>

      <div class="mt-2">
        <a class="btn btn-primary btn-sm" href="/tag"><i class="fas fa-arrow-circle-up"></i>Back to Tag list</a>
      </div>
    </div>
  </div>
</div>
@endsection
