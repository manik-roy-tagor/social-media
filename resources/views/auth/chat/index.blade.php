@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-8 ">


                <h3>Chat with {{ $user->name }}</h3>
                <div class="chat-box border p-3 mb-3" style="height: 300px; overflow-y: auto;">
                    @foreach ($messages as $message)
                        <div class="mb-2 {{ $message->sender_id == Auth::id() ? 'text-end' : '' }}">
                            <span class="badge bg-{{ $message->sender_id == Auth::id() ? 'primary' : 'secondary' }}">
                                <span>{{ $message->sender_id == Auth::id() ? Auth::user()->name : $user->name }}</span> <br>
                                <p class="h6"> {{ $message->message }}</p>
                            </span>
                        </div>
                    @endforeach
                </div>

                <form id="chat-form">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Type a message...">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-xl-4 ">
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
                                                <button class="btn btn-info btn-sm float-right position-relative" onclick="window.location.href='{{ route('chat.index', $user->id) }}'">
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
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#chat-form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('chat.send') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('.chat-box').append(
                        '<div class="mb-2 text-end"><span class="badge bg-primary h6">' + response
                        .sender_name + '<br>' + response.message.message + '</span></div>'
                    );
                    $('input[name="message"]').val('');
                    $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight);
                }
            });
        });

        
    </script>
@endsection
