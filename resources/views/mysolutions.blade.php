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
            <!--side bar-->
            <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-12 col-sm-12 col-12">
                <div class="full-width mt-10">
                    @include('layouts.sidebar')
                    <div class="full-width mt-5">

                        <div class="manage-section mt-3">
                            <span class="manage-title">Today's Activity</span>
                        </div>
                        <ul class="info__sections">
                            <li>
                                <a href="my_courses.html" class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-grid me-2"></i>Request</span>
                                    <span class="all-info__right">{{ $t_req_count }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="my_courses.html" class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-grid me-2"></i>Proposal</span>
                                    <span class="all-info__right">{{ $t_prop_count }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="purchased_courses.html" class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-download me-2"></i>Request
                                        Solution</span>
                                    <span class="all-info__right">{{ $t_reqsolution_count }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="purchased_courses.html" class="all-info__sections">
                                    <span class="all-info__left"><i class="feather-download me-2"></i>Proposal
                                        Solution</span>
                                    <span class="all-info__right">{{ $t_propsolution_count }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
            </aside>
            <!--/side bar-->
            <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <div class="event-card mt-4">
                    <div class="jobdt99">
                        <div class="jbdes25">
                            <div class="jobtxt47">
                                <h4>My Solution</h4>

                                @forelse ($data as $item)
                                    <div
                                        class="d-sm-flex align-items-center rounded border-none mt-3 p-3 justify-content-between mb-4">
                                        <div class="rounded-circle d-flex userimg">
                                            <img src="/storage/{{ $item->user->image }}" class="rounded-circle"
                                                style="width: 50px;height: 50px;" alt="" srcset="">
                                                  <!--hover on image-->
                                                  <div class="box imagehov shadow"
                                                  style="width: auto; height:auto;  position: absolute; z-index: 1;">
                                                  <div class="full-width">
                                                      <div class="recent-items">
                                                          <div class="posts-list">
                                                              <div class="feed-shared-author-dt">
                                                                  <div class="author-left">
                                                                      <a href="#"><img
                                                                              class="ft-plus-square job-bg-circle bg-cyan mr-0"
                                                                              src="/storage/{{ $item->user->image }}"
                                                                              alt=""></a>
                                                                  </div>
                                                                  <div class="author-dts">
                                                                      <p
                                                                          class="notification-text font-username">
                                                                          <a href="#"
                                                                              style="color: {{ $item->user->role->color->name }}">{{ $item->user->username }}
                                                                          </a><img
                                                                              src="{{ $item->user->badge->image }}"
                                                                              alt=""
                                                                              style="width: 20px;"
                                                                              title="{{ $item->user->badge->name }}">
                                                                          <span class="job-loca"><i
                                                                                  class="fas fa-location-arrow"></i>{{ $item->user->uni_name }}</span>
                                                                      </p>

                                                                      <p
                                                                          class="notification-text font-small-4 pt-1">
                                                                          <span class="time-dt">Joined on
                                                                              {{ $item->user->created_at }}</span>
                                                                      </p>
                                                                      <p
                                                                          class="notification-text font-small-4 pt-1">
                                                                          <span class="time-dt">Total
                                                                              Solutions
                                                                              {{ $item->user->solutions }}</span>
                                                                      </p>
                                                                      <p
                                                                          class="notification-text font-small-4 pt-1">
                                                                          <span class="time-dt">Rating
                                                                              {{ $item->user->rating }}</span>
                                                                      </p>
                                                                      <p
                                                                          class="notification-text font-small-4 pt-1">
                                                                          <span
                                                                              class="time-dt">{{ $item->user->badge->name }}</span>
                                                                      </p>
                                                                  </div>

                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- end hover-->
                                            <div class="ps-4 pt-0">
                                                <p class="h2" style="color: {{$item->user->role->color->name}}">{{ $item->user->username }}</p>
                                                <p> <small>Created on
                                                        {{ $item->created_at->diffForHumans() }}</small>
                                                </p>
                                                <p>{{ $item->description }}</p>
                                                <div class="jobtxt47">
                                                    <hr>
                                                    <h4>Download file from here</h4>

                                                    <a href="{{ $item->file }}"
                                                        download="{{ $item->file }}">{{ $item->file }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-success mt-3">
                                        No solutions Yet
                                    </div>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>

            </main>

        </div>
    </div>
</div>
</div>

<!--footer-->
@include('layouts.footer')
<!---/footer-->
