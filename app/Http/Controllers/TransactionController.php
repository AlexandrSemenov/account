<?php

namespace App\Http\Controllers;

use App\Classes\Exchange;
use App\Classes\Total;
use App\Transaction;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Total $total, Exchange $exchange)
    {
        $sale = $exchange->getExchange();
        $transactions = DB::table('transactions')->join('typies', 'transactions.type', '=', 'typies.id')
            ->select('transactions.id', 'description', 'amount', 'date', 'type', 'name')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $total = $total->countTotal($transactions);
        return view('home', ['transactions' => $transactions, 'total' => $total, 'sale' => $sale]);
    }

    public function filter(Total $total, Request $request, Exchange $exchange)
    {
        $sale = $exchange->getExchange();
        $transactions = DB::table('transactions')->join('typies', 'transactions.type', '=', 'typies.id')
            ->select('transactions.id', 'description', 'amount', 'date', 'type', 'name')
            ->where('user_id', '=', Auth::user()->id)
            ->whereBetween('date', [$request['date_from'], $request['date_till']])
            ->get();

        $total = $total->countTotal($transactions);
        return view('home', ['transactions' => $transactions, 'total' => $total, 'sale' => $sale]);
    }

    public function create()
    {
        return view('transaction.index');
    }

    public function save(Request $request)
    {
        if(Auth::user())
        {
            $this->validate($request, [
                'description' => 'required',
                'amount' => 'required',
                'type' => 'required'
            ], $messages = [
                'description.required' => 'Поле должно быть заполнено',
                'amount.required' => 'Поле должно быть заполнено',
                'type.required' => 'Поле должно быть заполнено'
            ]);

            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->description = $request['description'];
            $transaction->amount = $request['amount'];
            $transaction->type = $request['type'];
            $transaction->date = $request['date'];

            $transaction->save();

            return redirect()->route('home');
        }

        return redirect()->route('home');
    }

    public function edit($id)
    {
        if(Auth::user())
        {
            $transaction = Transaction::find($id);
            return view('transaction.edit', ['transaction' => $transaction]);
        }

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required',
            'amount' => 'required',
            'type' => 'required'
        ], $messages = [
            'description.required' => 'Поле должно быть заполнено',
            'amount.required' => 'Поле должно быть заполнено',
            'type.required' => 'Поле должно быть заполнено'
        ]);

        $transaction = Transaction::find($id);
        $transaction->description = $request['description'];
        $transaction->amount = $request['amount'];
        $transaction->type = $request['type'];
        $transaction->date = $request['date'];

        $transaction->update();

        return redirect()->route('home');
    }

    public function delete($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();

        return redirect()->route('home');
    }

}
