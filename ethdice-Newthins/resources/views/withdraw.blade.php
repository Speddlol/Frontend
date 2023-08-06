@extends('layouts.test')

@section('title', 'withdraw')

@section('content')

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5jv1wvr5OnKe1mr2Au2jgq3a2CQEvW5t79jF0IC/" crossorigin="anonymous">

    <style>

.main-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 500px;
}
.custom-container {
    --container-padding: 32px;
    padding: var(--container-padding);
    font-family: Flama, sans-serif;
    font-size: 0.9375rem;
    color: rgba(146, 147, 166, 1);
    line-height: inherit;
    box-sizing: border-box;
    border-width: 0;
    border-style: solid;
    border-color: currentColor;
}
.card {
    top: 50%;
  left: 50%;
    margin-top: 15px;
  width: 300px;
  height: 200px;
  margin-right: 20px;
  background: white;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: white;

  border-radius: 60%
}

.img {
  height: 100%;
  width: 100%;
  position: absolute;
  z-index: 1;
}
img:hover {
  opacity: 0.8;
  cursor: pointer;
}

.textBox {
  opacity: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 15px;
  transition: 0.2s ease-in-out;
  z-index: 2;
}


.textBox > .text {
  font-weight: bold;
}

.textBox > .head {
  font-size: 20px;
}

.textBox > .price {
  font-size: 17px;
}

.textBox > span {
  font-size: 12px;
  color: lightgrey;
}


h4{
    color: white;
    font-weight: bold;
    font-family: 'Oswald', sans-serif;
    position: absolute;
    bottom: 380px;
}




       
.hidden {
    display: none;
}
.form-window-container {
    position: relative;
    width: 80%;
    max-width: 600px;
    height: 400px;
    border: 2px solid orange;
    background-color: #5c5c5c;
    border-radius: 10px;
    margin: auto;
    margin-top: 50px;
    padding: 20px;
}

.back-button {
    font-family: 'Oswald', sans-serif;
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 10px;
    font-size: 1.2rem;
    border: none;
    background-color: black;
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

.form-window-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 20px;
}

.form-window-content h3 {
    font-size: 2rem;
    margin-bottom: 20px;
}

.form-window-content p {
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.form-window-content form {
    width: 80%;
    max-width: 400px;
}
.form-window-content form button[type="submit"] {
    margin-top: 30px;
    width: 100%;
}

#withd{
    position: relative;
    right: 110px;
    
}  
.form-group{
    color: white;
    font-family: 'Oswald', sans-serif;
}
 h4 {
    top: 5px;
 }
 
 text
{
    font-family: 'Oswald', sans-serif; 
    color: white; text-align: center; 
    position: relative; 
    margin-top: 10%; 
    left: 50%; 
    transform: translate(-50%, -50%);
}
    </style>


    <title>Withdraw</title>
