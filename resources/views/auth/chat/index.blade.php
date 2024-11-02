@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Chat with {{ $user->name }}</h3>
    <div class="chat-box border p-3 mb-3" style="height: 300px; overflow-y: auto;">
        @foreach ($messages as $message)
            <div class="mb-2 {{ $message->sender_id == Auth::id() ? 'text-end' : '' }}">
                <span class="badge bg-{{ $message->sender_id == Auth::id() ? 'primary' : 'secondary' }}">
                    {{ $message->message }}
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
                    '<div class="mb-2 text-end"><span class="badge bg-primary">' + response.message.message + '</span></div>'
                );
                $('input[name="message"]').val('');
                $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight);
            }
        });
    });
</script>
@endsection
