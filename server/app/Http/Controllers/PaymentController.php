<?php
  
namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

use App\Models\Payment;
use Exception;
use Omnipay\Omnipay ;

class PaymentController extends Controller
{
  
    private $gateway;
  
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->initialize([
            'clientId' => env('PAYPAL_CLIENT_ID'),
            'secret'   => env('PAYPAL_CLIENT_SECRET'),
            'testMode' => true, //set it to 'false' when go live
        ]);
    }
  
    /**
     * Call a view.
     */
    public function index()
    {
        return view('payment');
    }
  
    /**
     * Initiate a payment on PayPal.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function charge(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first(); // or however you're identifying the cart

        // Calculate the total or retrieve it if it's a single value
         $total = $cart->total; // Assuming 'total' is a column in your 'carts' table

            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $total,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('success'),
                    'cancelUrl' => url('error'),
                ))->send();
           
                if ($response->isRedirect()) {
                    // redirect to offsite payment gateway
                    $response->redirect();
                } else {
                    // payment failed: display message to customer
                    echo $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        
    }
  
    /**
     * Charge a payment and store the transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
          
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
          
                // Insert transaction data into the database
                $payment = new Payment;
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();
          
                return "Payment is successful. Your transaction id is: ". $arr_body['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }
  
    /**
     * Error Handling.
     */
    public function error()
    {
        return 'User cancelled the payment.';
    }
}