<!-- resources/views/waiting.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>

<h1>Waiting Page</h1>
<p>Current Date and Time: <span id="current-time"></span></p>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Queue Number</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($queues as $queue)
            <tr>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->queue_number }}</td>
                <td>
                    <span id="status">{{ $queue->status }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Nomor Antrian</th>
            <th>Nama</th>
            <th>Status Antrian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($queues as $queue)
            <tr>
                <td>{{ $queue->queue_number }}</td>
                <td>{{ $queue->name }}</td>
                <td id="status">{{ $queue->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- resources/views/waiting.blade.php -->
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<!-- Include the Pusher JavaScript library -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Initialize WebSocket Pusher
    const pusher = new Pusher('45588d5d1b5371bf06c3', {
        cluster: 'ap1',
        encrypted: true
    });

    // Subscribe ke channel 'queue-status'
    const channel = pusher.subscribe('queue-status');
    channel.bind('status-updated', function(data) {
        const { queueId} = data;
        if (queueId.id === "{{ $queue->id }}") {
        document.getElementById('status').textContent = status;
        }
    });
</script>
<script>
        function updateTime() {
        var date = new Date();
        var options = {
            timeZone: 'Asia/Jakarta',
            hour12: false,
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        var timeString = date.toLocaleString('id-ID', options);
        document.getElementById('current-time').textContent = timeString;
    }
    setInterval(updateTime, 1000); // Perbarui waktu setiap detik
</script>
