<!DOCTYPE html>
<html lang="en">
    @php
    $diceHouse = \App\Models\House::where('name', 'DiceHouse')->first();
    $balance = $diceHouse ? $diceHouse->coins : 0;
@endphp
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ethdice Dashboard</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />


    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
       .button {
    display: inline-block;
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.5;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    border: 1px solid transparent;
    border-radius: 4px;
    text-decoration: none;
}

.confirm {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}

.confirm:hover {
    color: #fff;
    background-color: #218838;
    border-color: #1e7e34;
}

.reject {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.reject:hover {
    color: #fff;
    background-color: #c82333;
    border-color: #bd2130;
} 

table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .input-group {
        margin-bottom: 0.5rem;
    }
    
    .input-group label {
        display: block;
        margin-bottom: 0.25rem;
        font-weight: bold;
        font-size: 0.75rem;
    }

    .input-group input,
    .input-group textarea,
    .input-group select {
        width: 100%;
        padding: 0.375rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 0.75rem;
    }

    .button.confirm {
        padding: 0.375rem 0.75rem;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        font-size: 0.75rem;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .button.confirm:hover {
        background-color: #0056b3;
    }
    </style>    

</head>

<body>

    @include('layouts.adminmenu')

    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div>
                    <i id="menu-btn" class="fas fa-bars"></i>
                </div>
                <div class="search">
                    <i class="far fa-search"></i>
                    <input type="text" placeholder="Search">
                </div>
            </div>

            <div class="profile">
                <i class="far fa-bell"></i>
                <img src="img/1.jpg" alt="">
            </div>
        </div>

        <h3 class="i-name">
            Dashboard
        </h3>

        <div class="values">
            <div class="val-box">
                <i class="fas fa-users"></i>
                <div>
                    <h3>{{ $total_users }}</h3>
                    <span>Users</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fas fa-shopping-cart"></i>
                <div>
                    <h3>{{ $totalGames }}</h3>
                    <span>Total Games</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fas fa-dollar-sign"></i>
                <div>
                    <h3> {{ $siteProfit }}</h3>
                    <span>Site Profit</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fas fa-dollar-sign"></i>
                <div>
                     <h3>{{ $totalDeposits }}</h3>
                    <span>Deposited</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fas fa-dollar-sign"></i>
                <div>
                    <h3>{{ $balance }}</h3>
                    <span>Dice tax Profit</span>
                </div>
            </div>
        </div>
        <section>
            
                <h3 class="i-name">
                    Betslip
                </h3>
            
                <form action="/create-betslip" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                
                    <div class="input-group">
                        <label for="odd_one">Odd 1</label>
                        <input type="number" step="0.01" name="odd_one" id="odd_one" class="form-control">
                    </div>
                
                    <div class="input-group">
                        <label for="odd_two">Odd 2</label>
                        <input type="number" step="0.01" name="odd_two" id="odd_two" class="form-control">
                    </div>
                
                    <div class="input-group">
                        <label for="odd_three">Odd 3</label>
                        <input type="number" step="0.01" name="odd_three" id="odd_three" class="form-control">
                    </div>
                
                    <div class="input-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                
                    <div class="input-group">
                        <label for="picture">Picture</label>
                        <input type="file" name="picture" id="picture" class="form-control">
                    </div>
                
                    <button type="submit" class="button confirm">Create</button>
                </form>
                
            
        </section>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Winning Odd</th>
                        <th>Close Betslip</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($betslips as $betslip)
                        <tr>
                            <td>{{ $betslip->id }}</td>
                            <td>{{ $betslip->name }}</td>
                            <td>
                                <form action="{{ route('closeBetslip', ['betslip' => $betslip->id]) }}" method="POST">
                                    @csrf
                                    <select name="winning_odd">
                                        <option value="odd_one" @if($betslip->winning_odd == 'odd_one') selected @endif>{{ $betslip->odd_one }}</option>
                                        <option value="odd_two" @if($betslip->winning_odd == 'odd_two') selected @endif>{{ $betslip->odd_two }}</option>
                                        <option value="odd_three" @if($betslip->winning_odd == 'odd_three') selected @endif>{{ $betslip->odd_three }}</option>
                                    </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Close Betslip</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
</section>


    <script>
        $('#menu-btn').click(function() {
            $('#menu').toggleClass("active");
        })
    </script>

    

</body>

</html>