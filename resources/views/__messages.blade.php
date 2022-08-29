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
    <div class="wrapper">
        <div class="main-setting">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-12">
                        <div class="full-width mb-0">
                            <form class="message-sidebar">
                                <div class="msg-top-left-items">
                                    <div class="msg-search">
                                        <i class="fas fa-search"></i>
                                        <input class="search_input_1 refund-textarea" type="text" placeholder="Search"
                                            value="">
                                    </div>
                                </div>
                                <div class="msg-tabs">
                                    <ul class="nav nav-pills nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="pill" href="#users-message"
                                                role="tab">
                                                <i class="feather-user me-2"></i>Users
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-30">
                                        <div class="tab-pane fade active show" id="users-message" role="tabpanel">

                                            @isset($data)
                                            @foreach ($data as $item)

                                            <div class="user-message-chat-list">
                                                <div class="user-recipients-list active">
                                                    <div class="recipient-avatar">
                                                        <img src="" loading="lazy" alt=""
                                                            class="presence-entity__image nt-view-attr__img--centered">
                                                        <div class="presence-entity__badge badge__online">
                                                            <span class="visually-hidden">
                                                                Status is online
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="msg-right-part">
                                                        <div class="msg-last-sent" title="1 w"></div>
                                                        <span
                                                            class="user-recipient-name">{{$item->to_user->usernane}}</span>
                                                        <p class=""></p>
                                                    </div>
                                                </div>
                                            </div>


                                            @endforeach
                                            @else
                                            <div class="user-message-chat-list">
                                                <div class="user-recipients-list active">
                                                    <div class="recipient-avatar">
                                                        <img src="/storage/{{$to_user->image}}" loading="lazy" alt=""
                                                            class="presence-entity__image nt-view-attr__img--centered">
                                                        <div class="presence-entity__badge badge__online">
                                                            <span class="visually-hidden">
                                                                Status is online
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="msg-right-part">
                                                        <div class="msg-last-sent" title="1 w"></div>
                                                        <span class="user-recipient-name">{{$to_user->username}}</span>
                                                        <p class=""></p>
                                                    </div>
                                                </div>
                                            </div>

                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-12">
                        <div class="full-width mb-0 rrmt-30">
                            <div class="messages-container">
                                @isset($data)
                                @foreach ($data as $item)
                                <div class="recipients-top-dt">

                                    <div class="recipient-avatar">
                                        <img src="/storage/{{$item->from_user->image}}" loading="lazy" alt=""
                                            class="presence-entity__image nt-view-attr__img--centered">
                                        <div class="presence-entity__badge badge__online">
                                            <span class="visually-hidden">
                                                Status is online
                                            </span>
                                        </div>
                                    </div>
                                    <div class="recipient-user-dt">
                                        <a href="#" target="_blank">{{$item->from_user->username}}</a>
                                        <p class="user-last-seen"><span class="small-last-seen">2 d</span></p>
                                    </div>
                                </div>
                                @endforeach

                                @else
                                <div class="recipients-top-dt">

                                    <div class="recipient-avatar">
                                        <img src="/storage/{{$to_user->image}}" loading="lazy" alt=""
                                            class="presence-entity__image nt-view-attr__img--centered">
                                        <div class="presence-entity__badge badge__online">
                                            <span class="visually-hidden">
                                                Status is online
                                            </span>
                                        </div>
                                    </div>
                                    <div class="recipient-user-dt">
                                        <a href="#" target="_blank">{{$to_user->username}}</a>
                                        <p class="user-last-seen"><span class="small-last-seen">2 d</span></p>
                                    </div>
                                </div>
                                @endisset

                            </div>
                            <div class="chat-container">
                                <div class="chat-content">
                                    <ul class="chats-lists">
                                        <li class="me">
                                            <div class="chat-thumb">
                                                <img src="" alt="">
                                            </div>
                                            <div class="notifi-event">
                                                <span class="chat-msg-item">

                                                </span>
                                                <span class="notifi-date">
                                                    <time datetime="2021-01-24T18:18" class="posted-date">
                                                    </time>
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form class="send_messages_form" method="POST" action="{{ route('chat.store') }}">
                                @csrf

                                <input type="hidden" name="to_user_id" id="to_user"
                                    value="@isset($data) @else  {{$to_user->id}} @endisset">
                                <input type="hidden" name="from_user_id" id="from_user"
                                    value="@isset($data) @else {{Auth()->id()}} @endisset">

                                <div class="send_input_group">
                                    <div class="msg_write_combo">

                                        <textarea class="form-control custom-controls" placeholder="Write Something.."
                                            name="content" required></textarea>

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

<!--footer-->
@include('layouts.footer')
<!---/footer-->
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