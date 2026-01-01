@extends('layouts.guest')

@section('content')
  <main style="max-width:1100px;margin:2rem auto;padding:0 1rem;">
    <div class="section-header" style="margin-bottom:1rem;">
      <h2 class="section-title">Blog</h2>
      <div class="divider"></div>
    </div>

    @if(isset($posts) && $posts->count())
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1rem;">
        @foreach($posts as $post)
          <article style="border:1px solid rgba(0,0,0,0.06);border-radius:8px;overflow:hidden;background:var(--card-bg);display:flex;flex-direction:column;">
            @if($post->banner_image_url)
              <a href="{{ route('posts.show', $post) }}" style="display:block"><img src="{{ $post->banner_image_url }}" alt="{{ $post->title }}" style="width:100%;height:160px;object-fit:cover;display:block;"></a>
            @endif
            <div style="padding:1rem;flex:1;display:flex;flex-direction:column;justify-content:space-between;">
              <div>
                <a href="{{ route('posts.show', $post) }}" style="color:var(--text);text-decoration:none;font-weight:600;font-size:1.05rem">{{ $post->title }}</a>
                <p style="margin:.5rem 0 0;color:var(--text-faint);font-size:.95rem">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}</p>
              </div>
              <div style="margin-top:1rem;display:flex;justify-content:space-between;align-items:center;">
                <small style="color:var(--text-faint);font-size:.85rem">{{ optional($post->published_at ?? $post->created_at)->format('d M Y') }}</small>
                <a href="{{ route('posts.show', $post) }}" class="btn">Leer</a>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="margin-top:1rem">{{ $posts->links() }}</div>
    @else
      <p class="about-text">No hay entradas aún.</p>
    @endif

  </main>
@endsection
