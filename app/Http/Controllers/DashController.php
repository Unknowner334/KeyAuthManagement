<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key;
use App\Models\App;

class DashController extends Controller
{
    public function Dashboard() {
        $keys = Key::orderBy('created_at', 'desc')->limit(5)->get();
        $apps = App::orderBy('created_at', 'desc')->limit(5)->get();

        return view('Home.dashboard', compact('keys', 'apps'));
    }
}
