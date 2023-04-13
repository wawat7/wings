@extends('layouts.master-layout')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Reports</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Transaction</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Items</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_code }}</td>
                            <td>{{ $transaction->user }}</td>
                            <td>{{ $transaction->total }}</td>
                            <td>{{ $transaction->date }}</td>
                            <td>
                                <ul>
                                    @foreach ($transaction->details as $detail)
                                        <li>{{ $detail->product->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
