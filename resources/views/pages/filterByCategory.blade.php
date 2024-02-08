@extends('layouts.app')
@section('content')
<section class="section">
  <div class="py-4"></div>
  <div class="container">
    <div class="row">
      <div
        class="col-lg-8  mb-5 mb-lg-0">
        <h1 class="h2 mb-4">Showing items from <mark>{{$posts->first()->name}}</mark></h1>
        @foreach($posts as $post)
            @if($post->post == null)
                <div class="col-lg-10 text-center my-5">
                    <img class="my-5" src="{{asset('frontendAssets/images/no-search-found.svg')}}" alt="">
                    <h3>Posts not found in this category</h3>
                </div>
            @else
                <article class="card mb-4">
                    <div class="post-slider">
                        <img src="{{asset('uploads/post/'.$post->post->thumbnail)}}" class="card-img-top" alt="post-thumb">
                    </div>
                    <div class="card-body">
                        <h3 class="mb-3"><a class="post-title" href="{{route('single_post', $post->slug)}}">{{$post->title}}</a></h3>
                        <ul class="card-meta list-inline">
                            <li class="list-inline-item">
                                <a href="author-single.html" class="card-meta-author">
                                    <img src="{{asset('frontendAssets/images/john-doe.jpg')}}">
                                    <span>Mark Dinn</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-calendar"></i>{{date('d M Y'), strtotime($post->post->created_at)}}
                            </li>
                            <li class="list-inline-item">
                                Category: <span class="text-primary">{{$post->name}}</span>
                            </li>
                        </ul>
                        <p>{{Str::words($post->post->description, 40)}}</p>
                        <a href="{{route('single_post', $post->post->slug)}}" class="btn btn-outline-primary">Read More</a>
                    </div>
                </article>
            @endif
                        
        @endforeach
      </div>
      @include('components.common.sidebar')
    </div>
  </div>
</section>
@endsection()