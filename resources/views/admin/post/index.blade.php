@extends('admin.master')
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
    </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
            @if (session('success'))
              <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card-body">
              <h6 class="card-title">Data Table</h6>
              <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                      <thead>
                        <tr>
                          <th>Si</th>
                          <th>Category</th>
                          <th>Title</th>
                          <th>Tags</th>
                          <th>Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($posts as $key=>$post)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>
                            @if (App\Models\Category::where('id',$post->category_id)->exists())
                              {{$post->Category->name}}
                            @else
                              unknown
                            @endif
                          </td>
                          <td>{{$post->title}}</td>
                          <td>
                            @php
                              $tagId = explode(',',$post->tag_id);
                              $tags = App\Models\Tag::whereIn('id',$tagId)->get();
                            @endphp
                            @foreach ($tags as $tag)
                              <span class="badge badge-primary">{{ $tag->name }}</span>
                            @endforeach
                          </td>
                          <td>
                            <img width="100" src="{{asset('uploads/post/'.$post->image)}}" alt="">
                          </td>
                          <td>
                            <div class="dropdown mb-2">
                              <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item d-flex align-items-center" href="{{route('posts.show',$post->id)}}"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>

                                  <a class="dropdown-item d-flex align-items-center" href="{{route('posts.edit',$post->id)}}"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>

                                  <form action="{{route('posts.destroy',$post->id)}}" method="POST" onsubmit="return confirm('Are you delete this!')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="dropdown-item d-flex align-items-center" href=""><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></button>
                                  </form>
                                  
                                </div>
                              </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
            </div>
        </div>
      </div>
  </div>
</div>
@endsection