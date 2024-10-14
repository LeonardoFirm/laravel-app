@foreach (auth()->user()->notifications as $notification)
    <div class="alert alert-info">
        {{ $notification->data['message'] }}
    </div>
@endforeach

<audio id="notification-sound" src="{{ asset('audio/notification-sound.mp3') }}" preload="auto"></audio>

<script>
    function playNotificationSound() {
        var audio = document.getElementById('notification-sound');
        audio.play();
    }

    Echo.private(`user.{{ auth()->id() }}`)
        .notification((notification) => {
            playNotificationSound();
            alert('Nova notificação recebida!');
        });
</script>
