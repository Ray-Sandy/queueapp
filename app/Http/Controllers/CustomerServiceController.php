<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    // public function completeQueue(Request $request)
    // {
    //     $queueId = $request->input('queue_id');

    //     // Find the queue by its ID
    //     $queue = Queue::findOrFail($queueId);

    //     // Update the status of the queue to "completed"
    //     $queue->status = 'completed';
    //     $queue->save();

    //     return response()->json(['message' => 'Queue completed successfully']);
    // }
    // Add this function to the CustomerServiceController.php
    // public function validateQRCode(Request $request)
    // {
    //     $data = $request->all();

    //     // Find the queue in the database based on the scanned data
    //     $queue = Queue::find($data['id']);

    //     if ($queue && $queue->status === 'pending' && $queue->counter === $data['counter']
    //         && $queue->name === $data['name'] && $queue->phone_number === $data['phone_number']
    //         && $queue->created_at->format('Y-m-d H:i:s') === $data['created_at']) {

    //         // Valid data, update the status to 'completed'
    //         DB::beginTransaction();
    //         try {
    //             $queue->status = 'completed';
    //             $queue->save();
    //             DB::commit();

    //             return response()->json(['success' => true]);
    //         } catch (\Exception $e) {
    //             DB::rollback();
    //             return response()->json(['success' => false]);
    //         }
    //     }

    //     // Data not valid
    //     return response()->json(['success' => false]);
    // }
    public function validateQRCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'counter' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }

        $queue = Queue::find($request->id);

        if (!$queue) {
            return response()->json(['success' => false]);
        }else

        if ($queue->id === $request->id && $queue->counter === $request->counter) {
            // Data is valid, return success
            return response()->json(['success' => true]);
        }

        // Data not valid
        return response()->json(['success' => false]);
    }
    public function completeQueue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'counter' => 'required|string',
            ''
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $queue = Queue::find($request->id);

        if (!$queue) {
            return back()->with('error', 'Queue not found.');
        }

        if ($queue->status === 'completed') {
            return back()->with('error', 'Queue is already completed.');
        }

        if ($queue->counter !== $request->counter) {
            return back()->with('error', 'Invalid counter for the queue.');
        }

        // Mark the queue as completed
        $queue->status = 'completed';
        $queue->save();

        return back()->with('success', 'Queue completed successfully.');
    }
}
