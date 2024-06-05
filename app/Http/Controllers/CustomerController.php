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

        $quantity = CartItem::whereHas('carts', function ($query) use ($user_id){
            $query->where('user_id', $user_id);
        })->where('tenant_menu_id', $id)->first();
        if($quantity != null) $quantity = $quantity->quantity;
        else $quantity = 0;
        return view('customer.tenant_detail', compact('tenant', 'menu', 'quantity'));
    }
    public function handleAddToCart($id, $isUpdate){
        $currTenant = Tenant::whereHas('tenantMenus', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();
        $tenant_id = $currTenant->id;

        $currMenu_id = TenantMenu::where('id',$id)->first()->id;
        $user_id = Auth::guard('web')->id();

        // check if the cart is created
        $currCart = Cart::where('user_id', $user_id)->first();
        if($currCart == null) {
            $currCart = Cart::create([
                'user_id' => $user_id,
                'status' => 'true'
            ]);
        }

        $currCartItem = CartItem::where('cart_id', $currCart->id)->where('tenant_menu_id',$tenant_id)->first();

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
