@extends('admin.master')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Forms</a></li>
        <li class="breadcrumb-item active" aria-current="page">Basic Elements</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add New Post</h6>
                <form class="forms-sample" action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <select name="category_id" id="">
                            <option value="">--select category--</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="title">
                    </div>
                    <div class="form-group">
                        <label for="">Short Description</label>
                        <input type="text" class="form-control" name="short_desp" placeholder="short-description">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="summernote" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>select tag</h4>
                        @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" name="tag_id[]" value="{{$tag->id}}" class="form-check-input">
                                        {{$tag->name}}
                                <i class="input-frame"></i></label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" required name="image" class="form-control" placeholder="title">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Add Post</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection