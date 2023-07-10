@extends('admin.master')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('tags.index')}}">Tag</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tag Edit</li>
    </ol>
</nav>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Edit Tag</div>
            <div class="card-body">
                <form action="{{route('tags.update',$tag->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{($tag->name)}}" class="form-control">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-sm btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection