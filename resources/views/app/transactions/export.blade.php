<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>User</th>
        <th>Total</th>
        <th>Bayar</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->user->name }}</td>
            <td>{{ $transaction->total_price }}</td>
            <td>{{ $transaction->pay }}</td>
            <td>{{ $transaction->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>