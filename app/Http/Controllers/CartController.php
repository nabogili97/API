<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
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

        $product = Product::find($request->get('product_id'));

        $productFoundInCart =  Order::where('product_id', $request->get('product_id'))->pluck('id');

        //check user cart items
        $userItems = Order::where('user_id', ($request->get('user_id')))->sum('quantity');

        if (!$request->get('product_id')) {
            return [
                'message' => 'Cập nhật giỏ hàng không thành công ',
                'items' => $userItems
            ];
        }

        // return $userItems;
       if($productFoundInCart->isEmpty())
       {
            $cart = Order::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->retail_price,
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

    public function cart(Request $request)
    {
        $orderList = array();
        foreach ($request->all() as $row) {
            $product = array();
            $product['id'] = $row['id'];
            $product['name'] = $row['name'];
            $product['image'] = $row['image'];
            $product['price'] = $row['price'];
            $product['slmua'] = $row['slmua'];
            $product['masp'] = $row['masp'];
            array_push($orderList, $product);
        }
        $request->session()->forget('danhsach');
        $request->session()->put('danhsach', $orderList);
        return response()->json($orderList);

    }

    // public function updateCart(Request $request)
    // {
    //     Order::update(
    //         $request->id,
    //         [
    //             'quantity' => [
    //                 'relative' => false,
    //                 'value' => $request->quantity
    //             ],
    //         ]
    //     );

    //     session()->flash('success', 'Item Cart is Updated Successfully !');

    //     return redirect()->route('cart.list');
    // }


    public function removeCart(Request $request)
    {
        Order::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        Order::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    public function store(Request $request)
    {

        $userItems = Order::where('user_id', auth()->id)->sum('quantity');

        $product = Product::find($request->input('product_id'));

        if (!$product) {
            return response()->json(['success' => 0, 'message' => 'Product not found'], 404);
        }

        if ($product->amount == 0) {
            return response()->json(['success' => 0, 'message' => 'Product has no more available items'], 500);
        }

        if ($product->amount < $request->input('amount')) {
            return response()->json(['success' => 0, 'message' => 'There are only ' . $product->amount . ' available items of this product'], 500);
        }

        $user = Auth::user();

        $cartItem = new Order();
        $cartItem->user_id = $user->id;
        $cartItem->product_id = $request->input('product_id');
        $cartItem->amount = $request->input('amount');
        $cartItem->save();

        // update product amount
        $product->decrement('amount', $request->input('amount'));

        $cartItem = Order::with('product')->where('user_id', $user->id)->where('product_id', $request->input('product_id'))->first();

        return response()->json(['success' => 1, 'message' => 'Item added successfully to the cart', 'item' => $cartItem], 200);
    }

    // public function index()
    // {
    //     $cart = ShoppingCart::with('product')->where('user_id', $user->id)->get();
    //     return response()->json(['cart' => $cart], 200);
    // }

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
                            $finalData[$cartItem->product_id]['id'] = $cartProduct->id;
                            $finalData[$cartItem->product_id]['img'] = $cartProduct->image;
                            $finalData[$cartItem->product_id]['name'] = $cartProduct->name;
                            $finalData[$cartItem->product_id]['retail_price'] = $cartItem->price;
                            $finalData[$cartItem->product_id]['quantity'] = $cartItem->quantity;
                            $finalData[$cartItem->product_id]['total'] = $cartItem->price * $cartItem->quantity;
                            $amount +=  $cartItem->price * $cartItem->quantity;
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
    
}
