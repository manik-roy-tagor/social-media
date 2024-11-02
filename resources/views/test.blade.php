<!-- resources/views/posts/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.6.96/css/materialdesignicons.min.css">
    <style>
        .post-content-full {
            display: none; /* Hide the full post content initially */
        }
        .comment-box {
            display: none; /* Hide the comment box initially */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Posts</h1>

        @if ($posts->isEmpty())
            <p>No posts available.</p>
        @else
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4"> <!-- Adjust the column size as necessary -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex mb-1">
                                    <div class="flex-grow-1 align-items-start">
                                        <div class="avatar-group float-start flex-grow-1">
                                            <div class="avatar-group-item">
                                                <a href="javascript: void(0);" class="d-inline-block nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $post->user->name }}" data-bs-original-title="{{ $post->user->name }}">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" class="rounded-circle avatar-sm">
                                                    <span style="margin-left: 10px">{{ $post->user->name }}</span>
                                                </a>
                                            </div>
                                        </div><!-- end avatar group -->
                                    </div>
                                    <div class="dropdown ms-2">
                                        <a href="#" class="dropdown-toggle font-size-16 text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript: void(0);">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger leave-team" data-id="1" data-bs-toggle="modal" data-bs-target=".bs-add-leave-team" href="javascript: void(0);">Leave Team</a>
                                        </div>
                                    </div><!-- end dropdown -->
                                </div>
                                <div>
                                    <?php
                                    // Split the post description into words
                                    $words = preg_split('/\s+/u', $post->post_description);
                                    // Get the first 30 words
                                    $excerpt = implode(' ', array_slice($words, 0, 30));
                                    ?>
                                    <p class="text-muted font-size-13 mb-0 excerpt">{{ $excerpt }}...</p>
                                    <div class="post-content-full">
                                        <p class="text-muted font-size-13 mb-0">{{ $post->post_description }}</p>
                                    </div>
                                    <button class="btn btn-link see-more">See More</button>
                                </div>
                                <div class="mt-2">
                                    <button class="btn btn-light btn-sm"><i class="mdi mdi-thumb-up-outline"></i> Like</button>
                                    <button class="btn btn-light btn-sm comment-btn"><i class="mdi mdi-comment-outline"></i> Comment</button>
                                    <button class="btn btn-light btn-sm"><i class="mdi mdi-share-outline"></i> Share</button>
                                </div>
                                <div class="comment-box mt-3">
                                    <form class="comment-form">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <textarea class="form-control" name="comment" rows="3" placeholder="Write a comment..."></textarea>
                                        <button type="submit" class="btn btn-primary btn-sm mt-2">Post Comment</button>
                                    </form>
                                </div>
                                <div class="comments-section mt-3">
                                    @foreach ($post->comments->sortByDesc('created_at') as $comment)
                                        <div class="comment mb-2">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <strong>{{ $comment->user->name }}</strong>
                                                    <p class="mb-0">{{ $comment->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.see-more').click(function() {
                const $postContentFull = $(this).siblings('.post-content-full');
                const $excerpt = $(this).siblings('.excerpt');

                // Toggle visibility
                $postContentFull.toggle(); 
                $excerpt.toggle();

                // Change button text based on visibility
                if ($postContentFull.is(':visible')) {
                    $(this).text('See Less'); // Change button text to "See Less"
                } else {
                    $(this).text('See More'); // Change button text back to "See More"
                }
            });

            $('.comment-btn').click(function() {
                const $commentBox = $(this).closest('.card-body').find('.comment-box');
                $commentBox.toggle(); // Toggle the visibility of the comment box
            });

            $('.comment-form').submit(function(event) {
                event.preventDefault(); // Prevent form from submitting normally

                const form = $(this);
                const postId = form.find('input[name="post_id"]').val();
                const commentContent = form.find('textarea[name="comment"]').val();
                const token = form.find('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('comments.store') }}",
                    method: 'POST',
                    data: {
                        _token: token,
                        post_id: postId,
                        content: commentContent
                    },
                    success: function(response) {
                        if (response.success) {
                            // Append the new comment to the comments section
                            const newComment = `<div class="comment mb-2">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <strong>${response.comment.user.name}</strong>
                                                            <p class="mb-0">${response.comment.content}</p>
                                                        </div>
                                                    </div>
                                                </div>`;
                            form.closest('.card-body').find('.comments-section').prepend(newComment); // Prepend the new comment
                            form.find('textarea[name="comment"]').val(''); // Clear the textarea
                        }
                    },
                    error: function(response) {
                        console.error(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
