@extends('transactions.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>PHP Mini Project Using Laravel</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('transactions.create') }}"> Create New Transaction</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Item</th>
            <th>Count</th>
            <th>Price</th>
            <th>Paid</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $transaction->item }}</td>
            <td>{{ $transaction->count }}</td>
            <td>{{ $transaction->price }}</td>
            <td>{{ $transaction->paid }}</td>
            <td>
                <form action="{{ route('transactions.destroy',$transaction->id) }}" method="DELETE">
   
                    <a class="btn btn-info" href="{{ route('transactions.show',$transaction->id) }}">Show</a>   
                    <a class="btn btn-primary" href="{{ route('transactions.edit',$transaction->id) }}">Edit</a>
                    <!--<a class="btn btn-danger" href="{{ route('transactions.destroy',$transaction->id) }}" data-method="DELETE">Delete</a>-->
                    <!--@csrf
                    @method('DELETE')-->
                    <button type="submit" class="btn btn-danger">Delete</button>
                    
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $transactions->links() !!}
      
@endsection