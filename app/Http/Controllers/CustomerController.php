<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Tenant;
use App\Models\TenantMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function landingPage()
    {
        $tenant = Tenant::all();
        return view('customer.landing', compact('tenant'));
    }
    public function tenantDetailPage($id)
    {
        $tenant = Tenant::find($id)->first();
        $menu = $tenant->tenantMenus;
        $user_id = Auth::guard('web')->id();

        return view('customer.tenant_detail', compact('tenant', 'menu'));
    }
    public function handleAddToCart($id, $isUpdate){
        $currTenant = Tenant::whereHas('tenantMenus', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();
        $tenant_id = $currTenant->id;

        $currMenu_id = $id;
        $user_id = Auth::guard('web')->id();

        // check if the cart is created
        $currCart = Cart::where('user_id', $user_id)->first();
        if($currCart == null) {
            $currCart = Cart::create([
                'user_id' => $user_id,
                'status' => 'true'
            ]);
        }

        $currCartItem = CartItem::where('cart_id', $currCart->id)->where('tenant_menu_id',$currMenu_id)->first();

        if($currCartItem == null) {
            // dd($currMenu_id);
            CartItem::create([
                'cart_id' => $currCart->id,
                'tenant_menu_id' => $currMenu_id,
                'quantity' => 1
            ]);
        } else {
            $identifier = $isUpdate == 1 ? 1 : -1;
            if($currCartItem->quantity == 1 && $isUpdate == 2) $currCartItem->delete();
            else {
                $currCartItem->quantity += $identifier;
                $currCartItem->save();
            }
        }
        return redirect()->back();
    }

    public function customerCartPage(){
        $user_id = Auth::guard('web')->id();
        $menu = Cart::where('user_id', '=', $user_id)->first();
        return view('customer.customer_cart', compact('menu'));
    }
    public function customerCheckoutPage(){
        $user_id = Auth::guard('web')->id();
        $menu = Cart::where('user_id', '=', $user_id)->first();
        $total = 0;
        foreach ($menu->cartItems as $c) {
            $total += $c->quantity * $c->tenantMenus->tenant_menu_price;
            }
            return view('customer.customer_checkout', compact('menu', 'total'));
            }

    public function handleCustomerCheckout(Request $request){
        $request->validate([
            'total_price' => 'required',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
            ]);
        $user_id = Auth::guard('web')->id();
        $user_cart = Cart::where('user_id', '=', $user_id)->first();
        $cart_id = $user_cart->id;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
