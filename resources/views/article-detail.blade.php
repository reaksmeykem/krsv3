@extends('master')
@section('content')
<div class="py-20">
    @livewire('front.article-detail', ['post' => $post])
</div>
@endsection
