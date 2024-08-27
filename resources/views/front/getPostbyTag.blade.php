@extends('master')
@section('content')
    @livewire('get-post-by-tag', ['tag' => $tag])
@endsection
