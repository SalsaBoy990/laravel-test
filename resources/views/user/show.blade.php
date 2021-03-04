@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header">{{ $user->name }}</div>
        <div class="card-body">
          <h1>{{ $user->name }}</h1>
          <p class="medium gray-6">{{ $user->email }}</p>
          <p class="medium gray-9">Motto: <i>"{{ $user->motto }}"</i></p>

          <h2 class="small gray-6 mt-4 mb-2 uppercase">About me</h2>
          <p class="gray-3">{{ $user->about_me }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
