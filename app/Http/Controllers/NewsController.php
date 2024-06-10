<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->has('source')) {
            $query->where('source', $request->get('source'));
        }

        if ($request->has('date')) {
            $this->applyDateFilter($query, $request->get('date'));
        }

        return response()->json($query->get());
    }

    private function applyDateFilter($query, $date)
    {
        $dateFilters = [
            'ge' => '>=',
            'g' => '>',
            'se' => '<=',
            's' => '<'
        ];
        foreach ($dateFilters as $key => $operator) {
            if (array_key_exists($key, $date)) {
                $formattedDate = Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $date[$key]);
                $query->whereDate('created_at', $operator, $formattedDate);
            }
        }
    }
}
