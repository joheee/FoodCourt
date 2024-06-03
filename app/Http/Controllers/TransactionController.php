<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $transactions = Order::where('user_id', $user_id)->where('order_status', '!=', 0)->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'order_id' => 'required|exists:orders,id',
    //         'payment_id' => 'required|exists:payments,id',
    //     ]);

    //     Transaction::create($request->all());

    //     return redirect()->route('transactions.index')
    //         ->with('success', 'Transaction created successfully.');
    // }

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
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }

    // Search function
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     $transactions = Transaction::where('order_id', $query)
    //         ->orWhere('payment_id', $query)
    //         ->get();

    //     return view('transactions.index', compact('transactions'));
    // }

    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'transaction_status' => 'required|string|max:255',
    //     ]);

    //     $transaction = Transaction::findOrFail($id);
    //     $transaction->update(['transaction_status' => $request->transaction_status]);

    //     return redirect()->route('transactions.index')
    //         ->with('success', 'Transaction status updated successfully.');
    // }
}
