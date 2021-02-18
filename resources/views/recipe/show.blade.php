@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="card">
        <div class="card-header">{{ __('Recipe Detail') }}</div>
        <div class="card-body">
          <h1>{{ $recipe->name }}</h1>
          <p>{{ $recipe->description }}</p>
        </div>
      </div>

      <div class="mt-2">
        <a class="btn btn-primary btn-sm" href="/recipe"><i class="fas fa-arrow-circle-up"></i>Back to Recipe List</a>
      </div>
    </div>
  </div>
</div>
@endsection