<div class="user-recipients-list active clickFromUserList text-center" data-href="{{route('get-messages', $findData->id) }}" data-userName="{{$findData->username }}" data-Image="/storage/'{{ $findData->image }}">
    <div class="recipient-avatar">
      <img src="/storage/' {{$findData->image }}" loading="lazy" alt="" class="presence-entity__image nt-view-attr__img--centered">
      <div class="presence-entity__badge badge__online">
        <span class="visually-hidden">
          Status is online
        </span>
      </div>
    </div>
    <div class="msg-right-part pt-3">
      <span class="user-recipient-name">{{ $findData->username }}</span>
    </div>
</div>
