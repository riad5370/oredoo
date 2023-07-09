    <script src="{{asset('frontend')}}/assets/js/jquery.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/popper.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/bootstrap.min.js"></script>
    <!-- JS Plugins  -->
    <script src="{{asset('frontend')}}/assets/js/theia-sticky-sidebar.js"></script>
    <script src="{{asset('frontend')}}/assets/js/ajax-contact.js"></script>
    <script src="{{asset('frontend')}}/assets/js/owl.carousel.min.js"></script>
    <script src="{{asset('frontend')}}/assets/js/switch.js"></script>
    <script src="{{asset('frontend')}}/assets/js/jquery.marquee.js"></script>
    <!-- JS main  -->
    <script src="{{asset('frontend')}}/assets/js/main.js"></script>
    <!-- sweet alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- searching  -->
    <script>
        $('.search-btn').click(function(){
            var search_input = $('.search_input').val();
            var link = "{{route('search')}}"+"?q="+search_input;
            window.location.href = link;
        });
    </script>

    <script>
        $('.search-btn2').click(function(){
            var search_input = $('.search_input2').val();
            var link = "{{route('search')}}"+"?q="+search_input;
            window.location.href = link;
        });
    </script>

    <script>
        $('.search-btn3').click(function(){
            var search_input = $('.search_input3').val();
            var link = "{{route('search')}}"+"?q="+search_input;
            window.location.href = link;
        });
    </script>

<script>
    $('.search-btn4').click(function(){
        var search_input = $('.search_input4').val();
        var link = "{{route('search')}}"+"?q="+search_input;
        window.location.href = link;
    });
</script>
    @stack('js')