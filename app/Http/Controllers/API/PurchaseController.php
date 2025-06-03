<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::all();
        return response()->json($purchaseOrders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            'purchase_type' => 'required|string',
            'shipment_cost' => 'required|numeric',
            'date' => 'required|date',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.unit_price' => 'required|numeric',
            'items.*.quantity' => 'required|integer'
        ]);

        $purchaseOrder = PurchaseOrder::create([
            'purchase_type' => $data['purchase_type'],
            'shipment_cost' => $data['shipment_cost'],
            'date' => $data['date'],
        ]);

        foreach ($data['items'] as $item) {
            $purchaseOrder->items()->create($item);
        }

        return response()->json([
            'message' => 'Purchase order created successfully',
            'purchase_order' => $purchaseOrder
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
