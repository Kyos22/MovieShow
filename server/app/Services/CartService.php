<?php
namespace App\Services;

use App\Models\Cart;

class CartService{
    //add product to cart and plus total base on quantity 
    public function addToCart(array $datas,int $idCustomer,int $idPackage){
        $cart = new Cart();
        $cart->idCustomer = $idCustomer;
        $cart->idPackage = $idPackage;

        foreach ($datas as $key => $value) {
            $cart->$key = $value;
        }
        $cart -> save();
        $packageInfo = $cart->package;
        $total = $packageInfo->pricePerMonth * $cart->quantity;
        $cart->total = $total;
        $cart -> save();

        return $cart;
    }
    //cap nhat so luong san pham
    public function updateQuantity(array $datas,int $idCustomer,int $idcart){
        $cart = Cart::where('idCustomer',$idCustomer)->where('id',$idcart)->first();
        if(!$cart){
            return null;
        }
        
        foreach($datas as $key=>$value){
            if($value!=null){
                $cart->$key=$value;
            }
        }
        
        $cart->save();
        $packageInfo = $cart->package;
        if($packageInfo){
            $total = $packageInfo->pricePerMonth * $cart->quantity;
        $cart->total = $total;
        }
        $cart-> save();
        return $cart;
    }
    //delete cart
    public function deleteCart($idCart){
        $cart = Cart::find($idCart);
        $cart->delete();
        return $cart;
    }
    
}

?>