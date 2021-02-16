@extends('layouts.app')

@section('page_description')
@section('page_title', 'A projektről')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Info') }}</div>

                <div class="card-body">
                   Information page
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
