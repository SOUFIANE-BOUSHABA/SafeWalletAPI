<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\User;

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

public function withdrawal(Request $request)
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

        if ($user->wallet->balance < $amount) {
            return response()->json([
                'message' => 'Insufficient balance'
            ], 400);
        }

        $user->wallet->balance -= $amount;
        $user->wallet->save();
        
        $transaction = Transaction::create([
            'sender_wallet_id' => $user->wallet->id,
            'recipient_wallet_id' => $user->wallet->id, 
            'amount' => $amount,
            'type' => 'withdrawal'
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Withdrawal successful',
            'balance' => $user->wallet->balance
        ]);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'message' => 'Withdrawal failed',
            'error' => $e->getMessage()
        ], 500);
    }
    
}

public function transfer(Request $request)
{
    DB::beginTransaction();

    try {
        $user = auth()->user();
        $amount = $request->input('amount');
        $recipient = User::find($request->input('recipient_id'));

        if ($amount <= 0) {
            return response()->json([
                'message' => 'Invalid amount'
            ], 400);
        }

        if ($user->wallet->balance < $amount) {
            return response()->json([
                'message' => 'Insufficient balance'
            ], 400);
        }

        if (!$recipient) {
            return response()->json([
                'message' => 'Recipient not found'
            ], 404);
        }

        $user->wallet->balance -= $amount;
        $user->wallet->save();
        
        $recipient->wallet->balance += $amount;
        $recipient->wallet->save();

        $transaction = Transaction::create([
            'sender_wallet_id' => $user->wallet->id,
            'recipient_wallet_id' => $recipient->wallet->id, 
            'amount' => $amount,
            'type' => 'transfer'
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Transfer successful',
            'balance' => $user->wallet->balance
        ]);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'message' => 'Transfer failed',
            'error' => $e->getMessage()
        ], 500);
    }


}

}