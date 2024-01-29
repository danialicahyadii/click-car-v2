<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activity_log = ActivityLog::orderBy('created_at', 'DESC')->paginate();
        return view('activity-log.index', compact('activity_log'));
    }
}
