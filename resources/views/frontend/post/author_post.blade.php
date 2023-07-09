@extends('frontend.include.master')
@section('body')
<section class="authors">
    <div class="container-fluid">
        <div class="row">  
            <!--author-image-->
            <div class="col-lg-12 col-md-12 ">
                    <div class="authors-info">
                    <div class="image">
                        <a href="author.html" class="image">
                            @if ($authorInfo->image == null)
                            <img src="{{ Avatar::create($authorInfo->name)->toBase64() }}" />
                            @else
                            <img src="{{ asset('uploads/user/'.$authorInfo->image) }}" alt="">
                            @endif
                        </a>
                    </div>
                    <div class="content">
                        <h4 >{{$authorInfo->name}}</h4>
                        <p>
                             Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
                            Quis sem justo nisi varius.
                        </p>
                        <div class="social-media">
                            <ul class="list-inline">
                                <li>
                                    <a href="#">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
    </div>
</section>

<!-- blog-author-->
<section class="blog-author mt-30">
    <div class="container-fluid">
        <div class="row">
            <!--content-->
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <!--post1-->
                    @foreach ($authorPost as $post)
                    <div class="post-list post-list-style4 pt-0"> 
                        <div class="post-list-image">
                            <a href="{{route('details',$post->slug)}}">
                                <img src="{{asset('uploads/post/'.$post->image)}}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <ul class="entry-meta"> 
                                <li class="entry-cat">
                                    <a href="{{route('category.post',[$post->category_id,'category-blog-post'])}}" class="category-style-1">{{$post->category->name}}</a>
                                </li>
                                <li class="post-date"> <span class="line"></span>{{$post->created_at->format('F d,Y')}}</li>
                            </ul>
                            <h5 class="entry-title">
                                <a href="{{route('details',$post->slug)}}">{{$post->title}}</a>
                            </h5>  
                            <div class="post-btn">
                                <a href="{{route('details',$post->slug)}}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--/-->
                    <!--pagination-->
                    {{ $authorPost->links('frontend.pagination.custom') }}
                </div>
            </div>
            <!--/-->
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
                                    <input type="text" class="search_input4" placeholder="What are you looking?">
                                    <button type="btn" class="search-btn search-btn4"> search</button>
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
                            <h5>Subscribe To OurNewsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress" required="required">
                                    </div>
                                    <button class="btn-custom" type="submit"> Subscribe now</button>
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
                                             <small class="nb">{{$post->sum}}</small>
                                         </a>
                                    </div>
                                    <div class="small-post-content">
                                         <p>
                                             <a href="{{route('details',$post->post->slug)}}">{{$post->post->title}}</a>
                                         </p>
                                         <small> <span class="slash"></span>{{$post->post->created_at->diffForHumans()}}</small>
                                    </div>
                                 </li>  
                                @endforeach
                                
                             </ul>
                         </div>

                         <!--/-->
                     </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>

</section>
@endsection