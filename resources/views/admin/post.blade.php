@extends('admin.layouts.app')
@php
    $page = "Dashboard / All Posts"
@endphp
@section('title', 'Posts')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header d-flex align-items-center justify-content-between">
                    <span>Posts List</span>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPost">Add Post</button>
                </h5>
                <div class="table-responsive text-nowrap mb-2">
                    @if ($posts->isEmpty())
                        <h6 class="text-center py-2">No Record Found. Please inster a new record</h6>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Post Title</th>
                                <th>Thumbnail</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Category </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($posts as $id => $post)
                                <tr>
                                    <td>
                                        <span class="fw-medium">{{++$id}}</span>
                                    </td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        <img src="{{asset('uploads/post/'.$post->thumbnail)}}" alt="{{$post->thumbnail}}" width="45" height="45">
                                    </td>
                                    <td>{{$post->slug}}</td>
                                    <td class="w-50">{{$post->description}}</td>
                                    <td>{{$post->category->name}}</td>
                                    <td>
                                        @if ($post->status == 1)
                                            <span class="badge bg-label-primary me-1">Published</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="{{'#edit'.$post->id.'Post'}}">
                                                    <i class="ti ti-pencil me-1"></i> Edit
                                                </button>
                                                <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item delete">
                                                        <i class="ti ti-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Edit Category Model Start --}}
                                <div class="modal fade" id="{{'edit'.$post->id.'Post'}}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="modalCenterTitle">Add Post</h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="title" class="form-label">Post Title</label>
                                                            <input
                                                                type="text"
                                                                id="title"
                                                                name="title"
                                                                class="form-control @error('title') is-invalid @enderror"
                                                                placeholder="Enter your post title"
                                                                value="{{$post->title}}"/>
                                                            @error('title')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="slug" class="form-label">Post Slug</label>
                                                            <input
                                                                type="text"
                                                                id="slug"
                                                                name="slug"
                                                                class="form-control  @error('slug') is-invalid @enderror"
                                                                placeholder="Enter your category slug"
                                                                value="{{$post->slug}}" />
                                                            @error('slug')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description">{{$post->description}}</textarea>
                                                            @error('description')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="category_id">Post Category</label>
                                                            <select
                                                                class="form-select"
                                                                name="category_id"
                                                                id="category_id"
                                                            >
                                                                <option selected disabled>Select Category</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}" @if ($category->id == $post->category_id)
                                                                        selected
                                                                    @endif>{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="status">Status</label>
                                                            <select
                                                                class="form-select"
                                                                name="status"
                                                                id="status"
                                                            >
                                                                <option selected disabled>Select Status</option>
                                                                <option value="0" @if ($post->status == 0)
                                                                    selected
                                                                @endif>Draft</option>
                                                                <option value="1" @if ($post->status == 1)
                                                                    selected
                                                                @endif>Published</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-0">
                                                            <label for="thumbnail">Post Thumbnail</label>
                                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                                            <input type="hidden" name="old_thumbnail" value="{{$post->thumbnail}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit category Modal end --}}
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- Add Category Model Start --}}
    <div class="modal fade" id="addPost" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="modalCenterTitle">Add Post</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="title" class="form-label">Post Title</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Enter your post title"
                                    value="{{old('title')}}"/>
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="slug" class="form-label">Post Slug</label>
                                <input
                                    type="text"
                                    id="slug"
                                    name="slug"
                                    class="form-control  @error('slug') is-invalid @enderror"
                                    placeholder="Enter your category slug"
                                    value="{{old('slug')}}" />
                                @error('slug')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description"></textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="category_id">Post Category</label>
                                <select
                                    class="form-select"
                                    name="category_id"
                                    id="category_id"
                                >
                                    <option selected disabled>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label for="status">Status</label>
                                <select
                                    class="form-select"
                                    name="status"
                                    id="status"
                                >
                                    <option selected disabled>Select Status</option>
                                    <option value="0">Draft</option>
                                    <option value="1">Published</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-0">
                                <label for="thumbnail">Post Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add category Modal end --}}
@endsection()
