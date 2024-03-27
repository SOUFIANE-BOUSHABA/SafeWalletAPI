<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class WalletController extends Controller
{
    //
    public function deposit(Request $request)
    {
        DB::beginTransaction();
    
        try {
            $user = auth()->user();
            $amount = $request->input('amount');

            if ($amount <= 0) {
                return response()->json([
                    'message' => 'Invalid amount'
                ], 400);
            }
            
            $user->wallet->balance += $amount;
            $user->wallet->save();
            
            $transaction = Transaction::create([
                'sender_wallet_id' => $user->wallet->id,
                'recipient_wallet_id' => $user->wallet->id, 
                'amount' => $amount,
                'type' => 'deposit'
            ]);

            DB::commit();
    
            return response()->json([
                'message' => 'Deposit successful',
                'balance' => $user->wallet->balance
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Deposit failed',
                'error' => $e->getMessage()
            ], 500);
        }
}
}
