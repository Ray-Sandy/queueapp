<!-- <?php

// app/Http/Controllers/QueueController.php
namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\Queue;
use Illuminate\Http\Request;
use App\Events\QueueStatusUpdated;
use Illuminate\Support\Facades\Broadcast;



class QueueController extends Controller
{
    public function create(Request $request)
    {
        $queue = Queue::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'queue_number' => Queue::whereDate('created_at', today())->count() + 1,
        ]);

        return redirect()->route('waiting')->with('queue', $queue);
    }

    public function waiting()
    {
        $queues = Queue::where('status', '!=', 'completed')->get();

        return view('waiting', compact('queues'));
    }


    public function call(Queue $queue)
    {
        $queue->update([
            'status' => 'processing'
        ]);

        event(new QueueStatusUpdated($queue));

        return redirect()->route('customer_service')->with('message', 'Antrian telah dipanggil');
    }

    // public function skip(Queue $queue)
    // {
    //     $queue->status = 'skipped';
    //     $queue->save();

    //     // Panggil nomor antrian berikutnya
    //     $nextQueue = Queue::where('status', 'pending')->orderBy('created_at')->first();
    //     if ($nextQueue) {
    //         $this->callNextQueue($nextQueue);
    //     }

    //     return redirect()->route('customer_service')->with('message', 'Antrian telah dilewati');
    // }

    public function complete(Queue $queue)
    {
        $queue->update([
            'status' => 'completed'
        ]);

        event(new QueueStatusUpdated($queue));

        return redirect()->route('customer_service')->with('message', 'Antrian telah selesai');
    }

    public function customerService()
    {
        $queues = Queue::orderBy('created_at', 'asc')->get();
        return view('customer_service', compact('queues'));
    }

private function callNextQueue(Queue $queue)
{
    $queue->status = 'processing';
    $queue->save();

    // Trigger the status-updated event
    event(new QueueStatusUpdated($queue));

    // Call other functions to perform call actions

    // For example, you can use this to send notifications to Customer Service
    $this->sendNotificationToCustomerService($queue);

    // Broadcast the status update to the waiting page
    Broadcast::socket()->emit('status-updated', [
        'queueId' => $queue->id,
        'status' => $queue->status,
    ]);
}

public function skip(Queue $queue)
{
    $queue->status = 'skipped';
    $queue->save();

    // Call the next queue number
    $nextQueue = Queue::where('status', 'pending')->orderBy('created_at')->first();
    if ($nextQueue) {
        $this->callNextQueue($nextQueue);
    }

    // Trigger the status-updated event
    event(new QueueStatusUpdated($queue));

    // Broadcast the status update to the waiting page
    Broadcast::socket()->emit('status-updated', [
        'queueId' => $queue->id,
        'status' => $queue->status,
    ]);

    return redirect()->route('customer_service')->with('message', 'Antrian telah dilewati');
}


    private function sendStatusUpdate(Queue $queue)
    {
        // Kirim pesan WebSocket Pusher dengan status terbaru
        $pusher = new Pusher('45588d5d1b5371bf06c3', 'a45d98d96478bd42282d', '1613533', [
            'cluster' => 'ap1',
            'useTLS' => true,
        ]);

        $pusher->trigger('queue-status', 'status-updated', [
            'queueId' => $queue->id,
            'status' => $queue->status,
        ]);
    }
}
// public function call(Queue $queue)
    // {
    //     $queue->update(['status' => 'processing']);

    //     // Panggil WebSocket Pusher untuk memperbarui status antrian secara real-time

    //     return redirect()->route('customer_service')->with('message', 'Antrian sedang diproses');
    // }note
 // public function skip(Queue $queue)
    // {
    //     // $nextQueue = Queue::where('status', 'pending')->orderBy('created_at')->first();

    //     // if ($nextQueue) {
    //     //     $nextQueue->update(['status' => 'pending']);
    //     //     $queue->update(['status' => 'pending']);

    //     //     // Panggil WebSocket Pusher untuk memperbarui status antrian secara real-time

    //     //     return redirect()->route('customer_service')->with('message', 'Antrian dilewati');
    //     // }

    //     // return redirect()->route('customer_service')->with('message', 'Tidak ada antrian berikutnya');

    //     $queue->update([
    //         'status' => 'pending'
    //     ]);

    //     return redirect()->route('customer_service')->with('message', 'Antrian telah dilewati');
    // }
    // public function skip(Queue $queue)
    // {
    //     $queue->update([
    //         'status' => 'skipped'
    //     ]);

    //     event(new QueueStatusUpdated($queue));

    //     return redirect()->route('customer_service')->with('message', 'Antrian telah dilewati');
    // }

    // public function complete(Queue $queue)
    // {
    //     $queue->update(['status' => 'completed']);

    //     // Panggil WebSocket Pusher untuk memperbarui status antrian secara real-time

    //     return redirect()->route('customer_service')->with('message', 'Antrian selesai');
    // }
 -->




    <?php

    namespace App\Http\Controllers;

    use App\Models\Queue;
    use Illuminate\Http\Request;

    class QueueController extends Controller
    {
        public function create()
        {
            return view('queue.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone_number' => 'required',
            ]);

            $queue = new Queue;
            $queue->name = $request->name;
            $queue->email = $request->email;
            $queue->phone_number = $request->phone_number;
            $queue->queue_number = $this->generateQueueNumber();
            $queue->save();

            return redirect()->route('queue.waiting', ['id' => $queue->id]);
        }

        public function waiting($id)
        {
            $queue = Queue::find($id);
            return view('queue.waiting', compact('queue'));
        }

        private function generateQueueNumber()
        {
            $lastQueue = Queue::orderBy('id', 'desc')->first();
            $queueNumber = $lastQueue ? $lastQueue->queue_number + 1 : 1;
            return $queueNumber;
        }
    }
