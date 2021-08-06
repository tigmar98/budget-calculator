<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Budget;
use App\Models\Payment;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $balance = Auth::user()->budget[0]->balance;

        return view('payments.payments', [
                'balance' => $balance,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $balance = Auth::user()->budget[0]->balance;

        return view('payments.create', [
            'balance' => $balance
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Payment $payment, Budget $budget)
    {
        $request->validate([
            'payment_type' => 'required',
            'amount' => 'required'
        ]);

        $payment_type = $request->payment_type;
        $amount = $request->amount;
        $user_id = Auth::user()->id;
        $usr_budget = $budget->where('user_id', $user_id)->first();
        $new_balance = $usr_budget->balance;
        if($payment_type == 1){
            $new_balance = $usr_budget->balance + $amount;
        } elseif($payment_type == 2){
            $new_balance = $usr_budget->balance - $amount;
        }
        $payment->create(['payment' => $amount, 'budget_id' => $usr_budget->id, 'payment_type' => $payment_type]);
        $budget->where('user_id', $user_id)->update(['balance' => $new_balance]);
        return redirect('/payments');
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
