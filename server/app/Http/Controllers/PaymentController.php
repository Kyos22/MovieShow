<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

use App\Services\PackageService;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    
    protected $paymentService;

    public function __construct(PaymentService $payment_Service){
        $this->paymentService = $payment_Service;
    }
    
    //function to create new payment method
    public function addPaymentMethod(Request $request){
        try {
            $validation = $request->validate([
                'namePaymentMethod'=>'required|max:255'
            ]);
            $payments = $this->paymentService->addNewPaymentMethod($validation);
            return response()->json($payments,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    //function to gett all the type of payment method
    public function getPaymentMethod(){
        try {
            $datas= $this -> paymentService->getPaymentMethod();
            return response()->json($datas,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function after payment success
    public function addProductToOrders($idCustomer){
        try {
            $checkCart = Cart::where('idCustomer',$idCustomer)->first();
            

         if(!$checkCart){
            return response()->json(['error'=>'cart more than 1 or not exist '],500);
         }else{
            $getIdCart = $checkCart->id;
            
            if($getIdCart== null){
                return response()->json(['error'=>'not found id cart'],500);
            }
            $cart = $this->paymentService->getCart($getIdCart);         
            if($cart == null){
            }           
            $idPackage = $cart->idPackage;       
            $sendData = $this -> paymentService->addProductToOrders($idCustomer,$idPackage,$getIdCart);
            return response()->json($sendData,200);
         }     
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    

}
