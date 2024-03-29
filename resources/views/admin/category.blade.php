@extends('admin.layouts.app')
@php
    $page = "Dashboard / All Categories"
@endphp
@section('title', 'Categories')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header d-flex align-items-center justify-content-between">
                    <span>Categories List</span>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">Add Category</button>
                </h5>
                <div class="table-responsive text-wrap mb-2">
                    @if ($categories->isEmpty())
                        <h6 class="text-center py-2">No Record Found. Please inster a new record</h6>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr class="text-center">
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($categories as $id => $category)
                                <tr class="text-center">
                                    <td>
                                        <span class="fw-medium">{{++$id}}</span>
                                    </td>
                                    <td>{{ucfirst($category->name)}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>
                                        @if ($category->status == 1)
                                            <span class="badge bg-label-primary me-1">Active</span>
                                        @else
                                            <span class="badge bg-label-danger me-1">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="{{'#edit'.$category->id.'Category'}}">
                                                    <i class="ti ti-pencil me-1"></i> Edit
                                                </button>
                                                <form action="{{route('categories.destroy', $category->id)}}" method="POST">
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
                                <div class="modal fade" id="{{'edit'.$category->id.'Category'}}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="modalCenterTitle">Edit Category</h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('categories.update', $category->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="name" class="form-label">Category Name</label>
                                                            <input
                                                                type="text"
                                                                id="name"
                                                                name="name"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                plaslugceholder="Enter your category Name"
                                                                value="{{$category->name}}"/>
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="slug" class="form-label">Category Slug</label>
                                                            <input
                                                                type="text"
                                                                id="slug"
                                                                name="slug"
                                                                class="form-control  @error('slug') is-invalid @enderror"
                                                                placeholder="Enter your category slug"
                                                                value="{{$category->slug}}" />
                                                            @error('slug')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea class="form-control  @error('description') is-invalid @enderror" name="description" id="description">{{$category->description}}</textarea>
                                                            @error('description')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-0">
                                                            <label for="status">Status</label>
                                                            <select
                                                                class="form-select"
                                                                name="status"
                                                                id="status"
                                                            >
                                                                <option disabled>Select Status</option>
                                                                <option value="0" @if($category->status == 0) selected @endif>Inactive</option>
                                                                <option value="1" @if($category->status == 1) selected @endif>Active</option>
                                                            </select>
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
    <div class="modal fade" id="addCategory" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="modalCenterTitle">Add Categry</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{route('categories.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    plaslugceholder="Enter your category Name"
                                    value="{{old('name')}}"/>
                                @error('name')
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
