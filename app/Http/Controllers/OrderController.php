<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
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

        \Log::info('hello from webhook', [
                'order_status' => $request->order_status,
                'order_id' => $request->order_id
            ]);

        try {
            
            $validated = $request->validate([
                'order_id' => 'required|string|exists:orders,order_id',
                'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled'
            ]);

            $order = Order::where('order_id', $validated['order_id'])->firstOrFail();
            $order->status = $validated['order_status'];
            $order->save();

            \Log::info('Order status updated via webhook', [
                'order_id' => $validated['order_id'],
                'new_status' => $validated['order_status']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully',
                'order_id' => $validated['order_id'],
                'new_status' => $validated['order_status']
            ], 200);

        }catch (ValidationException $e) {
            \Log::error('Validation failed', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);
            
            return response()->json([
                'error' => 'Validation failed',
                'details' => $e->errors(),
                'received_data' => $request->all()
            ], 422);

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
