<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Officer;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $counts = collect(['news', 'achievements', 'activities'])->mapWithKeys(fn ($t) => [$t => Content::where('type', $t)->published()->count()])->all();
        $counts['officers'] = Officer::where('status', 'published')->count();
        return view('admin.dashboard', ['counts' => $counts, 'recent' => Content::latest('updated_at')->limit(6)->get()]);
    }
}
