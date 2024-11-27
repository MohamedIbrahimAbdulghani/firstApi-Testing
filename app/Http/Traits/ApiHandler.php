<?php

namespace App\Http\Traits;

trait ApiHandler {
    public function MessageSuccess($message) {
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    public function MessageError($message) {
        return response()->json([
            'status' => false,
            'message' => $message,
        ]);
    }

    public function ReturnData($message) {
        return response()->json([
            'message' => $message,
        ]);
    }
}