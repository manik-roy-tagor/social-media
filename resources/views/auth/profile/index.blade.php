@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="text-center border-end">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                        class="img-fluid avatar-xxl rounded-circle" alt="">
                                    <h4 class="text-primary font-size-20 mt-3 mb-2">{{ $user->name }}</h4>
                                    <h5 class="text-muted font-size-13 mb-0">Web Designer</h5>
                                </div>
                            </div><!-- end col -->
                            <div class="col-md-9">
                                <div class="ms-3">
                                    <div>
                                        <h4 class="card-title mb-2">Biography</h4>
                                        <p class="mb-0 text-muted">Hi I'm Jansh,has been the industry's standard
                                            dummy text To an English person alteration text.</p>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <div>
                                                <p class="text-muted mb-2 fw-medium"><i
                                                        class="mdi mdi-email-outline me-2"></i>Janshwells@probic.com
                                                </p>
                                                <p class="text-muted fw-medium mb-0"><i
                                                        class="mdi mdi-phone-in-talk-outline me-2"></i>418-955-4703
                                                </p>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->

                                    {{-- <ul class="nav nav-tabs nav-tabs-custom border-bottom-0 mt-3 nav-justfied"
                                        role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link px-4 "
                                                href="https://bootdey.com/snippets/view/profile-projects" target="__blank">
                                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-block">Projects</span>
                                            </a>
                                        </li><!-- end li -->
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link px-4 "
                                                href="https://bootdey.com/snippets/view/profile-task-with-team-cards"
                                                target="__blank">
                                                <span class="d-block d-sm-none"><i class="mdi mdi-menu-open"></i></span>
                                                <span class="d-none d-sm-block">Tasks</span>
                                            </a>
                                        </li><!-- end li -->
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link px-4  active" data-bs-toggle="tab" href="#team-tab"
                                                role="tab" aria-selected="true">
                                                <span class="d-block d-sm-none"><i
                                                        class="mdi mdi-account-group-outline"></i></span>
                                                <span class="d-none d-sm-block">Team</span>
                                            </a>
                                        </li><!-- end li -->
                                    </ul><!-- end ul --> --}}
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->


                <div class="row">
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
                            <div class="tab-pane active show" id="team-tab" role="tabpanel">

                                <div class="row">
                                    @foreach ($user->posts as $post)
                                        <div class="col-xl-12 col-md-12" id="team-1">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex mb-1">
                                                        <div class="flex-grow-1 align-items-start">
                                                            <div class="avatar-group float-start flex-grow-1">
                                                                <div class="avatar-group-item">
                                                                    <a href="{{ route('users.profile', $post->user->id) }}"
                                                                        class="d-inline-block nav-link"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="{{ $post->user->name }}"
                                                                        data-bs-original-title="{{ $post->user->name }}">
                                                                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                                                            alt="" class="rounded-circle avatar-sm">
                                                                        <span
                                                                            style="margin-left: 10px">{{ $post->user->name }}</span>
                                                                    </a>
                                                                </div>
                                                            </div><!-- end avatar group -->
                                                        </div>
                                                        <div class="dropdown ms-2">
                                                            <a href="#"
                                                                class="dropdown-toggle font-size-16 text-muted"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item"
                                                                    href="javascript: void(0);">Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item text-danger leave-team"
                                                                    data-id="1" data-bs-toggle="modal"
                                                                    data-bs-target=".bs-add-leave-team"
                                                                    href="javascript: void(0);">
                                                                    Leave Team</a>
                                                            </div>
                                                        </div><!-- end dropdown -->
                                                    </div>

                                                    <div>
                                                        <?php
                                                        // Get first 30 words
                                                        $words = preg_split('/\s+/u', $post->post_description);
                                                        $excerpt = implode(' ', array_slice($words, 0, 30)); // Get first 30 words
                                                        ?>
                                                        <p class="text-muted font-size-13 mb-0 excerpt">
                                                            {{ $excerpt }}...
                                                        </p>
                                                        <div class="post-content-full">
                                                            <p class="text-muted font-size-13 mb-0">
                                                                {{ $post->post_description }}</p>
                                                        </div>
                                                        <button class="btn btn-link see-more">See More</button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <button class="btn btn-light btn-sm like-btn"
                                                            data-post-id="{{ $post->id }}"><i
                                                                class="mdi mdi-thumb-up-outline"></i> Like &nbsp; (<span
                                                                class="likes-count">{{ $post->likes->count() }}</span>)</button>
                                                        
                                                    <button class="btn btn-light btn-sm comment-btn"><i
                                                        class="mdi mdi-comment-outline"></i> Comment &nbsp;
                                                    (<span class="comments-count">{{ $post->comments->count() }}</span>)</button>

                                                        <button class="btn btn-light btn-sm"><i
                                                                class="mdi mdi-share-outline"></i> Share</button>
                                                    </div>
                                                    <div class="full-comment-section mt-3">
                                                        <form class="comment-form">
                                                            @csrf
                                                            <input type="hidden" name="post_id"
                                                                value="{{ $post->id }}">
                                                            <textarea class="form-control" name="comment" rows="3" placeholder="Write a comment..."></textarea>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm mt-2">Post
                                                                Comment</button>
                                                        </form>
                                                        <div class="comments-section mt-3">
                                                            @foreach ($post->comments as $comment)
                                                                <div class="comment mb-2">
                                                                    <div class="d-flex">
                                                                        <div class="flex-grow-1">
                                                                            <a href="{{ route('users.profile', $comment->user->id) }}"
                                                                                class="d-inline-block nav-link"
                                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                title="{{ $comment->user->name }}"
                                                                                data-bs-original-title="{{ $comment->user->name }}">
                                                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                                                                    alt="" class="rounded-circle avatar-sm">
                                                                                <span
                                                                                    style="margin-left: 10px"><strong>{{ $comment->user->name }}</strong></span>
                                                                            </a>
                                                                            
                                                                            <p class="mb-0">{{ $comment->comments }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div><!-- end col -->
                                    @endforeach

                                </div><!-- end row -->
                            </div><!-- end tab pane -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end col -->

            </div><!-- end col -->

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="pb-2">
                            <h4 class="card-title mb-3">About</h4>
                            <p>Hi I'm Jansh, has been the industry's standard dummy text To an English
                                person, it will seem like
                                simplified.</p>
                            <ul class="ps-3 mb-0">
                                <li>it will seem like simplified.</li>
                                <li>To achieve this, it would be necessary to have uniform pronunciation</li>
                            </ul>
                            <!-- end ul -->
                        </div>
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
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">Personal Details</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>Jansh Wells</td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <th scope="row">Location</th>
                                            <td>California, United States</td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <th scope="row">Language</th>
                                            <td>English</td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <th scope="row">Website</th>
                                            <td>abc12@probic.com</td>
                                        </tr><!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <div>
                            <h4 class="card-title mb-4">Work Experince</h4>
                            <ul class="list-unstyled work-activity mb-0">
                                <li class="work-item" data-date="2020-21">
                                    <h6 class="lh-base mb-0">ABCD Company</h6>
                                    <p class="font-size-13 mb-2">Web Designer</p>
                                    <p>To achieve this, it would be necessary to have uniform grammar, and more
                                        common words.</p>
                                </li>
                                <li class="work-item" data-date="2019-20">
                                    <h6 class="lh-base mb-0">XYZ Company</h6>
                                    <p class="font-size-13 mb-2">Graphic Designer</p>
                                    <p class="mb-0">It will be as simple as occidental in fact, it will be
                                        Occidental person, it will seem like simplified.</p>
                                </li>
                            </ul><!-- end ul -->
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    </div>
@endsection
