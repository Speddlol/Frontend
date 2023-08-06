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
                    <h3> ${{ $siteProfit }}</h3>
                    <span>Site Profit</span>
                </div>
            </div>
            <div class="val-box">
                <i class="fas fa-dollar-sign"></i>
                <div>
                    <h3>${{ $balance }}</h3>
                    <span>Dice tax Profit</span>
                </div>
            </div>
        </div>

        <section>
            <div class="board">
                <h2>Update Max Bet</h2>
                <form method="POST" action="{{ route('house.updateMaxBet') }}">
                    @csrf
                    @method('PUT')
                    <table width="100%">
                        <tr>
                            <td>
                                <label for="max_bet">Max Bet:</label>
                            </td>
                            <td>
                                <input type="number" id="max_bet" name="max_bet" value="{{ $maxBet }}" required>

                            </td>
                            <td>
                                <button type="submit" class="button confirm">Update</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </section>
        
        <script>
            $('#menu-btn').click(function() {
                $('#menu').toggleClass("active");
            })
        </script>
    

</body>

</html>