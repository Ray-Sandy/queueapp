<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Antrian Online</title>

    <script>
        // Meminta izin pengguna untuk menampilkan notifikasi
        Notification.requestPermission().then(function(permission) {
            console.log('Notification permission:', permission);
        });
    </script>
</head>
<body>
    <div id="current-time">
        {{-- <p><span id="day"></span><span id="date"></span><span id="time"></span></p> --}}
        {{-- <p>Tanggal: </p>
        <p>Waktu: <span id="time"></span></p> --}}
    </div>

    <h2>Nomor Antrian Anda</h2>
    <p>Nomor Antrian: {{ $queue->queue_number }}</p>
    <p>Silakan tunggu hingga dipanggil.</p>
    <p>Status: <span id="current-status">{{ $queue->status }}</span></p>
    <p>Loket: {{ $queue->counter }}</p>


    <h3>Total Antrian: {{ $totalQueues }}</h3>
    @if ($currentQueue)
        <h3>Antrian Saat Ini: {{ $currentQueue->queue_number }}</h3>
    @else
        <h3>Antrian Saat Ini: -</h3>
    @endif

    @if ($nextQueue)
        <h3>Antrian Berikutnya: {{ $nextQueue->queue_number }}</h3>
    @else
        <h3>Antrian Berikutnya: -</h3>
    @endif
    <h3>Sisa Antrian: {{ $remainingQueues }}</h3>

    <table>
        <thead>
            <tr>
                <th>No. Antrian</th>
                <th>Status</th>
                <th>Counter</th>
                <!-- Tambahkan kolom lain yang diperlukan -->
            </tr>
        </thead>
        <tbody id="queue-table">
            @foreach ($queues as $queue)
                <tr data-queue-id="{{ $queue->id }}">
                    <td>{{ $queue->queue_number }}</td>
                    <td class="status">{{ $queue->status }}</td>
                    <td>{{ $queue->counter }}</td>
                    <!-- Tambahkan kolom lain yang diperlukan -->
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" name="counter" value="{{ $queue->counter }}">

    <script>
        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                timeZone: 'Asia/Jakarta' // Set timezone ke Indonesia
            };
            const formattedTime = now.toLocaleString('id-ID', options);
            document.getElementById('current-time').textContent = formattedTime;
        }
        // Update waktu setiap detik
        setInterval(updateTime, 1000);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //update seluruh status pada table
        $(document).ready(function() {
            function updateStatus() {
                $.ajax({
                    url: '{{ route('queue.getStatus') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $.each(response, function(queueId, queueData) {
                            var statusCell = $('[data-queue-id="' + queueId + '"] .status');
                            statusCell.text(queueData.status);
                            if (queueData.status === "Processing" || queueData.status === "Skipped" || queueData/status === "Completed") {
                              showNotification("Status Antrian " + queueData.queue_number + ": " + queueData.status + ". Silahkan datang ke loket" + queueData.counter);
                              playNotificationSound();
                            }

                        });
                    }
                });
            }
            setInterval(updateStatus, 15000);

            // // update status berdasarkan id
            // function updateStatusid() {
            //     // Lakukan permintaan AJAX ke server
            //     var xhr = new XMLHttpRequest();
            //     xhr.open('GET', '{{ route('queue.getStatusid', ['id' => $queue->id]) }}', true); // Ganti dengan URL endpoint yang sesuai
            //     xhr.onreadystatechange = function() {
            //         if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            //             // Tangkap response dari server
            //             var response = JSON.parse(xhr.responseText);

            //             // Perbarui status pada halaman
            //             document.getElementById('current-status').textContent = response.status;
            //         }
            //     };
            //     xhr.send();
            // }
            // setInterval(updateStatusid, 15000);

        });
    </script>
    <script>
        var previousStatus = '{{ $queue->status }}'; // Status awal
        function showNotification(title, body) {
            // Periksa apakah notifikasi didukung oleh browser
            if (!("Notification" in window)) {
                console.log("Browser tidak mendukung Web Notification");
                return;
            }
            // Periksa apakah pengguna telah memberikan izin untuk menampilkan notifikasi
            if (Notification.permission === "granted") {
                // Tampilkan notifikasi
                var notification = new Notification(title, { body });
            } else if (Notification.permission !== "denied") {
                // Jika belum ada izin, minta izin kepada pengguna
                Notification.requestPermission().then(function (permission) {
                    if (permission === "granted") {
                        // Jika izin diberikan, tampilkan notifikasi
                        var notification = new Notification(title, { body });
                    }
                });
            }
        }
        function playAudio(src) {
            var audio = new Audio(src);
            audio.play();
        }
        // Update status berdasarkan id
        function updateStatusById() {
            // Lakukan permintaan AJAX ke server
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '{{ route('queue.getStatusid', ['id' => $queue->id]) }}', true); // Ganti dengan URL endpoint yang sesuai
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Tangkap response dari server
                    var response = JSON.parse(xhr.responseText);
                    // Perbarui status pada halaman
                    var currentStatusElement = document.getElementById('current-status');
                    currentStatusElement.textContent = response.status;
                    // Periksa apakah status berubah
                    if (response.status !== previousStatus) {
                        // Status berubah, tampilkan notifikasi dan mainkan audio
                        if (response.status === 'processing') {
                            showNotification('Antrian Diproses', 'Antrian sedang diproses. Silahkan datang pada Loket'+ response.counter ); //ganti jadi bisa tau loket mana dari counternya
                            // playAudio('path/to/audio/file.mp3');
                        } else if (response.status === 'skipped') {
                            showNotification('Antrian Dilewati', 'Antrian dilewati. Silahkan tunggu giliran berikutnya.');
                            // playAudio('path/to/audio/file.mp3');
                        }
                        // Simpan status baru sebagai status sebelumnya
                        previousStatus = response.status;
                    }
                }
            };
            xhr.send();
        }
        setInterval(updateStatusById, 15000);
    </script>
</body>
</html>
