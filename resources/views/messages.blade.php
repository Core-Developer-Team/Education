@section('title', 'Message')
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
          <div class="col-xl-4 col-lg-5 col-md-12">
            <div class="full-width mb-0">
              <form class="message-sidebar">
                {{-- <div class="msg-top-left-items">
                  <div class="msg-search">
                    <i class="fas fa-search"></i>
                    <input
                      class="search_input_1 refund-textarea"
                      type="text"
                      placeholder="Search"
                      value=""
                    />
                  </div>
                  <div class="msg-create-btns">
                    <button
                      type="button"
                      class="btn-main btn-hover"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Mark all conversations as read"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="23"
                        height="23"
                        viewBox="0 0 24 24"
                      >
                        <path
                          fill="currentColor"
                          d="M14,10H2V12H14V10M14,6H2V8H14V6M2,16H10V14H2V16M21.5,11.5L23,13L16,20L11.5,15.5L13,14L16,17L21.5,11.5Z"
                        ></path>
                      </svg>
                    </button>
                    <button
                      type="button"
                      class="btn-main btn-hover create_group_chat"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Create Group"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                      >
                        <path
                          fill="currentColor"
                          d="M13,13C11,13 7,14 7,16V18H19V16C19,14 15,13 13,13M19.62,13.16C20.45,13.88 21,14.82 21,16V18H24V16C24,14.46 21.63,13.5 19.62,13.16M13,11A3,3 0 0,0 16,8A3,3 0 0,0 13,5A3,3 0 0,0 10,8A3,3 0 0,0 13,11M18,11A3,3 0 0,0 21,8A3,3 0 0,0 18,5C17.68,5 17.37,5.05 17.08,5.14C17.65,5.95 18,6.94 18,8C18,9.06 17.65,10.04 17.08,10.85C17.37,10.95 17.68,11 18,11M8,10H5V7H3V10H0V12H3V15H5V12H8V10Z"
                        ></path>
                      </svg>
                    </button>
                  </div>
                </div> --}}
                <div class="msg-tabs">
                  <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item">
                      <a
                        class="nav-link active"
                        data-bs-toggle="pill"
                        href="#users-message"
                        role="tab"
                      >
                        <i class="feather-user me-2"></i>Users
                      </a>
                    </li>
                    {{-- <li class="nav-item">
                      <a
                        class="nav-link"
                        data-bs-toggle="pill"
                        href="#groups-message"
                        role="tab"
                      >
                        <i class="feather-users me-2"></i>Groups
                      </a>
                    </li> --}}
                  </ul>
                  <div class="tab-content mt-30">
                    <div
                      class="tab-pane fade active show"
                      id="users-message"
                      role="tabpanel"
                    >
                      <div class="user-message-chat-list">

                        {!! $friends !!}

                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="groups-message"
                      role="tabpanel"
                    >
                      <div class="group-message-chat-list">
                        <span class="no-online-users text-center empty_state">
                          <i class="feather-users"></i>
                          No groups to show
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-xl-8 col-lg-7 col-md-12">
            <div class="full-width mb-0 rrmt-30">
              <div class="messages-container">
                <div class="recipients-top-dt">
                  <div class="msg-usr-dt">
                    <div class="recipient-avatar">
                        <div id="receiverImageDiv">
                            @if(@$userDetails)
                            <img
                                    src="/storage/{{@$userDetails->image}}"
                                    loading="lazy"
                                    alt=""
                                    class="presence-entity__image nt-view-attr__img--centered chatHeadImage"
                                />
                            @endif
                        </div>
                      <div class="presence-entity__badge @if (Cache::has('user-is-online-' . @$userDetails->id)) badge__online @else badge__offline @endif">
                        <span class="visually-hidden">
                          Status is online
                        </span>
                      </div>
                    </div>
                    <div class="recipient-user-dt pt-3">
                      <a href="#" target="_blank" class="chatHeadUserName">{{@$userDetails->username}}</a>
                      <p class="user-last-seen">
                        @if (Cache::has('user-is-online-' . @$userDetails->id))
                         <span
                             class="text-success">Online</span>
                           @else
                          {{ Carbon\Carbon::parse(@$userDetails->last_seen)->diffForHumans() }}
                          @endif
                      </p>
                    </div>
                  </div>
                  <div class="usr-cht-opts-btns">
                    {{-- <span class="option-icon"
                      ><i class="feather-phone"></i
                    ></span>
                    <span class="option-icon"
                      ><i class="feather-video"></i
                    ></span> --}}
                    <span class="option-icon deleteMessage" data-toUser="{{@$toId}}"
                      ><i class="feather-trash-2"></i
                    ></span>
                  </div>
                </div>
                <div class="chat-container">
                  <div class="chat-content">
                    <ul class="chats-lists">


                    </ul>
                  </div>
                </div>
                <form class="send_messages_form">
                  <div class="send_input_group">
                    <div class="msg_write_combo">
                      {{-- <div class="add_files">
                        <div
                          class="img-add"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Files, Photos and Videos"
                        >
                          <input type="file" id="file1" />
                          <label for="file1"
                            ><i class="feather-copy"></i
                          ></label>
                        </div>
                      </div> --}}
                      <textarea
                        class="form-control custom-controls"
                        placeholder="Write Something.."
                        id="messageContent"
                      ></textarea>
                      <div
                        class="emoji-panel"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Emoji"
                      >
                        <button class="emoji-combo ml-2">
                          <i class="fa-regular fa-face-smile"></i>
                        </button>
                      </div>
                      {{-- <div
                        class="mic_recording-icon"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Audio Recording"
                      >
                        <button class="mic-record">
                          <i class="feather-mic"></i>
                        </button>
                      </div> --}}
                    </div>
                    <span class="input-send-btn">
                      <button
                        class="btn-main btn-hover send-button"
                        type="button"
                        id="sendMessage"
                        data-toid="{{@$toId}}"
                      >
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
@isset($toId)
<input type="hidden" name="getMessage" id="getMessageUrl"  value="{{route('get-messages',$toId)}}"/>
@endisset

