<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function updateOrderStatusFromWebhook(Request $request)
    {

        $webhookToken = $request->header('X-Webhook-Token');
        if ($webhookToken !== config('app.webhook_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled'
        ]);

        try {
            $order = Order::findOrFail($validated['order_id']);
            $order->order_status = $validated['status'];
            $order->save();

            \Log::info('Order status updated via webhook', [
                'order_id' => $validated['order_id'],
                'new_status' => $validated['status']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
                'order_id' => $validated['order_id'],
                'new_status' => $validated['status']
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Failed to update order status via webhook', [
                'error' => $e->getMessage(),
                'order_id' => $validated['order_id'] ?? null
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status'
            ], 500);
        }
    }
}
