<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpdateLog;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $lastManualUpdate = UpdateLog::where('type', 'manual')->latest()->first();
        $lastAutomaticUpdate = UpdateLog::where('type', 'automatic')->latest()->first();

        return view('admin.news.index', compact('lastManualUpdate', 'lastAutomaticUpdate'));
    }

    public function updateNews()
    {
        DB::transaction(function () {
            Artisan::call('fetch:news manual');
        });

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }
}
