@extends('master')
@section('content')
    @livewire('front.post-detail', ['post' => $post])
@endsection
