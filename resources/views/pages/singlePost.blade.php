@extends('layouts.app')
@section('content')
<section class="section">
  <div class="py-4"></div>
  <div class="container">
    <div class="row">
      <div
        class="col-lg-8 mb-5 ">
        <article>
            <div class="post-slider mb-4">
                <img src="{{asset('uploads/post/'.$post->thumbnail)}}" class="card-img" alt="post-thumb">
            </div>

            <h1 class="h2">{{$post->title}}</h1>
            <ul class="card-meta my-3 list-inline">
                <li class="list-inline-item">
                    <a href="author-single.html" class="card-meta-author">
                        <img src="images/john-doe.jpg">
                        <span>Charls Xaviar</span>
                    </a>
                </li>
                <li class="list-inline-item">
                    <i class="ti-calendar"></i>{{date('d M Y'), strtotime($post->created_at)}}
                </li>
                <li class="list-inline-item">
                    Category: <span class="text-primary">{{$post->category->name}}</span>
                </li>
            </ul>
            <div class="content">
                <p>{{$post->description}}</p>
            </div>
        </article>

         <div class="mb-5 border-top mt-4 pt-5">
            <h3 class="mb-4">Comments</h3>

            @foreach ($comments as $comment)
                <div class="media d-block d-sm-flex mb-4 pb-4">
                <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                    @auth
                        @if ($comment->user->image)
                        <img src="{{asset('images/users/'.$comment->user->image)}}" alt="" class="rounded-circle" style="height: 30px;">
                        @else
                        <img src="{{asset('images/users/user.png')}}" alt="" class="rounded-circle" style="height: 30px;">
                        @endif
                        @else
                        <img src="{{asset('images/users/user.png')}}" alt="" class="rounded-circle" style="height: 30px;">
                    @endauth 
                    <img src="images/post/user-01.jpg" class="mr-3 rounded-circle" alt="">
                </a>
                <div class="media-body">
                    <a href="#!" class="h4 d-inline-block mb-3">{{$comment->user->name}}</a>

                    <p>
                        @php
                            echo $comment->comment;
                        @endphp
                    </p>
                    <small class="text-black-800 mr-3 font-weight-600">{{date('d M Y'), strtotime($comment->created_at)}}</small>
                    <a class="text-primary font-weight-600" href="#!">Reply</a>
                </div>
            </div>
            @endforeach
            {{$comments->links('pagination::bootstrap-5')}}
            
        </div>

        <div>
            <h3 class="mb-4">Leave a Reply</h3>
            <form action="{{route('comments.store', $post->slug)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <textarea class="form-control shadow-none summernote" name="comment" rows="7" required></textarea>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Comment Now</button>
            </form>
        </div>
      </div>
    <aside class="col-lg-4">
        @include('components.common.sidebar')
    </aside>

    </div>
  </div>
</section>
@endsection()
