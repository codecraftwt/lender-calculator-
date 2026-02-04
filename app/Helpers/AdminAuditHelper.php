<?php

use App\Models\AdminAuditLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('adminAuditLog')) {

    /**
     * Store admin audit log
     *
     * @param string $action
     * @param ?string $description
     * @param ?int $userId
     * @return void
     */
    function adminAuditLog(string $action, ?string $description = null, ?int $userId = null): void
    {
        if (!Auth::check()) {
            return;
        }

        AdminAuditLog::create([
            'admin_id'    => Auth::id(),
            'user_id'     => $userId,
            'action'      => $action,
            'description' => $description,
            'ip_address'  => request()->ip(),
        ]);
    }
}
