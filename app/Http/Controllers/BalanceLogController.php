<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use \App\Models\Balance;
use \App\Models\BalanceLog;
use \App\Http\Requests\Transfer;

class BalanceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(BalanceLog::with('balance')->get(), 200);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Transfer $request)
    {
        $validatedData = $request->validated();
        $creditor_user = $validatedData['creditor'];
        $debitor_user = $validatedData['debitor'];
        $amount  = $validatedData['amount'];

        $creditor = Balance::where('user_id', $creditor_user)->first();
        $debitor = Balance::where('user_id', $debitor_user)->first();
        if ($creditor == null && $debitor == null)
            return response("Neither creditor nor debitor exists", 400); //轉帳方與收款方皆不存在
        if ($creditor == null)
            return response("creditor does not exist", 400); //轉帳方不存在
        if ($debitor == null)
            return response("debitor does not exist", 400); //收款方皆不存在
        if ($creditor->balance < $amount)
            return response("Insufficient credit balance, balance is " . $creditor->balance, 400); //轉帳方餘額不足

        $new_creditor_money = $creditor->balance - $amount;
        $new_debitor_money = $debitor->balance + $amount;

        BalanceLog::create([
            'user_id' => $creditor_user,
            'transaction_type' => 'CREDIT',
            'amount' => $amount,
        ]);

        BalanceLog::create([
            'user_id' => $debitor_user,
            'transaction_type' => 'DEBIT',
            'amount' => $amount,
        ]);

        Balance::where('user_id', $creditor_user)->update(['balance' => $new_creditor_money]);
        Balance::where('user_id', $debitor_user)->update(['balance' => $new_debitor_money]);

        return response("tranfer success", 200);
    }
}
