<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\TenantMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::guard('web')->user()->id;
        $cart = Cart::where('user_id', $id)->where('status', 'undone')->get('id')->first();
        $listCart = CartItem::where('cart_id', $cart->id)->get();

        $totalPrice = 0;

        foreach($listCart as $item){
            $menuPrice = TenantMenu::where('id', $item->tenant_menu_id)->get('tenant_menu_price')->first()->tenant_menu_price;

            $itemPrice = $item->quantity * $menuPrice;

            $totalPrice += $itemPrice;
        }

        //return $listCart;

        return view('cart.index', ['list_cart' => $listCart, 'total_price' => $totalPrice]);
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
            'tenant_menu_id' => 'required|exists:tenant_menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $id = Auth::guard('web')->user()->id;

        $cart = Cart::where('user_id', $id)->where('status', 'undone')->get('id')->first();

        if(!$cart){
            $cart = Cart::create([
                'status' => 'undone',
                'user_id' => $id
            ]);
        }

        CartItem::create([
            'tenant_menu_id' => $request->tenant_menu_id,
            'quantity' => $request->quantity,
            'cart_id' => $cart->id
        ]);

        // return 'add item to cart success';

        return redirect()->route('cart.index')
        ->with('success', 'Item added to cart successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = CartItem::findOrFail($id);
        $cart->update($request->all());

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartItem::where('id', $id)->delete();

        return redirect()->route('cart.index');
    }
}
