<div class="row">
    @foreach ($posts as $post)
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-1">
                        <div class="flex-grow-1 align-items-start">
                            <div class="avatar-group float-start flex-grow-1">
                                <div class="avatar-group-item">
                                    <a href="{{ route('users.profile', $post->user->id) }}"
                                        class="d-inline-block nav-link" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ $post->user->name }}"
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
                            <a href="#" class="dropdown-toggle font-size-16 text-muted"
                                data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger leave-team" data-id="1"
                                    data-bs-toggle="modal" data-bs-target=".bs-add-leave-team"
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
                        <p class="text-muted font-size-13 mb-0 excerpt">{{ $excerpt }}...
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
                            (<span class="comments-count">{{ $post->comments->count() }}</span>)
                        </button>

                        <button class="btn btn-light btn-sm"><i
                                class="mdi mdi-share-outline"></i> Share</button>
                    </div>
                    <div class="full-comment-section mt-3">
                        <form class="comment-form">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea class="form-control" name="comment" rows="3" placeholder="Write a comment..."></textarea>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Post
                                Comment</button>
                        </form>
                        <div class="comments-section mt-3">
                            @foreach ($post->comments as $comment)
                                <div class="comment mb-2">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <a href="{{ route('users.profile', $comment->user->id) }}"
                                                class="d-inline-block nav-link"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="{{ $comment->user->name }}"
                                                data-bs-original-title="{{ $comment->user->name }}">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                                    alt=""
                                                    class="rounded-circle avatar-sm">
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