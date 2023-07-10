@extends('admin.master')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('tags.index')}}">tag list</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tag</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Add Tag</div>
                <div class="card-body">
                    <form action="{{route('tags.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Tag" class="btn btn-sm btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection