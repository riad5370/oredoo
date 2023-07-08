@extends('frontend.include.master')
@section('body')
<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
        <div class="section-heading-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading-2-title text-left">
                        <h2>Search resultats for : {{ @$_GET['q'] }}</h2>
                        <p class="desc">{{$searchPost->count()}} Articles were found for keyword  <strong>{{@$_GET['q']}}</strong></p>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>


<!--blog-layout-1-->
<div class="blog-search">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                 <!--Post1-->
                 @forelse ($searchPost as $search)
                    <div class="post-list post-list-style1 pt-0">
                        <div class="post-list-image">
                            <a href="{{route('details',$search->slug)}}">
                                <img src="{{asset('uploads/post/'.$search->image)}}" alt="">
                            </a>
                        </div>
                        <div class="post-list-title">
                            <div class="entry-title">
                                <h5>
                                    <a href="{{route('details',$search->slug)}}">{{$search->title}}</a>
                                </h5>
                            </div>
                        </div>
                        <div class="post-list-category">
                            <div class="entry-cat">
                                <a href="{{route('category.post',$search->category_id)}}"" class="category-style-1">{{$search->category->name}}</a>
                            </div>
                        </div>
                    </div> 
                 @empty
                    <div class="post-list-title">
                        <div class="entry-title">
                            <h5>
                                No Search Result Found
                            </h5>
                        </div>
                    </div>
                 @endforelse
                <!--pagination-->
                {{ $searchPost->links('frontend.pagination.custom') }}
                <!--/-->
                </div>
            </div>

             <!--sidebar-->
            <div class="col-lg-4 oredoo-sidebar">
                <div class="theiaStickySidebar">
                    <div class="sidebar">
                        <!--search-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Search</h5>
                            </div>
                            <div class=" widget-search">
                                <div class="search-form">
                                    <input type="text" class="search_input3" placeholder="What are you looking?">
                                    <button type="btn" class="search-btn search-btn3"> search</button>
                                </div>
                            </div>
                        </div>

                       <!--categories-->
                       <div class="widget ">
                        <div class="widget-title">
                            <h5>Categories</h5>
                        </div>
                        <div class="widget-categories">
                            @foreach ($categories as $category)
                                <a class="category-item" href="{{route('category.post',$category->id)}}">
                                    <div class="image">
                                        <img src="{{asset('uploads/category/'.$category->image)}}" alt="">
                                    </div>
                                    <p>{{$category->name}}</p>
                                </a> 
                            @endforeach 
                        </div>
                    </div>
                        <!--newslatter-->
                        <div class="widget widget-newsletter">
                            <h5>Subscribe To Our Newsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress" required="required">
                                    </div>
                                    <button class="btn-custom" type="submit">
                                    Subscribe now
                                    
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!--stay connected-->
                        <div class="widget ">
                            <div class="widget-title">
                                <h5>Stay connected</h5>
                            </div>
                            
                            <div class="widget-stay-connected">
                                <div class="list">
                                    <div class="item color-facebook">
                                        <a href="#"><i class="fab fa-facebook"></i></a>
                                        <p>Facebook</p>
                                    </div>

                                    <div class="item color-instagram">
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <p>instagram</p>
                                    </div>

                                    <div class="item color-twitter">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <p>twitter</p>
                                    </div>

                                    <div class="item color-youtube">
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                        <p>Youtube</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--Tags-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Tags</h5>
                            </div>
                            <div class="tags">
                                <ul class="list-inline">
                                    @foreach ($tags as $tag)
                                        <li>
                                            <a href="#">{{$tag->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
        
                        <!--popular-posts-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>popular Posts</h5>
                            </div>
                            <ul class="widget-popular-posts">
                                <!--post1-->
                                @foreach ($popular_posts as $post)
                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="{{route('details',$post->post->slug)}}">
                                            <img src="{{asset('uploads/post/'.$post->post->image)}}" alt="">
                                            <small class="nb">{{ $post->sum }}</small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="{{route('details',$post->post->slug)}}">{{$post->post->title}}</a>
                                        </p>
                                        <small> <span class="slash"></span>      {{$post->post->created_at->diffForHumans()}}</small></small>
                                    
                                    </div>
                                </li>  
                                @endforeach
                                

                            </ul>
                        </div>
                        
                        <!--Ads-->
                        <div class="widget">
                            <div class="widget-ads">
                                <img src="{{asset('frontend')}}/assets/img/ads/ads2.jpg" alt="">
                            </div>
                        </div>
                        <!--/-->
                    </div>
               </div>
            </div>
            <!--/-->
        </div>
    </div>
</div>

@endsection