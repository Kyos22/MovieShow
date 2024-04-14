<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cart_Service){
        $this->cartService = $cart_Service;
    }
    //function to add package into cart customer and total 
    public function addCart(Request $request,$idCustomer,$idPackage){
        try {
            $validate = $request->validate([
                'quantity' => 'numeric',            
            ]);
            $cart = $this->cartService->addToCart($validate,$idCustomer,$idPackage);
            return response()->json($cart,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'failed'], 500);
        }
    }
    //function update quantity of package
    public function updateQuantityPackage(Request $request,$idCustomer,$idCart){
        try {
            $validation = $request->validate([
                'quantity' => 'numeric'
            ]);
            $carts = $this->cartService->updateQuantity($validation,$idCustomer,$idCart);
            return response()->json($carts,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    //function delete cart
    public function deleteCart($idCart){
        try {
            $carts= $this->cartService->deleteCart($idCart);
            return response()->json(['success'=>'delete cart success']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    
}
