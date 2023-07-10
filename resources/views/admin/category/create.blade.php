@extends('admin.master')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('categorys.index')}}">Category List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <form action="{{route('categorys.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img width="100" src="" id="blah" alt="">
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Category" class="btn btn-sm btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection