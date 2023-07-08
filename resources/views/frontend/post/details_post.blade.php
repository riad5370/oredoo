@extends('frontend.include.master')
@section('body')
<section class="post-single">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-12">
                <!--post-single-image-->
                    <div class="post-single-image">
                        <img src="{{asset('uploads/post/'.$detailsPost->image)}}" alt="">
                    </div>
                      
                    <div class="post-single-body">
                        <!--post-single-title-->
                        <div class="post-single-title">  
                            <h2>{{$detailsPost->title}}</h2>        
                            <ul class="entry-meta">
                                <li class="post-author-img">
                                    @if ($detailsPost->user->image == null)
                                    <img src="{{ Avatar::create($detailsPost->user->name)->toBase64() }}" />
                                    @else 
                                    <img src="{{asset('uploads/user/'.$detailsPost->user->image)}}" alt="">
                                    @endif 
                                </li>
                                <li class="post-author"> <a href="{{route('author.post',$detailsPost->author_id)}}">{{$detailsPost->user->name}}</a></li>
                                <li class="entry-cat"> <a href="{{ route('category.post', [$detailsPost->category_id, 'category-blog-post']) }}" class="category-style-1 "> <span class="line"></span> {{$detailsPost->category->name}}</a></li>
                                <li class="post-date"> <span class="line"></span>{{$detailsPost->created_at->format('F d,Y')}}</li>
                            </ul>
                            
                        </div>

                        <!--post-single-content-->
                        <div class="post-single-content">
                            <p>
                                {!! $detailsPost->description !!}
                            </p>
                            
                            
                        </div>
                        
                        <!--post-single-bottom-->
                        <div class="post-single-bottom"> 
                            <div class="tags">
                                <p>Tags:</p>
                                <ul class="list-inline">
                                    @php
                                        $explode = explode(',',$detailsPost->tag_id);
                                        $tags = App\Models\Tag::whereIn('id',$explode)->get();
                                    @endphp
                                    @foreach ($tags as $tag)
                                        <li >
                                            <a href="blog-layout-2.html">{{$tag->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="social-media">
                                <p>Share on :</p>
                                <ul class="list-inline">
                                    <li>
                                        <a href="https://www.facebook.com/sharer.php?u={{url()->current()}}" target="_blank">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/sharer.php?u={{url()->current()}}">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://twitter.com/share?url={{url()->current()}}" target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://pinterest.com/pin/create/bookmarklet/?url={{url()->current()}}" target="_blank">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>                      
                        </div>

                        <!--post-single-author-->
                        <div class="post-single-author ">
                            <div class="authors-info">
                                <div class="image">
                                    <a href="author.html" class="image">
                                        <img src="{{asset('frontend')}}/assets/img/author/1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <h4>sarah smith</h4>
                                    <p> Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
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
                        </div>
                         
                        
                        <!--post-single-comments-->
                        <div class="post-single-comments">
                            <!--Comments-->
                            @php
                                $val = 'Comment';
                            @endphp
                            <h4>{{ $comments->count() }} {{ $comments->count() > 1 ? Str::plural($val) : $val }}</h4>
                            <ul class="comments">
                                <!--comment1-->
                                @foreach ($comments as $comment)
                                <li class="comment-item pt-0">
                                    @if ($comment->rel_to_guest->name)
                                    <img src="{{ Avatar::create($comment->rel_to_guest->name)->toBase64() }}" />
                                    @else
                                        <img src="{{ asset('uploads/user') }}/{{ $comment->rel_to_guest->image }}"
                                            alt="">
                                    @endif
                                    <div class="content">
                                        <div class="meta">
                                            <ul class="list-inline">
                                                <li><a href="#">{{$comment->rel_to_guest->name}}</a> </li>
                                                <li class="slash"></li>
                                                <li>{{$comment->created_at->diffForHumans() }}</li>
                                            </ul>
                                        </div>
                                        <p>{{$comment->comment}}</p>
                                        <a href="#reply_form" data="{{ $comment->id }}" class="btn-reply"><i
                                            class="las la-reply"></i> Reply</a>
                                    </div>
                            
                                </li> 

                                @php
                                $val = 'Reply';
                                @endphp
                                <h6 style="padding-left:100px">{{ $comment->replies->count() }} {{ $comment->replies->count() > 1 ? Str::plural($val) : $val }}</h6>
                                @foreach ($comment->replies as $reply)

                                <li class="comment-item pt-0" style="padding-left:100px">
                                    @if ($reply->rel_to_guest->name)
                                    <img style="width: 50px!important;height: 50px!important" src="{{ Avatar::create($reply->rel_to_guest->name)->toBase64() }}" />
                                    @else
                                        <img src="{{ asset('uploads/user') }}/{{ $reply->rel_to_guest->image }}"
                                            alt="">
                                    @endif
                                    <div class="content">
                                        <div class="meta">
                                            <ul class="list-inline">
                                                <li><a href="#">{{$reply->rel_to_guest->name}}</a> </li>
                                                <li class="slash"></li>
                                                <li>{{$reply->created_at->diffForHumans() }}</li>
                                            </ul>
                                        </div>
                                        <p>{{$reply->comment}}</p>
                                        <a href="#reply_form" data="{{ $reply->parent_id }}" class="btn-reply"><i
                                            class="las la-reply"></i> Reply</a>
                                    </div>
                            
                                </li>  
                                 
                                @endforeach
                                @endforeach
                                
                            </ul>
                            <!--Leave-comments-->
                            @auth('guestlogin')
                            <div class="comments-form" id="reply_form">
                                <h4 >Leave a Reply</h4>
                                <!--form-->
                                <form class="form " action="{{route('comment.store')}}" method="POST" id="main_contact_form">
                                    @csrf
                                    <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                    <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                        Your message was sent successfully.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" value="{{Auth::guard('guestlogin')->user()->name}}" class="form-control" placeholder="Name*" required="required" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" value="{{Auth::guard('guestlogin')->user()->email}}" class="form-control" placeholder="Email*" required="required" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="comment" id="message" cols="30" rows="5" class="form-control" placeholder="Message*" required="required"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="post_id" value="{{$detailsPost->id}}">
                                        <input type="hidden" name="parent_id" class="parent">
                                    
                                        <div class="col-lg-12">
                                            <button type="submit" name="submit" class="btn-custom">
                                                Send Comment
                                            </button>
                                        </div> 
                                    </div>
                                </form>
                                <!--/-->
                            </div>
                            @else
                            <div class="alert-warning alert">
                                <h3>Please Login to leave a comment <a class="float-right btn btn-success"
                                        href="{{ route('login.index') }}">Login here </a></h3>
                            </div> 
                            @endauth
                            
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
    $('.btn-reply').click(function() {
        var parent_id = $(this).attr('data');
        $('.parent').attr('value', parent_id);
    });
</script>
@endpush