<!--footer-->
@include('layouts.footer')
<!---/footer-->
<style>
    .activeUser{
        background: #6479ff !important;
    }
</style>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        var attr = "{!! isset($toId)?route('get-messages',$toId):'' !!}"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on("click","#sendMessage",function(){
            let message = $("#messageContent").val();
            let toId = $(this).attr("data-toid");
            if(message ==''){
                alert("Please enter your message");
                return false;
            }
            if(toId ==''){
                alert("Please select someone to chat.");
                return false;
            }
            $.ajax({
                type: "post",
                url: "{{ route('messages-send')}}",
                data: { toId, message},
                success: function (response) {
                    console.log(response);
                    const { status, message } = response;
                    if (status == true) {
                        $('.chats-lists').html(message);
                        $("#messageContent").val('');
                    }
                },
            });
        });

        function getMessagesData(attr){
            $.ajax({
                type: "post",
                url: attr,
                success: function (response) {
                    $('.chats-lists').html(response);
                },
            });
        }
        if(attr){
            getMessagesData(attr);
        }


        $(document).on("click",".clickFromUserList",function(){
            $('.clickFromUserList').removeClass("activeUser");
            $(this).addClass("activeUser");
            let getdataurl = $(this).attr('data-href');
            let userImg = $(this).attr('data-Image');
            let userName = $(this).attr('data-userName');
            $(".send-button").attr('data-toid',$(this).attr("data-toId"))
            $('.deleteMessage').attr('data-touser',$(this).attr('data-toId'))
            $("#receiverImageDiv").html( `<img src="${userImg}" loading="lazy" alt="" class="presence-entity__image nt-view-attr__img--centered chatHeadImage">`  );
            $(".chatHeadUserName").html(userName);
            $('.chats-lists').html(`<h6 class="text-center">Loading.....</h6>`);
            getMessagesData(getdataurl);
        });

        $(document).on("click",".deleteMessage",function(){
            let toUserId = $(this).attr('data-toUser');
            if(toUserId){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Once delete, You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "post",
                            url: "{{route('delete-message')}}",
                            data:{toUserId},
                            success: function (response) {
                                if(response.status == true){
                                    location.reload();
                                }
                            },
                        });
                    }
                });
            }else{
                Swal.fire({
                    title: '!! Why Don\'t select? !!',
                    text: "Please select someone to delete message!",
                    type: 'warning',
                });
            }
        });

    });
</script>
