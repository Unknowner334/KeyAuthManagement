<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key;
use App\Models\App;

class DashController extends Controller
{
    static function censorText($text, $visibleChars = 6, $asterisks = 2) {
        $visible = substr($text, 0, $visibleChars);
        $hidden = str_repeat('*', $asterisks);
        return $visible . $hidden;
    }

    public function Dashboard() {
        $keys = Key::orderBy('created_at', 'desc')->limit(5)->get();
        $apps = App::orderBy('created_at', 'desc')->limit(5)->get();

        return view('Home.dashboard', compact('keys', 'apps'));
    }
}
