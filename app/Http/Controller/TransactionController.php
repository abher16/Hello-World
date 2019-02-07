<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(5);
  
        return view('transactions.index',compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$request->validate([
            'item' => 'required',
            'count' => 'required',
            'price' => 'required',
        ]);*/
        
        //Request::merge(['paid' => $request->count*$request->price]);

        $data = $request->all();
        $data['paid'] = $data['count']*$data['price'];

        Transaction::create($data);
   
        return redirect()->route('transactions.index')
                        ->with('success','Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show',compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit',compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'item' => 'required',
            'count' => 'required',
            'price' => 'required',
        ]);
  
        $transaction->update($request->all());
  
        return redirect()->route('transactions.index')
                        ->with('success','Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
  
        return redirect()->route('transactions.index')
                        ->with('success','Transaction deleted successfully');
    }
    
    public function delete(Transaction $transaction){
        //
    }
}
