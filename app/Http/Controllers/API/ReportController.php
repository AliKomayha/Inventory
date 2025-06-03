<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Capital;
use App\Models\Sale;
use App\Models\PurchaseItem;
use App\Models\PurchaseOrder;

class ReportController extends Controller
{
    public function summary()
    {
        $capital_in = Capital::where('amount', '>', 0)->sum('amount');
        $capital_out = Capital::where('amount', '<', 0)->sum('amount');

        $total_sales = Sale::sum(\DB::raw('unit_price * quantity'));

        $purchase_costs = PurchaseItem::sum(\DB::raw('unit_price * quantity'));
        $shipment_costs = PurchaseOrder::sum('shipment_cost');

        $total_expenses = $purchase_costs + $shipment_costs;
        $net_profit = $total_sales - $total_expenses;
        $current_capital = $capital_in + $net_profit + $capital_out; // note: capital_out is negative

        return response()->json([
            'capital_injected' => $capital_in,
            'capital_withdrawn' => $capital_out,
            'total_sales' => $total_sales,
            'total_expenses' => $total_expenses,
            'net_profit' => $net_profit,
            'current_capital' => $current_capital,
        ]);
    }
}
