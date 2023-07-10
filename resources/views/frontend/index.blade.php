@extends('frontend.include.master')
@section('body')
<!-- blog-slider-->
<section class="blog blog-home4 d-flex align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel">
                    <!--post1-->
                    @foreach ($sliderPost as $slider)
                    <div class="blog-item" style="background-image: url({{asset('uploads/post/'.$slider->image)}})">
                        <div class="blog-banner">
                            <div class="post-overly">
                                <div class="post-overly-content">
                                    <div class="entry-cat">
                                        <a href="{{route('category.post',$slider->category_id)}}" class="category-style-2">{{$slider->category->name}}</a>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{route('details',$slider->slug)}}">{{$slider->title}}</a>
                                    </h2>
                                    <ul class="entry-meta">
                                        <li class="post-author"> <a href="{{route('author.post',$slider->author_id)}}">{{$slider->user->name}}</a></li>
                                        <li class="post-date"> <span class="line"></span>{{$slider->created_at->format('F d,Y')}}</li>
                                        <li class="post-timeread"> <span class="line"></span>{{$slider->created_at->diffForHumans()}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- top categories-->
<div class="categories">
    <div class="container-fluid">
        <div class="categories-area">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="categories-items">
                        @foreach ($categories as $category)
                            <a class="category-item" href="{{route('category.post',$category->id)}}">
                                <div class="image">
                                    <img src="{{asset('uploads/category/'.$category->image)}}" alt="">
                                </div>
                                <p>{{$category->name}} <span>{{App\Models\Post::where('category_id',$category->id)->count()}}</span> </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent articles-->
<section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <div class="section-title">
                        <h3>recent Articles </h3>
                        <p>Discover the most outstanding articles in all topics of life.</p>
                    </div>

                    <!--post1-->
                    @foreach ($recentPost as $recent)
                    <div class="post-list post-list-style4">
                        <div class="post-list-image">
                            <a href="{{route('details',$recent->slug)}}">
                                <img src="{{asset('uploads/post/'.$recent->image)}}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <ul class="entry-meta">
                                <li class="entry-cat">
                                    <a href="{{route('category.post',[$recent->category_id,'category-blog-post'])}}" class="category-style-1">{{$recent->category->name}}</a>
                                </li>
                                @if ($recent->created_at)
                                <li class="post-date"> <span class="line"></span>{{$recent->created_at->format('F d,Y')}}</li>  
                                @endif
                               
                            </ul>
                            <h5 class="entry-title">
                                <a href="{{route('details',$recent->slug)}}">{{$recent->title}}</a>
                            </h5>

                            <div class="post-btn">
                                <a href="{{route('details',$recent->slug)}}" class="btn-read-more">Continue Reading <i
                                        class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>  
                    @endforeach

                    <!--pagination-->
                    {{ $recentPost->links('frontend.pagination.custom') }}
                </div>
            </div>

            <!--Sidebar-->
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
                                    <input type="text" class="search_input2" placeholder="What are you looking?">
                                    <button type="btn" class="search-btn search-btn2"> search</button>
                                </div>
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
                                        @if ($post->post)
                                        <a href="{{route('details',$post->post->slug)}}">
                                            <img src="{{asset('uploads/post/'.$post->post->image)}}" alt="">
                                            <small class="nb">{{ $post->sum }}</small>
                                        </a>
                                        @endif
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            @if ($post->post)
                                            <a href="{{route('details',$post->post->slug)}}">{{$post->post->title}}</a>
                                            @endif
                                        </p>
                                        <small> <span class="slash"></span>{{ optional(optional($post->post)->created_at)->diffForHumans() }}</small>
                                    </div>
                                </li> 
                                @endforeach
                            </ul>
                        </div>

                        <!--newslatter-->
                        <div class="widget widget-newsletter">
                            <h5>Subscribe To Our Newsletter</h5>
                            <p>No spam, notifications only about new products, updates.</p>
                            <form action="#" class="newslettre-form">
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email Adress"
                                            required="required">
                                    </div>
                                    <button class="btn-custom" type="submit">Subscribe now</button>
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
                            <div class="widget-tags">
                                <ul class="list-inline">
                                    @foreach ($tags as $tag)
                                        <li>
                                            <a href="#">{{$tag->name}}</a>
                                        </li>  
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>
</section>
@endsection

@push('js')
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
            })
        </script>
    @endif
@endpush