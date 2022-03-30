<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Order;
use App\Models\Payment;
use App\Http\Requests\execPostRequest;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function cartList()
    {
        $cartItems = Order::getContent();
        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {

        $product = Product::with(['size'])->find($request->get('product_id'));

        $productFoundInCart =  Order::where('product_id', $request->get('product_id'))->pluck('id');

        //check user cart items
        $userItems = Order::where('user_id', ($request->get('user_id')))->sum('quantity');

        if (!$request->get('product_id')) {
            return [
                'message' => 'Cập nhật giỏ hàng không thành công ',
                'items' => $userItems
            ];
        }

       if($productFoundInCart->isEmpty())
       {
            $cart = Order::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'size_id'=> $request->get('size_id'),
                'price' => ($product->retail_price - ($product->retail_price * $product->discount)/100),
                'user_id' => $request->get('user_id'),
            ]);
       } 
       else 
       {
            $cart = Order::where('product_id', $request->get('product_id'))
            ->increment('quantity');
       }

       

       if($cart)
       {
            return [
                'message' => 'Cập nhật giỏ hàng thành công ',
                'items' => $userItems
            ];
       }
        return $product;
       
    }

    public function getCartItemsForCheckout(Request $request) 
    {   
        $cartItems =  Order::with('product')->where('user_id',1 )->get();
        $finalData = [];
        $amount = 0;

        if(isset($cartItems))
        {
            foreach ($cartItems as  $cartItem) 
            {   
                
                if($cartItem->product)
                {

                    // $finalData[$cartItem->product_id]['name'] = '';
                    // $finalData[$cartItem->product_id]['retail_price'] = $cartItem->retail_price;
                    // $finalData[$cartItem->product_id]['total'] = $cartItem->retail_price * $cartItem->quantity;

                    foreach($cartItem->product as $cartProduct)
                    {
                        if($cartProduct->id == $cartItem->product_id)
                        {
                            $finalData[$cartItem->product_id]['id'] = $cartItem->id;
                            $finalData[$cartItem->product_id]['img'] = $cartProduct->image;
                            $finalData[$cartItem->product_id]['name'] = $cartProduct->name;
                            $finalData[$cartItem->product_id]['size_id'] = $cartItem->size_id;
                            $finalData[$cartItem->product_id]['retail_price'] = $cartItem->price;
                            $finalData[$cartItem->product_id]['discount'] = $cartItem->discount;
                            $finalData[$cartItem->product_id]['quantity'] = $cartItem->quantity;
                            $finalData[$cartItem->product_id]['total'] = $cartItem->price * $cartItem->quantity;
                            $amount +=  ($cartItem->price - ($cartItem->price* $cartItem->discount)/100 ) * $cartItem->quantity;
                            $finalData['totalAmount'] =  $amount;
                        }
                    }
                }
                

            }
        }
        return response()->json($finalData);
    }

    public function payment(Request $request) 
    {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $email = $request->get('email');
        $amount = $request->get('amount');
        $orders = $request->get('order');
        $user_id = 1;
        $status = 0;

        $paymentDetail = Payment::create([
            'user_id'=> $user_id,
            'name' => $name,
            'phone' => $phone,
            'address' => $address,
            'email' => $email,
            'amount' => $amount,
            'status' => $status,
            'order_details' => json_encode($orders), 
        ]);


        if( $paymentDetail )
        {
            Order::where('user_id', $user_id)->delete();
        }

        return response()->json($paymentDetail);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeItemOrder($id)
    {
        try {
            $result = $this->colorRepository->delete($id);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => ['errors' => ['exception' => $th->getMessage()]]
            ], 400);
        }
        return response($result);
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


    public function momo_payment(Request $request) {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $serectkey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->get('amount');
        $orderId = time() . "";
        $redirectUrl = "http://localhost:3000/checkout";
        $ipnUrl = "http://localhost:3000/checkout";
        $extraData="";

        $requestId = time() . "";
        $requestType = "payWithATM";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData .  "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
       
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'requestType' => $requestType,
            'signature' => $signature,
            'extraData' => $extraData
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        
        return  response($jsonResult['payUrl']);

    }
}

