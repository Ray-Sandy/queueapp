<!-- resources/views/customer_service.blade.php -->
<h1>Customer Service Page</h1>
@if (session('message'))
    <p>{{ session('message') }}</p>
@endif
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Queue Number</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($queues as $queue)
            <tr>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->queue_number }}</td>
                <td>{{ $queue->status }}</td>
                <td>
                    @if ($queue->status == 'processing')
                        <form action="{{ route('queue.skip', $queue) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Skip</button>
                        </form>
                    @elseif ($queue->status == 'pending')
                        <form action="{{ route('queue.call', $queue) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Call</button>
                        </form>
                    @elseif ($queue->status == 'skipped')
                        <form action="{{ route('queue.call', $queue) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Call</button>
                        </form>
                    @endif
                    @if ($queue->status == 'processing' || $queue->status == 'completed')
                        <form action="{{ route('queue.complete', $queue) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Complete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- resources/views/customer_service.blade.php -->
<h1>Customer Service Page</h1>
@if (session('message'))
    <p>{{ session('message') }}</p>
@endif
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
                    <span id="status-{{ $queue->id }}">{{ $queue->status }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    // Inisialisasi WebSocket Pusher
    const pusher = new Pusher('45588d5d1b5371bf06c3', {
        cluster: 'ap1',
        encrypted: true
    });

    // Langganan ke channel 'queue-status'
    const channel = pusher.subscribe('queue-status');
    channel.bind('status-updated', function(data) {
        const { queueId, status } = data;
        document.getElementById('status-'.${queueId}).textContent = status;
    });
</script>
