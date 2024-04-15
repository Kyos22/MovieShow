<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\Package;
use App\Models\Payment;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;


class PaymentService{
    //function to get payment method
    public function getPaymentMethod(){
        $table = Payment::all();
        return $table;
    }
    //function to create new type of payment method
    public function addNewPaymentMethod(array $datas){
        $table = Payment::create($datas);
        return $table;
    }
    //get cart information of customer
    public function getCart(int $idCart){
        $cartInfo = Cart::find($idCart);
        return $cartInfo;
    }
    public function addProductToOrders($idCustomer,$idPackage,$idCart){
        $package = Package::find($idPackage);
    if (!$package) {
        return response()->json(['error' => 'Package not found'], 404);
    }

    // Xác minh rằng Cart tồn tại
    $cart = Cart::find($idCart);
    if (!$cart) {
        return response()->json(['error' => 'Cart not found'], 404);
    }
        $order = new Orders();
        $order->idCustomer = $idCustomer;
        $order->idPackage = $idPackage;
        $order->idCart = $idCart;
        $order->startDate = Carbon::now();
        $order->save();

        $cart = $order->Cart;
        if(!$cart){
            throw new Exception('cart not found');
        }
        $endDate = $order->startDate->copy()->addMonth($cart->quantity);
        $order->endDate = $endDate;
        
        $order-> save();
        return $order;

    }
    //get all order to admin diplay
    public function getAllOrder(){
        $order = Orders::with(['customer','Cart','package'])->get();
      
        $orderArray = $order->map(function ($order){
            return [
                'idOrder' => $order->id,
                'username' => $order->customer ? $order->customer->username : null,
                'email'=> $order ->customer ? $order->customer->email : null,
                'totalPrice' => $order -> Cart ? $order ->Cart->total : null,
                'totalPrice' => $order -> Cart ? $order ->Cart->quantity : null,
                'idCart' => $order->idCart,
                'startDate' => $order->startDate,
                'endDate' => $order->endDate,
                
            ];
        });
        return $orderArray;
    }
    //get bill of customer 
    public function getOrderCustomer($idCustomer){
        $order = Orders::with(['customer','Cart','package'])->where('idCustomer',$idCustomer)->get();
      
        $orderArray = $order->map(function ($order){
            return [
                'idOrder' => $order->id,
                'username' => $order->customer ? $order->customer->username : null,
                'email'=> $order ->customer ? $order->customer->email : null,
                'totalPrice' => $order -> Cart ? $order ->Cart->total : null,
                'totalPrice' => $order -> Cart ? $order ->Cart->quantity : null,
                'idCart' => $order->idCart,
                'startDate' => $order->startDate,
                'endDate' => $order->endDate,
                
            ];
        });
        return $orderArray;
    }
    //total avenue 
    public function getTotalAvenue(){
        $total = Orders::join('carts','orders.idCart','=','carts.id')->sum('carts.total');     
            return [
                'total' => $total,
            ];       
    }
    //total avenue of permonth
    public function getRevenuePerMonth(){
        $monthlyRevenue = Orders::join('carts','orders.idCart','=','carts.id')->select(
            DB::raw('YEAR(orders.startDate) as year'),
            DB::raw('MONTH(orders.startDate) as month'),
            DB::raw('SUM(carts.total) as total_revenue'),
        )->groupBy('year','month')->orderBy('year','desc')->orderBy('month','desc')->get(); 
        return $monthlyRevenue;    
    }
    //total revenue each package
    public function getRevenueEachPackage(){
        $packages = Orders::join('carts','orders.idCart','=','carts.id')
        ->join('packages','carts.idPackage','=','packages.id')
        ->groupBy('packages.id')
        ->selectRaw('packages.id as packageId, SUM(carts.total) as revenue')->get();
        return $packages;
    }
    //count package order
    public function countEachPackage() {
        $packageCounts = Orders::groupBy('idPackage')
                                ->select('idPackage', DB::raw('count(*) as count'))
                                ->get();
        return $packageCounts;
    } 
    //revenue Country
    public function revenueCountry() {
        $revenueByCountry = DB::table('orders')
        ->join('carts', 'orders.idCart', '=', 'carts.id')
        ->join('accounts', 'carts.idCustomer', '=', 'accounts.id')
        ->join('countries', 'accounts.idCountry', '=', 'countries.id')
        ->select('countries.id', DB::raw('SUM(carts.total) as revenue'))
        ->groupBy('countries.id')
        ->get();
    return $revenueByCountry;
    }
    //popular package 
    public function popularPackage(){
        $popular = Orders::groupBy('idPackage')
        ->selectRaw('idPackage, COUNT(idPackage) as popularity')
        ->orderBy('populariry','desc')
        ->get();
        return $popular;
    }
    

}

?>