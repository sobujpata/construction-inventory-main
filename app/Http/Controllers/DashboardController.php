<?php

namespace App\Http\Controllers;

use App\Models\BuyProduct;
use App\Models\Employee;
use App\Models\OtherCost;
use App\Models\Owner;
use App\Models\Product;
use carbon\Carbon;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function DashboardPage():View{
        return view('pages.dashboard.dashboard-page');
    }

    function Summary(Request $request):array{
        // $user_id=$request->header('id');
        // $user_role = $request->header('role');

        // $product= Product::count();
        $Category= Category::count();
        $Customer=Customer::count();
        $collection =Collection::sum('amount');
        $product_cost =BuyProduct::sum('product_cost');
        $other_cost = OtherCost::sum('amount');

        $total_cost = $product_cost + $other_cost;

        $total_owner = Owner::count();
        $total_employee = Employee::count();
        $total_income = Collection::sum('amount');

        $total_balance = $total_income - $total_cost;
// dd($total_owner);




        $currentDate = Carbon::today();

        // Get the start and end dates for the previous month
        $startOfLastMonth = Carbon::now()->startOfMonth()->subMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // dd($endOfLastMonth);
        // Sum the total for rentals from last month

        $total_last_month_earn_collection = Collection::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                               ->sum('amount');
        $total_last_month_earn_product_cost = BuyProduct::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                               ->sum('product_cost');


        // Get the start and end dates for the current month
        $startOfCurrentMonth = Carbon::now()->startOfMonth();
        $endOfCurrentMonth = Carbon::now()->endOfMonth();

        // Sum the total for rentals in the current month

        $total_current_month_earn_collection = Collection::whereBetween('created_at', [$startOfCurrentMonth, $endOfCurrentMonth])
                                        ->sum('amount');
        $total_current_month_earn_product_cost = BuyProduct::whereBetween('created_at', [$startOfCurrentMonth, $endOfCurrentMonth])
                                        ->sum('product_cost');

        // Get the start and end dates for the last week
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek(Carbon::SUNDAY);  // Start of last week (Sunday)
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek(Carbon::SATURDAY);    // End of last week (Saturday)

        // Sum the total for rentals from last week

        $total_last_week_earn_collection = Collection::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
                              ->sum('amount');
        $total_last_week_earn_product_cost = BuyProduct::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
                              ->sum('product_cost');


        // Get the start and end dates for the current week
        $startOfCurrentWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY);  // Start of this week (Sunday)
        $endOfCurrentWeek = Carbon::now()->endOfWeek(Carbon::SATURDAY);    // End of this week (Saturday)

        // Sum the total for rentals from the current week

        $total_current_week_earn_collection = Collection::whereBetween('created_at', [$startOfCurrentWeek, $endOfCurrentWeek])
                                 ->sum('amount');
        $total_current_week_earn_product_cost = BuyProduct::whereBetween('created_at', [$startOfCurrentWeek, $endOfCurrentWeek])
                                 ->sum('product_cost');


                                 // Get the start and end of the previous day
        $startOfPreviousDay = Carbon::yesterday()->startOfDay();  // Start of yesterday
        $endOfPreviousDay = Carbon::yesterday()->endOfDay();      // End of yesterday

        // Sum the total for rentals from the previous day

        $total_previous_day_earn_collection = Collection::whereBetween('created_at', [$startOfPreviousDay, $endOfPreviousDay])
                                 ->sum('amount');
        $total_previous_day_earn_product_cost = BuyProduct::whereBetween('created_at', [$startOfPreviousDay, $endOfPreviousDay])
                                 ->sum('product_cost');

        // Get the start of today and the current time
        $startOfToday = Carbon::today()->startOfDay();  // Start of today (00:00:00)
        $endOfToday = Carbon::now();                    // Current time (now)

        // Sum the total for rentals created today

        $total_today_earn_collection = Collection::whereBetween('created_at', [$startOfToday, $endOfToday])
                           ->sum('amount');
        $total_today_earn_product_cost = BuyProduct::whereBetween('created_at', [$startOfToday, $endOfToday])
                           ->sum('product_cost');


        // Get the current month start and end dates
        $startOfMonth = Carbon::now()->startOfMonth();  // Start of the current month (1st day)
        $endOfMonth = Carbon::now()->endOfMonth();      // End of the current month (last day)

        // Retrieve and group invoices by day, summing the total for each day
        $daily_totals = BuyProduct::select(
                            DB::raw('DATE(created_at) as date'), // Group by date
                            DB::raw('SUM(product_cost) as total')       // Sum totals for each day
                        )
                        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->groupBy(DB::raw('DATE(created_at)'))  // Group by date
                        ->get();


        $chartData = [
            'labels' => $daily_totals->pluck('date'),  // Extract dates
            'data' => $daily_totals->pluck('total'),   // Extract total sums
        ];

        // Retrieve and group Collection by day, summing the total for each day
        $daily_totals_collection = Collection::select(
                            DB::raw('DATE(created_at) as date'), // Group by date
                            DB::raw('SUM(amount) as total')       // Sum totals for each day
                        )
                        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->groupBy(DB::raw('DATE(created_at)'))  // Group by date
                        ->get();


        $chartDataCollection = [
            'labels_collection' => $daily_totals_collection->pluck('date'),  // Extract dates
            'data_collection' => $daily_totals_collection->pluck('amount'),   // Extract total sums
        ];

        return[
            // 'role'=>$user_role,
            // 'product'=> $product,
            'category'=> $Category,
            'customer'=> $Customer,
            'owners'=> $total_owner,
            'employees'=> $total_employee,
            'total_income'=> $total_income,
            'product_cost'=> $product_cost,
            'total_balance'=> round($total_balance,2),
            'total_cost'=> round($total_cost,2),
            'total'=> round($product_cost,2),
            'total_last_month_earn_product_cost'=> round($total_last_month_earn_product_cost,2),
            'total_current_month_earn_product_cost'=> round($total_current_month_earn_product_cost,2),
            'total_last_week_earn_product_cost'=> round($total_last_week_earn_product_cost,2),
            'total_current_week_earn_product_cost'=> round($total_current_week_earn_product_cost,2),
            'total_previous_day_earn_product_cost'=> round($total_previous_day_earn_product_cost,2),
            'total_today_earn_product_cost'=> round($total_today_earn_product_cost,2),
            //Collection Details
            'collection'=> round($collection,2),
            'total_last_month_earn_collection'=> round($total_last_month_earn_collection,2),
            'total_current_month_earn_collection'=> round($total_current_month_earn_collection,2),
            'total_last_week_earn_collection'=> round($total_last_week_earn_collection,2),
            'total_current_week_earn_collection'=> round($total_current_week_earn_collection,2),
            'total_previous_day_earn_collection'=> round($total_previous_day_earn_collection,2),
            'total_today_earn_collection'=> round($total_today_earn_collection,2),

            //Order details chart
            'chartData' =>$chartData,
            'labels' => $daily_totals->pluck('date'),  // Extract dates
            'data' => $daily_totals->pluck('total'),   // Extract total sums
            //collection Chart
            'chartData_collection' =>$chartDataCollection,
            'labels_collection' => $daily_totals_collection->pluck('date'),  // Extract dates
            'data_collection' => $daily_totals_collection->pluck('total'),   // Extract total sums
        ];


    }
}
