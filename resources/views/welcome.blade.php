@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="container" style="text-align: justify;">
        <div class="row">
            <div class="col-xl-8 ">
                <div class="card">
                    <div class="card-body pb-0">
                        <form action="{{ route('postscreate') }}" method="post">
                            @csrf
                            <div class="row align-items-center p-1">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="post_description" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 137px"></textarea>

                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <a class="text-white d-flex align-items-center justify-content-center bg-primary p-2 fs-4 rounded-circle"
                                        href="javascript:void(0)">
                                        <i class="fa fa-photo"></i>
                                    </a>
                                    <a href="" class="text-dark px-3 py-2">Photo / Video</a>
                                    <a href="" class="d-flex align-items-center gap-2">
                                        <div
                                            class="text-white d-flex align-items-center justify-content-center bg-secondary p-2 fs-4 rounded-circle">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <span class="text-dark">Article</span>
                                    </a>
                                    <input type="submit" class="btn btn-primary ms-auto" value="Post" name="submit">
                                </div>
                            </div><!-- end row -->
                        </form>

                    </div><!-- end card body -->
                </div><!-- end card -->

                <div class="card">
                    <div class="tab-content p-4">
                        <div class="tab-pane active show" id="post-container" role="tabpanel">

                            @include('auth.partial.posts', ['posts' => $posts])
                        </div><!-- end tab pane -->
                    </div>
                </div><!-- end card -->

            </div><!-- end col -->

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="pb-2">
                            <h4 class="card-title mb-3">About Us</h4>
                            <p>হরে কৃষ্ণ . পরমেশ্বর ভগবান শ্রীকৃষ্ণের অশেষ কৃপায় ইসকন ইয়ুথ ফোরাম, লালমনিরহাট - কালের স্রোতে
                                ভেসে যাওয়া যুবকদের আলোর দিসারী হয়ে পথের সন্ধান দিচ্ছে । <br> ধন্যবাদান্তে - শ্রীপাদ স্থিত
                                প্রজ্ঞ ভক্ত দাস ব্রহ্মচারী, <br> কো-অর্ডিনেটর, ইসকন ইয়ুথ ফোরাম, লালমনিরহাট । </p>
                            <!-- end ul -->
                            {{-- </div>
                        <hr>
                        <div class="pt-2">
                            <h4 class="card-title mb-4">My Skill</h4>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge badge-soft-secondary p-2">HTML</span>
                                <span class="badge badge-soft-secondary p-2">Bootstrap</span>
                                <span class="badge badge-soft-secondary p-2">Scss</span>
                                <span class="badge badge-soft-secondary p-2">Javascript</span>
                                <span class="badge badge-soft-secondary p-2">React</span>
                                <span class="badge badge-soft-secondary p-2">Angular</span>
                            </div>
                        </div> --}}
                        </div><!-- end cardbody -->
                    </div>
                </div><!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">Calendar Events</h4>
                            <div class="table-responsive">
                                <ul class="list-group">
                                    @foreach ($events as $event)
                                        <li class="list-group-item">
                                            <div class="row rounded-lg">
                                                <div class="col-xs-4 col-md-4 bg-warning p-1 rounded-left">
                                                    {{ \Carbon\Carbon::parse($event->event_time)->format('d M Y g:i A') }}
                                                </div>
                                                <div class="col-xs-8 col-md-8 pt-1 rounded-right"
                                                    style="background-color: darkgrey">{{ $event->event_title }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">User List</h4>
                            <ul class="list-unstyled work-activity mb-0">
                                <li class="work-item" data-date="2020-21">
                                    <div class="float-start">
                                        @foreach ($allUsers as $user)
                                            <div class="mb-3 align-items-center">
                                                <a href="{{ route('users.profile', $user->id) }}"
                                                    class="d-inline-block nav-link" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="{{ $user->name }}"
                                                    data-bs-original-title="{{ $user->name }}">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                                        alt="" class="rounded-circle avatar-sm">
                                                    <span style="margin-left: 10px">{{ $user->name }}</span>
                                                </a>
                                                <button class="btn btn-info btn-sm float-right position-relative"
                                                    onclick="window.location.href='{{ route('chat.index', $user->id) }}'">
                                                    Message
                                                    <span id="messageBadge"
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                        style="display: none;">0</span>
                                                </button>

                                            </div>
                                        @endforeach


                                    </div><!-- end avatar group -->
                                </li>
                            </ul><!-- end ul -->
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    </div>
@endsection
@section('scripts')
@endsection
