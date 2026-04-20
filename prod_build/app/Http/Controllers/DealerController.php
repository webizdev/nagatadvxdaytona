<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    /**
     * Display a listing of dealers.
     */
    public function index()
    {
        // Get all dealers and group them by city
        $dealersByCity = Dealer::all()->groupBy('kota');

        return view('dealers.index', compact('dealersByCity'));
    }
}
