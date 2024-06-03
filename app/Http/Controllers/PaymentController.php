<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\TenantMenu;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg',
            'cart_id' => 'required|exists:carts,id',
            'tenant_id' => 'required|exists:tenants,id'
        ]);

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$extension;

        Storage::putFileAs('public/images/transaction', $file, $fileName);

        $payment = Payment::create(['payment_url' => $fileName]);

        $user_id = Auth::guard('web')->user()->id;
        $order = Order::create([
            'tenant_id' => $request->tenant_id,
            'cart_id' => $request->cart_id,
            'user_id' => $user_id,
            'order_status' => 0
        ]);

        $cart = Cart::findOrFail($request->cart_id);
        $cart->update([ 'status' => 'done' ]);

        Transaction::create([
            'order_id' => $order->id,
            'payment_id' => $payment->id
        ]);

        return 'payment success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = CartItem::where('cart_id', $id)->get();

        $totalPrice = 0;

        foreach($cart as $item){
            $menuPrice = TenantMenu::where('id', $item->tenant_menu_id)->get('tenant_menu_price')->first()->tenant_menu_price;

            $itemPrice = $item->quantity * $menuPrice;

            $totalPrice += $itemPrice;
        }

        // return $totalPrice;

        return view('payment.index', ['total_price' => $totalPrice]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
