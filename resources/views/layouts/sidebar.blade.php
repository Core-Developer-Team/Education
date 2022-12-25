<ul class="info__sections">
    <li>
        <a href="{{ route('req.index') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-archive me-2"></i>All
                Requests</span>
            <span class="all-info__right">{{ $req_count }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('feedback.store') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-user me-2"></i>Feedback</span>
            <span class="all-info__right">{{ $feed_count }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('profile.mysol') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-check-square me-2"></i>My Solutions</span>
            <span class="all-info__right">{{ $mysol + $mypropsol }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('req.myrequests') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-help-circle me-2"></i>My Questions</span>
            <span class="all-info__right">{{ $myques }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('resource.index') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-file-plus me-2"></i>Resources and notes</span>
            <span class="all-info__right">{{ $res }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('event.index') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-calendar me-2"></i>events</span>
            <span class="all-info__right">{{ $event }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('contest.index') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-user me-2"></i>Contest</span>
            <span class="all-info__right">{{  $contest }}</span>
        </a>
    </li>

    <li>
        <a href="{{ route('req.prevyear') }}" class="all-info__sections">
            <span class="all-info__left custom-tex"><i class="feather-package me-2"></i>Previous Year Ques
                Solutions</span>
            <span class="all-info__right">{{ $prev_count }}</span>
        </a>
    </li>

    <li>
        <a href="{{ route('req.allsolution') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-check-circle me-2"></i>All Solved
                Problems</span>
            <span class="all-info__right">{{ $sol_count }}</span>
        </a>
    </li>
    <li>
        <a href="{{route('reported.ind')}}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-alert-triangle me-2"></i>Reported</span>
            <span class="all-info__right">0</span>
        </a>
    </li>
    <li>
        <a href="{{ route('proposal.index') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-terminal me-2"></i>Developer
                Proposals</span>
            <span class="all-info__right">{{ $prop }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('offlinetopic.show') }}" class="all-info__sections">
            <span class="all-info__left"><i class="feather-message-square me-2"></i>Community
                Discussion</span>
            <span class="all-info__right">{{ $offline }}</span>
        </a>
    </li>
    <li>
        <a href="" class="all-info__sections">
            <span class="all-info__left"><i class="feather-bookmark me-2"></i>Trending</span>
            <span class="all-info__right">0</span>
        </a>
    </li>
</ul>
</div>


