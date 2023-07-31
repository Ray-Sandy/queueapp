<?php

namespace App\Http\Controllers;


use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class CustomerServiceController extends Controller
{
    public function index()
    {
        // Load the queues and other necessary data
        $queues = Queue::where('status', '!=' ,'completed')
            ->where('status', '!=', 'skipped')
            ->get();
        $queues1 = Queue::where('status', '!=','completed')
            ->where('counter', 'pembayaran')
            ->get();
        $queues2 = Queue::where('status', '!=','completed')
            ->where('counter', 'Pemesanan')
            ->get();
        $queues3 = Queue::where('status', '!=','completed')
            ->where('counter', 'tukar-barang')
            ->get();
        $queueskip = Queue::where('status', 'skipped')->get();

        return view('cs.index', compact('queues','queues1','queues2','queues3', 'queueskip'));
    }

    public function call($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->status = 'processing';
        $queue->save();

        return redirect()->route('cs.index')->with('success', 'Antrian telah dipanggil.');
    }

    public function skip($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->status = 'skipped';
        $queue->save();

        return redirect()->route('cs.index')->with('success', 'Antrian telah dilewati.');
    }

    public function complete($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->status = 'completed';
        $queue->save();

        return redirect()->route('cs.index')->with('success', 'Antrian telah selesai.');
    }
    // public function validateQRCode(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id' => 'required|integer',
    //         'counter' => 'required|string',
    //         'status' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['success' => false]);
    //     }

    //     $queue = Queue::find($request->id);

    //     if (!$queue) {
    //         return response()->json(['success' => false]);
    //     }else

    //     if ($queue->status === 'complated' || $queue->status === 'processing' ) {
    //         // Data is valid, return success
    //         return response()->json(['success' => false]);
    //     }
    //     if ($queue->status === 'pending' || $queue->status === 'skipped') {
    //         // Data is valid, return success
    //         $queue->status = 'processing';
    //         $queue->save();
    //         return response()->json(['success' => true, 'status' => $queue->status]);
    //     }

    //     if ($queue->counter !== $request->counter) {
    //         // return back()->with('error', 'Invalid counter for the queue.');
    //         return response()->json(['success' => false]);
    //     }

    //      // Mark the queue as processing
    //     $queue->status = 'processing';
    //     $queue->save();

    //     // Data not valid
    //     return response()->json(['success' => true, 'status' => $queue->status]);
    // }
    //
    public function completeQueue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'counter' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => "Validasi salah."]);
        }

        $queue = Queue::find($request->id);

        if (!$queue) {
            return response()->json(['success' => false, 'error' => "ID tidak ditemukan."]);
        }

        if ($queue->id != $request->id || $queue->counter != $request->counter) {
            return response()->json(['success' => false, 'error' => "Data tidak sesuai antara ID atau counternya."]);
        }

        if ($queue->status == 'completed' || $queue->status == 'processing') {
            return response()->json(['success' => false, 'error' => "Status sudah diproses atau Status sudah selesai."]);
        }

        if ($queue->status == 'skipped' || $queue->status == 'pending') {
            // Mark the queue as processing
            $queue->status = 'processing';
            $queue->save();
            return response()->json(['success' => true, 'status' => $queue->status]);
        }

        return response()->json(['success' => false, 'error' => "Status tidak valid."]);
    }
}
