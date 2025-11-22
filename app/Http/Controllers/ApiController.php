<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\KeyController;
use App\Models\App;
use App\Models\KeyHistory;
use App\Models\Key;
use Carbon\Carbon;

class ApiController extends Controller
{
    private function logKeyHistory(?Key $key, $keyName, $device, $ip, $app_id, $status, bool $isNew): void {
        KeyHistory::create([
            'key_id'     => $key?->edit_id,
            'key'        => $key?->key ?? $keyName,
            'device'     => $device,
            'ip_address' => $ip,
            'app_id'     => $app_id,
            'status'     => $status,
            'type'       => $isNew ? 'New Device' : 'Old Device',
        ]);
    }

    public function ApiConnect(Request $request) {
        $request->validate([
            'app_id' => 'required|string',
            'key'    => 'required|string',
            'device' => 'required|string',
        ]);

        $app_id  = $request->query('app_id');
        $keyName = $request->get('key');
        $device  = $request->get('device');
        $ip      = $request->ip();

        $app = App::where('app_id', $app_id)->first();
        $key = Key::where('key', $keyName)->where('app_id', $app_id)->first();

        $history = $key
            ? KeyHistory::where('device', $device)->where('key_id', $key->edit_id)->first()
            : null;

        if (!$app || !$key) {
            $this->logKeyHistory($key, $keyName, $device, $ip, $app_id, 'Fail', empty($history));
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }

        if ($key->status !== "Active" || Carbon::parse($key->expire_date)->lt(Carbon::today()) || $app->status !== "Active") {
            $this->logKeyHistory($key, $keyName, $device, $ip, $app_id, 'Fail', empty($history));
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }

        $deviceCount = KeyHistory::where('key_id', $key->edit_id)
            ->distinct('device')
            ->count('device');

        if ($deviceCount >= $key->max_devices && empty($history)) {
            $this->logKeyHistory($key, $keyName, $device, $ip, $app_id, 'Fail', true);
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401);
        }
        $this->logKeyHistory($key, $keyName, $device, $ip, $app_id, 'Success', empty($history));

        return response()->json([
            'status'      => 'success',
            'message'     => 'Authenticated',
            'expire_date' => $key->expire_date,
            'duration'    => $key->duration,
            'rank'        => $key->rank,
            'price'       => KeyController::keyPriceCalculator(
                $key->rank,
                $key->app->ppd_basic,
                $key->app->ppd_premium,
                $key->max_devices,
                $key->duration
            ),
        ]);
    }
}