<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css"
        integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/6.6.96/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="{{ asset('profile.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('styles')
    <style>
        .post-content-full {
            display: none;
            /* Hide the full post content initially */
        }

        .full-comment-section {
            display: none;
            /* Hide the comment box initially */
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @yield('scripts')
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
                const $commentBox = $(this).closest('.card-body').find('.full-comment-section');
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
                            const newComment = `
                            <div class="comment mb-2">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <a href="profile/${response.comment.user.id}"
                                                class="d-inline-block nav-link"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="${response.comment.user.name}"
                                                data-bs-original-title="${response.comment.user.name}">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar6.png"
                                                    alt=""
                                                    class="rounded-circle avatar-sm">
                                                <span
                                                    style="margin-left: 10px"><strong>${response.comment.user.name}</strong></span>
                                            </a>

                                            <p class="mb-0">${response.comment.comments}</p>
                                        </div>
                                    </div>
                                </div>`;
                            form.closest('.card-body').find('.comments-section').prepend(
                                newComment);
                            form.find('textarea[name="comment"]').val(''); // Clear the textarea
                        }
                    },
                    error: function(response) {
                        console.error(response);
                    }
                });
            });

            $('.like-btn').click(function() {
                let postId = $(this).data('post-id');
                let likesCountElement = $(this).find('.likes-count');

                $.ajax({
                    url: `/post/${postId}/like`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            likesCountElement.text(response.likesCount);
                            // if (response.liked) {
                            //     alert('Post liked!');
                            // } else {
                            //     alert('Post unliked!');
                            // }
                        }
                    }
                });
            });


        });
    </script>

</body>

</html>
