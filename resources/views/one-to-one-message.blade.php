<li class="{!! ($fromid == $value->from_user_id)?"me": 'you' !!} ">
    <div class="chat-thumb">
      <img src="/storage/' .{!!($fromid == $value->from_user_id)?$value->from_user->image:$value->to_user->image !!} " alt="" />
    </div>
    <div class="notifi-event">
      <span class="chat-msg-item">
        {!! $value->content !!}
      </span>
      <span class="notifi-date">
        <time
          datetime="2021-01-24T18:18"
          class="posted-date"
          >{{$value->created_at->diffForHumans()}}</time
        >
      </span>
    </div>
  </li>
