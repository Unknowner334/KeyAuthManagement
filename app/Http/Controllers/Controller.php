<?php

namespace App\Http\Controllers;

use DateTime;
use app\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Controller
{
    static function statusColor($status) {
        if ($status == 'Active') {
            return 'success';
        } elseif ($status == 'Inactive') {
            return 'danger';
        } else {
            return 'warning';
        }
    }

    static function permissionColor($perm) {
        if ($perm == 'Owner') {
            return 'danger';
        } elseif ($perm == 'Manager') {
            return 'warning';
        } elseif ($perm == 'Reseller') {
            return 'primary';
        } else {
            return 'dark';
        }
    }

    static function timeElapsed($dateString) {
        if (empty($dateString)) {
            return 'N/A';
        }

        try {
            $date = new DateTime($dateString);
            $now = new DateTime();
            $diff = $now->diff($date);

            $units = [
                'y' => 'year',
                'm' => 'month',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second'
            ];

            $parts = [];
            foreach ($units as $key => $label) {
                $value = $diff->$key;
                if ($value > 0) {
                    $parts[] = $value . ' ' . $label . ($value > 1 ? 's' : '');
                }
            }

            if (empty($parts)) {
                return 'N/A';
            }

            $parts = array_slice($parts, 0, 1);

            return implode(', ', $parts) . ' ago';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }


    static function censorText($text, $visibleChars = 5, $asterisks = 2) {
        $visible = substr($text, 0, $visibleChars);
        $hidden = str_repeat('*', $asterisks);
        return $visible . $hidden;
    }

    static function randomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

    static function userUsername($user_id) {
        $user = User::where('user_id', $user_id)->first();
        return $user?->username ?? 'N/A';
    }

    static function saldoData($userSaldo, $userRole) {
        $currency = Config::get('messages.settings.currency');
        if ($userSaldo >= 2000000000 || $userRole == "Owner") {
            $saldo = "∾";
            $saldo_color = "primary";
        } else {
            $saldo = number_format($userSaldo) . $currency;
            if ($userSaldo <= 100) {
                $saldo_color = "danger";
            } else if ($userSaldo <= 1000) {
                $saldo_color = "warning";
            } else {
                $saldo_color = "success";
            }
        }

        $data = [$saldo, $saldo_color];

        return $data;
    }

    static function require_ownership($allow_manager = 0) {
        $user = auth()->user();
        $errorMessage = Config::get('messages.error.validation');

        if (!$user) return false;

        if ($allow_manager == 1 && $user->role === "Manager") return true;
        if ($user->role === "Owner") return true;

        throw new HttpResponseException(
            back()->withErrors([
                'name' => str_replace(':info', 'Error Code 201, <strong>Access Forbidden</strong>', $errorMessage)
            ])->onlyInput('name')
        );

        return false;
    }

    static function manager_limit($role) {
        if (auth()->user()->role === "Manager") {
            if ($role === "Owner") {
                throw new HttpResponseException(
                    back()->withErrors([
                        'name' => 'You cannot register, edit, or delete a user with a higher role than yours.'
                    ])->onlyInput('name')
                );
                return false;
            }
        }

        return true;
    }

    static function psueAction($user) {
        if ($user->user_id == auth()->user()->user_id && $user->id == auth()->user()->id) {
            throw new HttpResponseException(
                back()->withErrors([
                    'name' => 'The selected user is the same as the currently logged-in user.'
                ])->onlyInput('name')
            );
            return false;
        }

        return true;
    }
}