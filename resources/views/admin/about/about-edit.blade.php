@extends('admin.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="card-header">
                    <h3>Edit About</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('about.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$about->first()->id}}">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{$about->first()->title}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea cols="40" rows="10" name="description" class="form-control">{{$about->first()->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"><br>
                            <img width="400" id="blah" src="{{asset('uploads/about/'.$about->first()->image)}}" alt="">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection