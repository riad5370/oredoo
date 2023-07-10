@extends('frontend.include.master')
@section('body')
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>All</h1>
                         <p class="links"><a href="{{route('index')}}">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>  
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12"> 
                 <!--post 1-->
                 @forelse ($posts as $post)
                 <div class="post-list post-list-style2">
                    <div class="post-list-image">
                        <a href="{{route('details',$post->slug)}}">
                            <img src="{{asset('uploads/post/'.$post->image)}}" alt="">
                        </a>
                    </div>
                    <div class="post-list-content">
                        <h3 class="entry-title">
                            <a href="{{route('details',$post->slug)}}">{{$post->title}}</a>
                        </h3>  
                        <ul class="entry-meta">
                            <li class="post-author-img">
                                @if ($post->user->image == null)
                                <img src="{{ Avatar::create($post->user->name)->toBase64() }}" />
                                @else
                                <img src="{{asset('uploads/user/'.$post->user->image)}}" alt="">
                                @endif
                            </li>
                            <li class="post-author"> <a href="{{route('author.post',$post->author_id)}}">{{$post->user->name}}</a></li>
                            <li class="entry-cat"> <a href="{{route('category.post',[$post->category_id,'category-blog-post'])}}" class="category-style-1 "> <span class="line"></span>{{$post->category->name}}</a></li>
                            <li class="post-date"> <span class="line"></span>{{$post->created_at->format('F d,Y')}}</li>
                        </ul>
                        <div class="post-exerpt">
                            <p>{{$post->short_desp}}</p>
                        </div>
                        <div class="post-btn">
                            <a href="{{route('details',$post->slug)}}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div> 
                @empty
                    <div class="text-center my-3">
                        <h3 class="text-danger">No Post Found</h3>
                    </div>
                @endforelse       
             </div>
         </div>
     </div>
 </section>

 
<!--pagination-->
{{ $posts->links('frontend.pagination.custom') }}

@endsection