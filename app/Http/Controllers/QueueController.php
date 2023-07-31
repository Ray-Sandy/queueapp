<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Queue;
// use App\Events\QueueStatusUpdated;
use Illuminate\Http\Request;
use App\Events\ResetQueueNumber;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QueueController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->format('Y-m-d');

        $queues1 = Queue::where('status', '!=','completed')->where('counter', 'pembayaran')->whereDate('created_at', Carbon::today())->get();
        $queues2 = Queue::where('status', '!=','completed')->where('counter', 'Pemesanan')->whereDate('created_at', Carbon::today())->get();
        $queues3 = Queue::where('status', '!=','completed')->where('counter', 'tukar-barang')->whereDate('created_at', Carbon::today())->get();

        // Mengambil total antrian pada hari yang sama (selain completed)
        $totalQueues = Queue::whereDate('created_at', $currentDate)
                            ->where('status', '!=', 'completed')
                            ->count();
        // Mengambil antrian saat ini (processing) pada counter yang sama
        $currentQueue = Queue::where('counter', session('counter'))
                             ->where('status', 'processing')
                             ->first();

        // Mengambil antrian berikutnya pada counter yang sama
        $nextQueue = Queue::where('counter', session('counter'))
                          ->where('status', 'pending')
                          ->orderBy('created_at')
                          ->first();

        // Mengambil sisa antrian (belum diproses) pada counter yang sama
        $remainingQueues = Queue::where('counter', session('counter'))
                                ->where('status', 'pending')
                                ->count();

        // Mengambil daftar antrian pada hari yang sama (selain completed)
        $queues = Queue::whereDate('created_at', $currentDate)
                       ->where('status', '!=', 'completed')
                       ->orderBy('created_at')
                       ->get();

        return view('queue.index', compact('queues1', 'queues2', 'queues3'));
    }

    public function listByCounter($counter)
    {
        $queues = Queue::where('status', '!=', 'completed')
                       ->where('counter', $counter)
                       ->whereDate('created_at', Carbon::today())
                       ->get();

        $totalQueues = Queue::where('status', '!=', 'completed')
                            ->whereDate('created_at', Carbon::today())
                            ->count();

        $currentQueue = Queue::where('status', 'processing')
                             ->where('counter', $counter)
                             ->whereDate('created_at', Carbon::today())
                             ->first();

        $nextQueue = Queue::where('status', 'pending')
                          ->where('counter', $counter)
                          ->whereDate('created_at', Carbon::today())
                          ->orderBy('created_at', 'asc')
                          ->first();

        $remainingQueues = $totalQueues - ($queues->count() + ($currentQueue ? 1 : 0));

        return view('queue.index', compact('queues', 'totalQueues', 'currentQueue', 'nextQueue', 'remainingQueues'));
    }


    public function create(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'phone_number' => 'required',
        //     'counter' => 'required',
        //     'checkbox' =>'accepted'
        // ]);


        return view('queue.create');
    }

    public function store(Request $request)
    {
        event(new ResetQueueNumber());

        $request->validate([
            'name' => 'required',
            // 'email' => 'required|email',
            'phone_number' => 'required',
            'counter' => 'required',
            'checkbox' =>'accepted',
        ]);

        $queue = new Queue;
        $queue->name = $request->name;
        // $queue->email = $request->email;
        $queue->phone_number = $request->phone_number;
        $queue->queue_number = $this->generateQueueNumber($request->counter);
        $queue->status = 'pending';
        $queue->counter = $request->counter;
        $queue->save();

        return redirect()->route('queue.waiting', ['id' => $queue->id, 'counter' => $queue->counter]);
    }

    public function waiting($id, $counter)
    {
        $queue = Queue::findOrFail($id);
        $queue->counter = $counter;
        $queue->id = $id;
        $queue->save();

        $queues = Queue::where('status', '!=', 'completed')
                        ->where('counter', $counter)
                        ->whereDate('created_at', Carbon::today())
                        ->get();

        $totalQueues = Queue::where('status', '!=', 'completed')
                            ->where('counter', $counter)
                            ->whereDate('created_at', Carbon::today())
                            ->count();

        $currentQueue = Queue::where('status', 'processing')
                              ->where('counter', $counter)
                              ->whereDate('created_at', Carbon::today())
                              ->first();

        $nextQueue = Queue::where('status', 'pending')
                           ->where('counter', $counter)
                           ->whereDate('created_at', Carbon::today())
                           ->first();

        $remainingQueues = $totalQueues;
        if ($currentQueue) {
            $remainingQueues = $totalQueues - $currentQueue->queue_number;
        }

        $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $queue->created_at, 'Asia/Jakarta')->format('Y-m-d H:i');
        $updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $queue->updated_at, 'Asia/Jakarta')->format('Y-m-d H:i');

        $data = [
            'id'            => $id,
            'counter'       => $queue->counter,
            'number'        => $queue->queue_number,
            'name'          => $queue->name,
            'status'        => $queue->status,
            'phone'         => $queue->phone_number,
            'start'         => $created_at,
            'end'           => $updated_at,
        ];
        $qrCode = QrCode::size(250)->generate(json_encode($data));

        session(['counter' => $counter]);

        return view('queue.waiting', compact('id', 'data', 'queues','totalQueues','currentQueue','nextQueue','remainingQueues','queue','qrCode'));
    }

    private function generateQueueNumber($counter)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $lastQueue = Queue::where('counter', $counter)->whereDate('created_at', $currentDate)->latest()->first();

        if (!$lastQueue || !$lastQueue->created_at->isToday()) {
            $queueNumber = 1;
        } else {
            $queueNumber = $lastQueue->queue_number + 1;
        }

        return $queueNumber;
    }

    public function destroy($id)
    {
        $queue = Queue::find($id);
        $queue->delete();

        return redirect()->route('queue.index')->with('success', 'Queue has been deleted.');
    }

    public function getStatusid(Request $request)
    {

        $queue = Queue::find($request->id);
        if ($queue) {
            return response()->json([
                'status' => $queue->status,
                'counter' => $queue->counter,
            ]);
        } else {
            return response()->json([
                'status' => 'not found',
                'counter' => 'not found',
            ], 404);
        }
    }
    public function getStatus()
    {
        $queues = Queue::all();

        $statusArray = [];
        foreach ($queues as $queue) {
            $statusArray[$queue->id] = [
                'status' => $queue->status,
                'counter' => $queue->counter,
            ];
        }

        return response()->json($statusArray);
    }
    // public function getQueueData($counter)
    // {
    //     $queues = Queue::where('status', '!=', 'completed')
    //         ->where('counter', $counter)
    //         ->whereDate('created_at', Carbon::today())
    //         ->get();

    //     return response()->json($queues);
    // }
    public function getQueueData($id, $counter)
    {
        $queue = Queue::find($id);
        $queue = Queue::findOrFail($id);
        $queue->counter = $counter;
        $queue->id = $id;
        $queue->save();

        if ($queue && $queue->counter == $counter) {
            // Data antrian yang ingin ditampilkan di QR code
            $data = [
                'id'            => $id,
                'counter'       => $counter,
                'number'        => $queue->number,
                'name'          => $queue->name,
                'status'        => $queue->status,
                'phone'         => $queue->phone,
                'start'         => $queue->start,
                'end'           => $queue->end,
                // Tambahkan data antrian lainnya yang ingin ditampilkan
                // Misalnya: 'name' => $queue->name, 'phone_number' => $queue->phone_number, dll.
            ];

            // Generate QR code berdasarkan data antrian menggunakan library QrCode
            $qrCode = QrCode::size(250)->generate(json_encode($data));

            // Kirimkan QR code dalam bentuk JSON sebagai response
            return response()->json([
                'qrCode' => $qrCode,
            ]);
        }

        // Jika data antrian tidak ditemukan atau status belum completed, kirimkan response kosong
        return response()->json(['message' => 'QR code data is not available for this queue.',]);
    }

}
