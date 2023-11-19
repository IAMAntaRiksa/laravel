<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){

        $today = Carbon::now();
        $countPegawai = User::count();
        $countTamu = Tamu::count();
        $countTamuIntoday = Tamu::whereDate('created_at', $today)->count();
        return view('pages.dashboard.index', compact('countPegawai', 'countTamu', 'countTamuIntoday'));
    }
}
