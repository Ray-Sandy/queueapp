<!DOCTYPE html>
<html>
<head>
    <title>Customer Service</title>
</head>
<body>
    <h2>Customer Service - Daftar Antrian</h2>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Antrian</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Tindakan</th>
        </tr>
        @foreach($queues as $queue)
            <tr>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->email }}</td>
                <td>{{ $queue->queue_number }}</td>
                <td>{{ $queue->status }}</td>
                <td>{{ $queue->counter }}</td>
                <td>
                    @if($queue->status == 'pending')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif
                    @if($queue->status == 'processing')
                        <form action="{{ route('cs.skip', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Skip</button>
                        </form>
                    @endif
                    @if($queue->status == 'skipped')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif
                    @if($queue->status == 'processing' || $queue->status == 'skipped')
                        <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Selesai</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <h2>Customer Service - Daftar Antrian Pembayaran</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Antrian</th>
            <th>Status</th>
            <th>Tindakan</th>
        </tr>
        @foreach($queues1 as $queue)
            <tr>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->email }}</td>
                <td>{{ $queue->queue_number }}</td>
                <td>{{ $queue->status }}</td>
                <td>
                    @if($queue->status == 'pending' && $queue->counter == 'pembayaran')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif

                    @if($queue->status == 'processing' && $queue->counter == 'pembayaran')
                        <form action="{{ route('cs.skip', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Skip</button>
                        </form>
                    @endif

                    @if($queue->status == 'skipped' && $queue->counter == 'pembayaran')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif

                    @if($queue->status == 'processing' || $queue->status == 'skipped')
                        <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Selesai</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <h2>Customer Service - Daftar Antrian Pemesanan</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Antrian</th>
            <th>Status</th>
            <th>Tindakan</th>
        </tr>
        @foreach($queues2 as $queue)
            <tr>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->email }}</td>
                <td>{{ $queue->queue_number }}</td>
                <td>{{ $queue->status }}</td>
                <td>
                    @if($queue->status == 'pending' && $queue->counter == 'pemesanan')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif
                    @if($queue->status == 'processing' && $queue->counter == 'pemesanan')
                        <form action="{{ route('cs.skip', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Skip</button>
                        </form>
                    @endif
                    @if($queue->status == 'skipped' && $queue->counter == 'pemesanan')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif
                    @if($queue->status == 'processing' || $queue->status == 'skipped' && $queue->counter == 'pemesanan')
                        <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Selesai</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <h2>Customer Service - Daftar Antrian Tukar-barang</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Antrian</th>
            <th>Status</th>
            <th>Tindakan</th>
        </tr>
        @foreach($queues3 as $queue)
            <tr>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->email }}</td>
                <td>{{ $queue->queue_number }}</td>
                <td>{{ $queue->status }}</td>
                <td>
                    @if($queue->status == 'pending' && $queue->counter == 'tukar-barang')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif
                    @if($queue->status == 'processing' && $queue->counter == 'tukar-barang')
                        <form action="{{ route('cs.skip', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Skip</button>
                        </form>
                    @endif
                    @if($queue->status == 'skipped' && $queue->counter == 'tukar-barang')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif
                    @if($queue->status == 'processing' || $queue->status == 'skipped' && $queue->counter == 'tukar-barang')
                        <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Selesai</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <h2>Customer Service - Daftar Antrian Skipped</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Antrian</th>
            <th>Status</th>
            <th>Keterangan</th>
            <th>Tindakan</th>
        </tr>
        @foreach($queueskip as $queue)
            <tr>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->email }}</td>
                <td>{{ $queue->queue_number }}</td>
                <td>{{ $queue->status }}</td>
                <td>{{ $queue->counter }}</td>
                <td>
                    @if($queue->status == 'skipped')
                        <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Call</button>
                        </form>
                    @endif
                    @if($queue->status == 'processing' || $queue->status == 'skipped')
                        <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Selesai</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
function validateQrCode() {
      // Get the scanned data from the QR code
      const scannedData = Quagga.result.codeResult.code;
      // Send the scanned data to the server for validation
      // Replace the 'csrf-token' value with the actual CSRF token value from Laravel
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      fetch("{{ route('cs.validateQrCode') }}", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken
      },
      body: JSON.stringify({ qrData: scannedData })
      })
      .then(response => response.json())
      .then(data => {
      if (data.status === "success") {
          // Validation successful, show the data and success message
          const { id, counter, name, phone_number, created_at } = data.data;
          document.getElementById("resultContainer").innerHTML = `
          <p>ID: ${id}</p>
          <p>Counter: ${counter}</p>
          <p>Name: ${name}</p>
          <p>Phone Number: ${phone_number}</p>
          <p>Created At: ${created_at}</p>
          `;
          document.getElementById("successMessage").style.display = "block";
          document.getElementById("validateQrCodeBtn").style.display = "none";
      } else {
          // Validation failed, show the error message
          document.getElementById("errorMessage").style.display = "block";
      }
      })
      .catch(error => {
      console.error("Error validating QR code:", error);
      document.getElementById("errorMessage").style.display = "block";
      });
  }
  // Event listener for the "Selesai" (Finish) button
  document.getElementById("finishBtn").addEventListener("click", function () {
      // Show the QR code scanning modal
      startQrCodeScanner();
      $("#qrScanModal").modal("show");
  });
  // Event listener for the "Validate QR Code" button in the modal
  document.getElementById("validateQrCodeBtn").addEventListener("click", function () {
      validateQrCode();
      // Stop the QR code scanner
      stopQrCodeScanner();
  });
  // Event listener to hide the error message on modal close
  $("#qrScanModal").on("hidden.bs.modal", function () {
      document.getElementById("errorMessage").style.display = "none";
    });
</script>