</head>
<body>
    <div class="main-container">   
        <div class="custom-container mt-5" style="position: relative;">
            <img src="{{ asset('icons/withdrawal.png') }}" id="withd" alt="Cahoot Logo" style="position: absolute; top: 10%; left: 50%; transform: translate(-50%, -50%);">
        <div class="row mb-5">
            
        </div>
        <div class="row">
            <div class="col-md-12">
               
                <div class="row row-cols-3 g-4">
                    <!-- Add more cryptocurrencies in the same format -->
                    <div class="d-flex justify-content-around">
                        <div class="card" onclick="showBSCWithdrawForm()">
                            <img src="{{ asset('icons/bnblogo.png') }}" class="img" alt="BNB" >
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div class="card" onclick="showETHWithdrawForm()">
                            <img src="{{ asset('icons/ethereumlogo.png') }}" class="img" alt="Ethereum">
                           
                            
                        </div>
                        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    </div>
    <text>We recommend withdrawing using Binance Coin as the gas fees are way lower.<br> Withdrawals will be checked manually during the beta launch, but we expect to handle them very quickly and 100% within 24 hours.<br> Please contact us in <a href="https://telegram.me/ethdiceofficial" style="text-decoration: underline;">telegram</a>, and we will handle the withdrawal request immediately.</text>

    <div id="eth-withdraw-form" class="hidden">
        <!-- ETH Withdrawal Form Here -->
        <div class="form-window-container">
            <button class="back-button" onclick="hideETHWithdrawForm()">Back</button>
            <div class="form-window-content">
                <h4>Withdraw Ethereum</h4>
                
                <form action="{{ route('withdraw.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="coins">Coins to Withdraw:</label>
                        <input type="number" name="coins" id="coins" class="form-control" min="1" max="{{ auth()->user()->coins }}" required>
                    </div>
                    <div class="form-group">
                        <label for="eth_address">Your Ethereum Address:</label>
                        <input type="text" name="eth_address" id="eth_address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gas Price Options:</label>
                        <div>
                            <input type="radio" id="gas_price_1" name="gas_price" value="{{ $gasPrice }}" checked>
                            <label for="gas_price_1">{{ ($gasPrice) }}</label>
                        </div>
                    </div>
                    <input type="hidden" name="gas_price" value="{{ $gasPrice }}">
                    <button type="submit" class="btn btn-primary" id="withdrawalButton">
                        Request Withdrawal ({{ ($gasPrice) }} coins)
                    </button>
                </form>
            </div>
        </div>
    </div>
        <div id="eth-withdraw-form" class="hidden">
        <!-- ETH Withdrawal Form Here -->
        <div class="form-window-container">
            <button class="back-button" onclick="hideETHWithdrawForm()">Back</button>
            <div class="form-window-content">
                <h3>Withdraw Ethereum</h3>
                
                <form action="{{ route('withdraw.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="coins">Coins to Withdraw:</label>
                        <input type="number" name="coins" id="coins" class="form-control" min="1" max="{{ auth()->user()->coins }}" required>
                    </div>
                    <div class="form-group">

                        <label for="eth_address">Ethereum Address</label>
                        <input type="text" name="eth_address" id="eth_address" class="form-control" required pattern="(0x[a-fA-F0-9]{40}|bnb[a-z0-9]{39})">>
                    </div>
                    <div class="form-group">
                        <label>Gas Price:</label>
                        <div>
                        <input type="radio" id="gas_price_1" name="gas_price" value="{{ $gasPrice }}" checked>
                            <label for="gas_price_1">{{ ($gasPrice) }}</label>
                        </div>
                    </div>
                    <input type="hidden" name="gas_price" value="{{ $gasPrice }}">
                    <button type="submit" class="btn btn-primary" id="withdrawalButton">
                        Request Withdrawal ({{ ($gasPrice) }} coins)
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div id="BSC-withdraw-form" class="hidden">
        <!-- ETH Withdrawal Form Here -->
        <div class="form-window-container">
            <button class="back-button" onclick="hideBSCWithdrawForm()">Back</button>
            <div class="form-window-content">
                <h4>Withdraw BNB</h4>
                
                <form action="{{ route('withdraw.store') }}" method="POST">
                    @csrf
                    <div class="form-group">

                        <label for="coins">Coins to Withdraw</label>
                        <input type="number" name="coins" id="bnb_coins" class="form-control" min="1" max="{{ auth()->user()->coins }}" required>
                    </div>
                    <div class="form-group">
                        <label for="bnb_address">BNB Address</label>
                        <input type="text" name="bnb_address" id="bnb_address" class="form-control" required pattern="(0x[a-fA-F0-9]{40}|bnb[a-z0-9]{39})">
                    </div>
                    <div class="form-group">
                        <label>Gas Price:</label>
                        <div>
                            <input type="radio" id="gas_price_1" name="gas_price" value="{{ $gasPrice }}" checked>
                            <label for="gas_price_1">{{ ($gasPriceBNB) }}</label>
                        </div>
                    </div>
                    <input type="hidden" name="gas_price" value="{{ $gasPriceBNB }}">
                    <button type="submit" class="btn btn-primary" id="bnb_withdrawalButton">
                        Request Withdrawal ({{ ($gasPriceBNB) }} coins)
                    </button>
                </form>
            </div>
        </div>
    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBud7LmALD/iT+8E7M/7wi8D7Cfd5KxK5E91eXlNX4ryXVpD" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5jv1wvr5OnKe1mr2Au2jgq3a2CQEvW5t79jF0IC/" crossorigin="anonymous"></script>
</body>
<script>
    // Get references to the input and button elements
    const coinsInput = document.getElementById('coins');
    const withdrawalButton = document.getElementById('withdrawalButton');

    // Add an event listener to the input element
    coinsInput.addEventListener('input', function(event) {
        // Calculate the total coins to withdraw
        const totalCoins = parseInt(event.target.value) + parseInt("{{ substr($gasPrice, 0, 4) + 1 }}");

        // Update the button label with the total coins
        withdrawalButton.innerText = `Request Withdrawal (${totalCoins} coins)`;
    });
    const bnbCoinsInput = document.getElementById('bnb_coins');
const bnbWithdrawalButton = document.getElementById('bnb_withdrawalButton');

// Add an event listener to the input element
bnbCoinsInput.addEventListener('input', function(event) {
    // Calculate the total coins to withdraw for BNB
    const totalBNBCoins = parseInt(event.target.value) + 1;

    // Update the button label with the total coins and gas price for BNB
    bnbWithdrawalButton.innerText = `Request Withdrawal (${totalBNBCoins} coins)`;
});
</script>

<script>
function showETHWithdrawForm() {
    
    document.querySelector('.main-container').classList.add('hidden');
    // Remove the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.add('hidden');
    // Display the ETH withdrawal form
    document.querySelector('#eth-withdraw-form').classList.remove('hidden');
}
function hideETHWithdrawForm() {
    // Hide the ETH withdrawal form
    document.querySelector('#eth-withdraw-form').classList.add('hidden');
    // Remove the "hidden" class from the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.remove('hidden');
    // Display the main container
    document.querySelector('.main-container').classList.remove('hidden');
}
function showBSCWithdrawForm() {
    
    document.querySelector('.main-container').classList.add('hidden');
    // Remove the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.add('hidden');
    // Display the ETH withdrawal form
    document.querySelector('#BSC-withdraw-form').classList.remove('hidden');
}
function hideBSCWithdrawForm() {
    // Hide the ETH withdrawal form
    document.querySelector('#BSC-withdraw-form').classList.add('hidden');
    // Remove the "hidden" class from the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.remove('hidden');
    // Display the main container
    document.querySelector('.main-container').classList.remove('hidden');
}
</script>
@endsection