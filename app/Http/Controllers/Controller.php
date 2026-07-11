<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function authorizeWriteAccess(string $module = 'default'): void
    {
        $user = auth()->user();

        if (! $user) {
            abort(403);
        }

        if ($user->role === 'owner') {
            abort(403);
        }

        if ($user->role === 'kasir' && $module !== 'pembayaran') {
            abort(403);
        }
    }
}
