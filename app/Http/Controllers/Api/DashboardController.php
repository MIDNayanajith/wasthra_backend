<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Models\FoodSale;
use App\Models\ItemSale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function TotalFoodsale(Request $request)
    {
        $query = FoodSale::query();

        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $totalFoodSales = $query->count();

        return response()->json([
            'status' => 200,
            'total_sales' => $totalFoodSales
        ]);
    }

    public function TotalItemsale(Request $request)
    {
        $query = ItemSale::query();

        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $totalItemSales = $query->count();

        return response()->json([
            'status' => 200,
            'total_sales' => $totalItemSales
        ]);
    }

    public function saleTotalAmount(Request $request)
    {
        $foodSaleQuery = FoodSale::query();
        $itemSaleQuery = ItemSale::query();

        if ($request->has(['start_date', 'end_date'])) {
            $foodSaleQuery->whereBetween('date', [$request->start_date, $request->end_date]);
            $itemSaleQuery->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $foodSaleTotal = $foodSaleQuery->sum('total_amount');
        $itemSaleTotal = $itemSaleQuery->sum('total_amount');
        $totalAmount = $foodSaleTotal + $itemSaleTotal;

        return response()->json([
            'status' => 200,
            'total_amount' => $totalAmount
        ]);
    }

    public function purchaseTotalAmount(Request $request)
    {
        $query = Purchase::query();

        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $purchaseTotalAmount = $query->sum('total_amount');

        return response()->json([
            'status' => 200,
            'purchaseTotalAmount' => $purchaseTotalAmount
        ]);
    }

    public function TotalCustomers(Request $request)
    {
        $query = Customer::query();
    
        if ($request->has(['start_date', 'end_date'])) {
            // Convert to Carbon instances to handle timezone issues
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
    
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    
        $totalCustomers = $query->count();
    
        return response()->json([
            'status' => 200,
            'total_customers' => $totalCustomers
        ]);
    }
}
