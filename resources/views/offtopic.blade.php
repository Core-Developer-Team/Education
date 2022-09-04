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
                                        @if (session()->has('success'))
                                            <div class="alert alert-success mt-3">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif
                                        @foreach ($chats as $chat)
                                            <li class=" @if ($chat->user_id == Auth()->id()) you @else me @endif">
                                                <div class="chat-thumb">
                                                    <img src="/storage/{{ $chat->user->image }}" alt="">

                                                </div>
                                                <div class="notifi-event">
                                                    <span
                                                        class=" @if ($chat->user->id == Auth()->id()) text-warning @else text-secondary @endif">
                                                        @if ($chat->user->id == Auth()->id())
                                                            You
                                                        @else
                                                            {{ $chat->user->username }}
                                                        @endif
                                                    </span>
                                                    <span class="chat-msg-item">
                                                        {{ $chat->group_chat_message }}
                                                    </span>
                                                    <span class="notifi-date">
                                                        <time datetime="2021-01-24T18:18"
                                                            class="posted-date">{{ $chat->updated_at->diffForHumans() }}</time>
                                                    </span>
                                                     @if (!($chat->user_id==Auth()->id()))
                                            
                                                    @if (!($chat->offlinereport()->count() >= 1 && $chat->offlinereport->offlinetopic_id == $chat->id))
                                                        <a data-toggle="modal" data-id="{{ $chat->user_id }}"
                                                            data-mid="{{ $chat->id }}" title="Add this item"
                                                            class="open-report btn" href="#report">Report </a>
                                                    @else
                                                        <button class="text-danger btn">Reported</button>
                                                    @endif
                                                    @endif  
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <form id="offchat" class="send_messages_form">
                                @csrf
                                <div class="send_input_group">
                                    <div class="msg_write_combo">
                                        <textarea class="form-control custom-controls @error('group_chat_message') border-danger @enderror"
                                            placeholder="Write Something.." name="group_chat_message" id="group_chat_message" required></textarea>

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

<!--report Model-->
<div class="modal fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <div class="container bg-white rounded">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    @endif
                    <!--Request Form-->
                    <form class="form form-prevent" method="POST" id="req"
                        action="{{ route('offlinetopic.report') }}">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <input type="hidden" name="chat_id" id="chat_id" value="">
                        <div class="form-group pt-2">
                            <label for="description">Tell Us Why you report them</label>
                            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                            <div class="text-danger mt-2 text-sm descriptionError"></div>
                        </div>

                        <button type="submit" class="post-link-btn btn-hover mt-2 btn-prevent" name="submit"
                            value="Submit"> <i class="spinner fa fa-spinner fa-spin" style="display: none;"></i>
                            Submit
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/OwlCarousel/owl.carousel.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/night-mode.js') }}"></script>
<script>
    (function($) {
        $(window).on("load", function() {

            $(".user-message-chat-list, .group-message-chat-list").mCustomScrollbar({
                setHeight: 435,
                theme: "minimal-dark"
            });

            $(".chat-container").mCustomScrollbar({
                setHeight: 439,
                theme: "minimal-dark"
            });

        });
    })(jQuery);
</script>
</body>

<!-- Mirrored from www.gambolthemes.net/html-items/new-micko-html/disable-demo-link/messages.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Jul 2022 23:20:13 GMT -->

</html>

<script>
    $(document).on("click", ".open-report", function() {
        var userId = $(this).data('id');
        var mesgId = $(this).data('mid');
        $(".modal-body #user_id").val(userId);
        $(".modal-body #chat_id").val(mesgId);
        $('#report').modal('show');
    });
</script>

<script>
    $(function() {

        $('#offchat').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '{{ route('offlinetopic.get') }}',
                data: $('#offchat').serialize(),
                success: function() {
                    alert('text send sussessfully');
                }
            });

        });
    });
</script>
