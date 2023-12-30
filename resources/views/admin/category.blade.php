@extends('admin.layouts.app')
@php
    $page = "Dashboard / All Categories"
@endphp
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex align-items-center justify-content-between">
                <span>Categories List</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">Add Category</button>
            </h5>
        <div class="table-responsive text-nowrap mb-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($categories->isEmpty())
                    <h6 class="text-center py-2">No Record Found. Please inster a new record</h6>
                    @else
            <table class="table table-striped">
            <thead>
                <tr>
                <th>S.N</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                     @foreach ($categories as $id => $category)
                     <tr>
                        <td>
                            <span class="fw-medium">{{++$id}}</span>
                        </td>
                        <td>{{$category->name}}</td>
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
                                <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="ti ti-pencil me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="ti ti-trash me-1"></i> Delete</a
                                >
                            </div>
                            </div>
                        </td>
                </tr>
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
                                class="form-control"
                                placeholder="Enter your category Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="slug" class="form-label">Category Slug</label>
                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                class="form-control"
                                placeholder="Enter your category slug" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
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
                                <option selected>Select Status</option>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
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
{{-- Add category Modal end --}}


@endsection()