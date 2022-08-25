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
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-12">
                <div class="full-width">
                    <div class="posted_1590">
                        <div class="count-ttl">{{$reqs->count()}}</div>
                        <div class="cate-post">Posted Requests</div>
                    </div>
                    <div class="manage-section">
                        <span class="manage-title">Manage Requests</span>
                    </div>
                    <ul class="info__sections">
                        <li>
                            <a href="my_manage_jobs.html" class="all-info__sections">
                                <span class="all-info__left"><i class="feather-briefcase me-2"></i>My Requests</span>
                                <span class="all-info__right">{{$reqs->count()}}</span>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="btn-8585 mb-20 rrmt-30">
                    <a href="" class="afltr-btn afltr-active">My Requests</a>
                </div>
                @forelse ($reqs as $item)
                <div class="full-width">
                    <div class="recent-items">
                        <div class="posts-list">
                            <div class="feed-shared-author-dt">
                                <div class="author-left">
                                    <a href="#"><img class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                            src="/storage/{{$item->user->image}}" alt=""></a>
                                </div>
                                <div class="author-dts">
                                    <a href="#" class="job-heading">{{$item->requestname}}</a>
                                    <p class="notification-text font-small-4">
                                        <a href="#" class="cmpny-dt">{{$item->user->username}}</a>
                                        <span class="job-loca"><i class="feather-navigation"></i><ins
                                                class="state-name">{{$item->user->uni_name}}</span>
                                    </p>
                                    <p class="notification-text font-small-4 pt-1">
                                        <span class="time-dt">{{$item->created_at->diffForHumans()}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="post-meta">
                            <div class="job-actions">
                                <a href="manage_candidates.html" class="aplcnts_15">
                                    <i
                                        class="feather-users mr-2"></i><span>Applicants</span><ins>{{$item->reqbid->count()}}</ins>
                                </a>
                                <div class="action-btns-job">
                                    <a href="{{ route('req.showsingle', ['id' => $item->id]) }}"
                                        class="view-btn btn-hover">View Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
           
                @endforelse
                <div class="mt-35">
                    {{$reqs->links()}}
                </div>

            </div>

        </div>
    </div>
</div>



<!--footer-->
@include('layouts.footer')
<!---/footer-->