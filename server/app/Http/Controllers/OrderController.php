<?php

namespace App\Http\Controllers;

use App\Service\CountryService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $paymentService;
    protected $countryService;
    
    public function __construct(PaymentService $payment_Service, CountryService $country_Service){
        $this->paymentService = $payment_Service;
        $this->countryService = $country_Service;
    }
    
    //function to show all data of bill display admin view
    public function getAllOrder(){
        try {
            $orders = $this -> paymentService->getAllOrder();
            return response()->json($orders,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function to show all data of bill display customer view
    public function getOrdersCustomer($idCustomer){
        try {
            $orders = $this -> paymentService->getOrderCustomer($idCustomer);
            return response()->json($orders,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function to calculate all revenue
    public function calculateAllAvenue(){
        try {
            $datas = $this->paymentService->getTotalAvenue();
            return response()->json($datas,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function to calculate all revenue per month
    public function calculateRevenuePermonth(){
        try {
            $datas = $this->paymentService->getRevenuePerMonth();
            return response()->json($datas,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    //function to calculate revenue of each package
    public function revenueOfEachPackage(){
        try {
            $datas = $this->paymentService->getRevenueEachPackage();
            return response()->json($datas,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function to count each package had been sold
    public function countEachPackage(){
        try {
            $datas = $this->paymentService->countEachPackage();
            return response()->json($datas,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function to calculate revenue of each countries
    public function revenueCountry(){
        try {
            $datas = $this->paymentService->revenueCountry();
            return response()->json($datas,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function to display popular package had been sold
    public function popularPackage(){
        try {
            $datas = $this->paymentService->popularPackage();
            return response()->json($datas,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    
}
