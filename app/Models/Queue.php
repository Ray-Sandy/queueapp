<?php

// app/Models/Queue.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_number', 'queue_number', 'status', 'counter'];

    // public function getStatusAttribute()
    // {
    //     $statusLabels = [
    //         'pending' => 'Pending',
    //         'processing' => 'Processing',
    //         'skipped' => 'Skipped',
    //         'completed' => 'Completed',
    //     ];

    //     return $statusLabels[$this->status];
    // }

}
