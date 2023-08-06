@extends('layouts.test')

@section('title', 'Bet History')

@section('content')

<style>
    .container {
        color: white;
        font-family: Oswald;

    }
    .table {
        color: white;
        font-family: Oswald;
        width: 50%;
    }
    .coins-image {
    vertical-align: middle;
   width: 20px;
  
    
}

.coins-value {
    display: inline-flex;
    align-items: center;
}



</style>
<div class="container">
    <h1>My Bet History</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Betslip Name</th> 
                <th>Selected Odd</th>
                <th>Bet Amount</th>
                <th>Multiplier</th>
                <th>Potential win</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
    @foreach($userBets as $bet)
        <tr>
            <td>{{ $bet->created_at }}</td>
            <td>{{ $betslipNames[$bet->betslip_id] }}</td>
            <td>{{ $bet->selected_odd }}</td>
            <td>
                <span class="coins-value">
                <img src="{{ asset('icons/coins3.png') }}" alt="coins" class="coins-image">
                    {{ $bet->bet_amount }}
                    
                </span>
            </td>
            <td>{{ $bet->multiplier }}</td>
            <td>
                <span class="coins-value">
                <img src="{{ asset('icons/coins3.png') }}" alt="coins" class="coins-image">
                {{ $bet->potential_win }}
                   
                </span>
            </td>
            <td>{{ $bet->status }}</td>
        </tr>
    @endforeach
</tbody>

    </table>
</div>
@endsection
