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
  margin-top: 15px;
  width: 195px;
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

#depo{
    position: relative;
    right: 110px;
    margin-bottom: 50px;
    width: 500px;
}  
    </style>
    <style>
            .table-container {
        position: absolute;
        width: 100%;
        top: 75%;
        justify-content: center;
        align-items: center;
    }
      table {
          
          width: 100%;
          border-collapse: collapse;
      }
      th, td {
          border: 1px solid #ccc;
          padding: 8px;
          text-align: left;
      }
      th {
          background-color: #797575;
      }
      tbody tr:nth-child(even) {
          background-color: #585656;
      }
      a {
          color: white;
          text-decoration: none;
      }
      a:hover {
          color: #ccc;
          text-decoration: underline;
      }
      table, th, td, tr, a {
          color: white;
      }
      h4{
    color: white;
    font-weight: bold;
    font-family: 'Oswald', sans-serif;
    position: absolute;
    bottom: 380px;
}


  </style>

    <title>Deposit</title>
    
<script async src="https://www.googletagmanager.com/gtag/js?id=G-868DP62C77"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-868DP62C77');
</script>

</head>
<body>
    <div class="main-container">   
        <div class="custom-container mt-5" style="position: relative;">
            <img src="{{ asset('icons/deposit.png') }}" id="withd" alt="Cahoot Logo" style="position: absolute; top: 1%; left: 50%; transform: translate(-50%, -50%);">
            <div class="row mb-5">
            
            </div>
            <div class="row">
                <div class="col-md-12">
                   
                    <div class="row row-cols-3 g-4">
                    <!-- Add more cryptocurrencies in the same format -->
                    <div class="d-flex justify-content-around">
                        <div class="card" onclick="showBSCdepositForm()">
                            <img src="{{ asset('icons/bnblogo.png') }}" class="img" alt="BNB" >
                         
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div class="card" onclick="showETHdepositForm()">
                            <img src="{{ asset('icons/ethereumlogo.png') }}" class="img" alt="Ethereum" >
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div class="card">
                            <img src="{{ asset('icons/stripe2.png') }}" class="img" alt="Stripe" >
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Hash</th>
                    <th>Value (ETH)</th>
                    <th>Value (Coins)</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deposits as $deposit)
                    <tr>
                        <td>
                            @if($deposit->network === 'ethereum')
                                <a href="https://etherscan.io/tx/{{ $deposit->hash }}" target="_blank">{{ $deposit->hash }}</a>
                            @elseif($deposit->network === 'bnb')
                                <a href="https://bscscan.com/tx/{{ $deposit->hash }}" target="_blank">{{ $deposit->hash }}</a>
                            @else
                                {{ $deposit->hash }}
                            @endif
                        </td>
                        <td>{{ $deposit->value }}</td>
                        <td>{{ $deposit->coin_value }}</td>
                        <td>{{ date('Y-m-d H:i:s', $deposit->timestamp) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="bsc-deposit-form" class="hidden">
        <!-- ETH Withdrawal Form Here -->
        <div class="form-window-container">
            <button class="back-button" onclick="hideBSCdepositForm()">Back</button>
            <div class="form-window-content">
            <h4 style="margin-top: 55px;">Deposit BNB</h4>

                <div class="form-group">
                <label for="eth_address" style="font-weight: bold; color: white">BNB Deposit Address:</label>

                    <input type="text" name="eth_address" id="eth_address" class="form-control" value="{{ auth()->user()->eth_address }}" readonly style="width: 150%;">
                    <button class="bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded-md" onclick="copyToClipboard()">Copy</button>
                </div>
                <div class="bg-white px-2 py-4 rounded-md">
                    <h2 class="text-2xl font-semibold mb-4">Coin Calculator:</h2>
                    <input type="number" id="bnb_coin_value" placeholder="Number of coins..">
                    <div id="bnb_value">BNB Value: -</div>

                
                </div>
              </div>
             

           
        </div>
        <p style="font-family: 'Oswald', sans-serif; color: white; text-align: center; margin-left: 20%;";>We recommend depositing using Binance Coin as the gas fees are way lower.<br>Deposits will be credited automatically within 5 minutes.<br> Please contact us in <a href="https://telegram.me/ethdiceofficial" style="text-decoration: underline;">telegram</a> if you have any issues!  </p>
    </div>
    <div id="eth-deposit-form" class="hidden">
      
      
      <div class="form-window-container">
            <button class="back-button" onclick="hideETHdepositForm()">Back</button>
            <div class="form-window-content">
            <h4 style="margin-top: 55px;">Deposit Ethereum</h4>

                <div class="form-group">
                <label for="eth_address" style="font-weight: bold; color: white">Ethereum Deposit Address:</label>

                    <input type="text" name="eth_address" id="eth_address" class="form-control" value="{{ auth()->user()->eth_address }}" readonly style="width: 150%;">
                    <button class="bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded-md" onclick="copyToClipboard()">Copy</button>
                </div>
                  <div class="bg-white px-2 py-4 rounded-md">
                    <h2 class="text-2xl font-semibold mb-4">Coin Calculator:</h2>
                    <input type="number" id="eth_coin_value" placeholder="Number of coins..">
                    <div id="eth_value">ETH Value: -</div>
                  
   
                
                 </div>
            </div>
          
        </div>
  <div id="stripe-deposit-form" class="hidden">
    <div class="form-window-container">
        <button class="back-button" onclick="hideStripeDepositForm()">Back</button>
        <div class="form-window-content">
            <div class="bg-gray-100 px-4 py-8 rounded-md max-w-md w-full">
                <h2 class="text-2xl font-semibold mb-4">Deposit</h2>
                <div class="bg-white px-4 py-8 rounded-md max-w-md w-full mt-8">
                    <form id="stripe-payment-form" action="{{ route('deposit.stripe') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="amount" class="block text-gray-700 font-bold mb-2">Deposit amount:</label>
                            <input type="number" id="amount" name="amount" placeholder="Enter deposit amount in dollars" required>
                        </div>
                        <div id="card-element" class="mb-4">
                            <!-- Stripe Elements Placeholder -->
                        </div>
                        <div id="card-errors" role="alert" class="text-red-500 mb-4"></div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  <p style="font-family: 'Oswald', sans-serif; color: white; text-align: center; position: relavite; top: 650px; margin-left: 300px">We recommend depositing using Binance Coin as the gas fees are way lower.<br>Deposits will be credited automatically within 5 minutes.<br> Please contact us in <a href="https://telegram.me/ethdiceofficial" style="text-decoration: underline;">telegram</a> if you have any issues! </p>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBud7LmALD/iT+8E7M/7wi8D7Cfd5KxK5E91eXlNX4ryXVpD" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5jv1wvr5OnKe1mr2Au2jgq3a2CQEvW5t79jF0IC/" crossorigin="anonymous"></script>
</body>
<script>
function showETHdepositForm() {
    
    document.querySelector('.main-container').classList.add('hidden');
    // Remove the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.add('hidden');
    // Display the ETH withdrawal form
    document.querySelector('#eth-deposit-form').classList.remove('hidden');
}
function hideETHdepositForm() {
    // Hide the ETH withdrawal form
    document.querySelector('#eth-deposit-form').classList.add('hidden');
    // Remove the "hidden" class from the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.remove('hidden');
    // Display the main container
    document.querySelector('.main-container').classList.remove('hidden');
}

function showBSCdepositForm() {
    
    document.querySelector('.main-container').classList.add('hidden');
    // Remove the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.add('hidden');
    // Display the ETH withdrawal form
    document.querySelector('#bsc-deposit-form').classList.remove('hidden');
}
function hideBSCdepositForm() {
    // Hide the ETH withdrawal form
    document.querySelector('#bsc-deposit-form').classList.add('hidden');
    // Remove the "hidden" class from the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.remove('hidden');
    // Display the main container
    document.querySelector('.main-container').classList.remove('hidden');
} 
function showSTRIPEdepositForm() {
    // Hide the main container
    document.querySelector('.main-container').classList.add('hidden');
    // Remove the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.add('hidden');
    // Display the Stripe deposit form
    document.querySelector('#stripe-deposit-form').classList.remove('hidden');
}
function hideSTRIPEdepositForm() {
    // Hide the Stripe deposit form
    document.querySelector('#stripe-deposit-form').classList.add('hidden');
    // Remove the "hidden" class from the cryptocurrency card grid
    document.querySelector('.row-cols-3').classList.remove('hidden');
    // Display the main container
    document.querySelector('.main-container').classList.remove('hidden');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/web3@1.6.0/dist/web3.min.js"></script>


<script>
const bnbCoinValueInput = document.getElementById('bnb_coin_value');
const ethCoinValueInput = document.getElementById('eth_coin_value');
const ethValueDisplay = document.getElementById('eth_value');
const bnbValueDisplay = document.getElementById('bnb_value');

ethCoinValueInput.addEventListener('input', function (event) {
    const coinValue = event.target.value;

    fetch('/convert-coins-to-eth?coin_value=' + coinValue)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const ethValue = data.eth_value;
            ethValueDisplay.textContent = 'ETH Value: ' + ethValue.toFixed(4);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});


bnbCoinValueInput.addEventListener('input', function (event) {
    const coinValue = event.target.value;

    fetch('/convert-coins-to-bnb?coin_value=' + coinValue)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const bnbValue = data.bnb_value;
            bnbValueDisplay.textContent = 'BNB Value: ' + bnbValue.toFixed(4);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});



</script>
<script>
    function copyToClipboard() {
      /* Get the text field */
      var copyText = document.getElementById("eth_address");
    
      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */
    
       /* Copy the text inside the text field */
      document.execCommand("copy");
    
      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
    }
    </script>

@endsection