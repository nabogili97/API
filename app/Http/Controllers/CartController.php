<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = Order::getContent();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        


        $product = Product::find($request->get('product_id'));

        $productFoundInCart =  Order::where('product_id', $request->get('product_id'))->pluck('id');

        //check user cart items
        $userItems = Order::where('user_id', 1)->sum('quantity');

        if (!$request->get('product_id')) {
            return [
                'message' => 'Cập nhật giỏ hàng thành công ',
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
                'user_id' => 1,
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

    public function getCartItemsForCheckout() 
    {
        $cartItems =  Order::where('user_id', 1)->get();

        if(isset($cartItems))
        {
            foreach ($cartItems as  $cartItem) {
                var_dump($cartItem);
            }
        }
        return $cartItems;
    }
    
}
