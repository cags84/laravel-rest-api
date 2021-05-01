<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /* Create account with initial balance */
    // POST /event {"type": "deposit", "destination": "100", "amount": 10}
    // 201 {"destination": {"id": "100", "balance": 10}}
    public function store(Request $request)
    {
        // Event::create(...)
        if ($request->input('type') === 'deposit') {
            return $this->deposit(
                $request->input('destination'),
                $request->input('amount')
            );
        }

    }

    private function deposit($destination, $amount)
    {
        // Me devuelve el primero si lo encuentra, caso contrario, lo crea con el id destination y me devulve ese dato.
        $account = Account::firstOrCreate([
            'id' => $destination
        ]);

        $account->balance += $amount;

        $account->save(); // Update

        return response()->json([
            'destination' => [
                'id' => $account->id,
                'balance' => $account->balance
            ]
        ], 201);

    }

}
