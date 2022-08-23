@include('layouts.header')
<header class="header clearfix">
    <div class="header-inner">
        <!--Top Menu-->
        @include('layouts.menu')
        <!--/Top Menu-->
        <div class="overlay"></div>
    </div>
</header>

<div class="wrapper">
    <div class="main-setting">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="full-width mb-0 rrmt-30">
                        <div class="messages-container">
                            <div class="recipients-top-dt">
                                <div class="msg-usr-dt">
                                    <div class="recipient-user-dt">
                                        <a href="#" target="_blank">Offline Topics</a>
                                    </div>
                                </div>

                            </div>
                            <div class="chat-container">
                                <div class="chat-content">
                                    <ul class="chats-lists">
                                        @foreach ($chats as $chat)

                                        <li class=" @if ($chat->user_id == Auth()->id()) you @else me @endif">
                                            <div class="chat-thumb">
                                                <img src="/storage/{{$chat->user->image}}" alt="">
                                            </div>
                                            <div class="notifi-event">
                                                <span class="chat-msg-item">
                                                    {{$chat->group_chat_message }}
                                                </span>
                                                <span class="notifi-date">
                                                    <time datetime="2021-01-24T18:18" class="posted-date">{{
                                                        $chat->updated_at->diffForHumans() }}</time>
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <form action="{{ route('offlinetopic.get') }}" method="POST" class="send_messages_form">
                                @csrf
                                <div class="send_input_group">
                                    <div class="msg_write_combo">
                                        <textarea
                                            class="form-control custom-controls @error('group_chat_message') border-danger @enderror"
                                            placeholder="Write Something.." name="group_chat_message"
                                            id="group_chat_message" required></textarea>

                                    </div>
                                    <span class="input-send-btn">
                                        <button class="btn-main btn-hover send-button" type="submit">
                                            <i class="feather-send"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/OwlCarousel/owl.carousel.js')}}"></script>
<script src="{{asset('vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('js/night-mode.js')}}"></script>
<script>
    (function($){
                $(window).on("load",function(){
                    
                    $(".user-message-chat-list, .group-message-chat-list").mCustomScrollbar({
                        setHeight:435,
                        theme:"minimal-dark"
                    });	
                    
                    $(".chat-container").mCustomScrollbar({
                        setHeight:439,
                        theme:"minimal-dark"
                    });
                    
                });
            })(jQuery);
</script>
</body>

<!-- Mirrored from www.gambolthemes.net/html-items/new-micko-html/disable-demo-link/messages.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 23:20:13 GMT -->

</html>