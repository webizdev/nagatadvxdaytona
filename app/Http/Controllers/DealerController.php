<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    /**
     * Display a listing of dealers.
     */
    public function index()
    {
        // Get all branches (lokasi dealer) and group them by city (name field)
        $dealersByCity = Branch::all()->groupBy('name');

        return view('dealers.index', compact('dealersByCity'));
    }
}
