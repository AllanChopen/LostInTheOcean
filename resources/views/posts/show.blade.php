@extends('layouts.guest')

@section('content')
  <main class="post-page">
    @if(!empty($post->banner_image_url))
      <div class="post-banner">
        <img src="{{ $post->banner_image_url }}" alt="{{ $post->title }}">
      </div>
    @endif

    <h1 class="post-title">{{ $post->title }}</h1>
    <div class="post-meta">
      @php
        $date = $post->published_at ?? $post->created_at;
      @endphp
      Publicado: {{ $date->locale('es')->isoFormat('D MMM YYYY') }}
    </div>

    <article class="post-content">
      {!! nl2br(e($post->content)) !!}
    </article>
    <div style="margin-top:1rem"><a href="{{ route('posts.index') }}" class="btn">Ver más blogs</a></div>
  </main>
@endsection
