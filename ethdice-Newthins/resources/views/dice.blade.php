@extends('layouts.test')

@section('title', 'Home')

@section('content')
    <head>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" href="{{ asset('css/dice.css') }}">

        <style>
            .styled-table {
              font-family: 'Oswald', sans-serif;
                position: relative;
              
                border-collapse: separate;
               

                margin: 10px 0;
                font-size: 0.75em;
                border-radius: 15px;
                border-spacing: 0;
                
                
                overflow: hidden;
            }

            .styled-table thead tr {
             
              background-color: orange;
  
                color: black;
                text-align: left;
                font-size: 14px;
            }

            .styled-table th,
            .styled-table td {
                padding: 7px 17px;
                height: 50px;
                
            }

            .styled-table tbody tr {
              border-bottom: 1px solid #dddddd;
 
            }
        
            .styled-table tbody tr:nth-of-type(even) {
              background-color: black;
            
            }

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #009879;
                font-family: 'Oswald', sans-serif;
                
            }

            .styled-table tbody tr.active-row {
              color: #009879;
              
                
            }

            .popup-button {
                font-family: 'Oswald', sans-serif;
                display: inline-block;
                font-size: 13px;
                margin-right: 7px;
                padding: 3px 7px;
                background-color: grey;
                border: 2px solid black;
                cursor: pointer;
                position: absolute;
                top: 0;
                left: 0;
                border-radius: 5px;
            }

            .buttons-container {
                margin-bottom: 10px;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: black;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid orange;
                width: 40%;
            }

            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .logo {
                position: absolute;
                margin-bottom: 300px;
                margin-left: 390px;
                width: 150px;
                height: 150px;
                opacity: 0.7;
            }

            

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }

            .info {
                position: absolute;
                font-family: 'Oswald', sans-serif;
                font-size: 10px;
                top: 420px;
            }

            .win-chance-input {
                font-family: 'Oswald', sans-serif;
                
            }
         
        
    
  .table-dark thead tr {
    background-color: orange;
    font-size: 0.75em;
    font-family: 'Oswald', sans-serif;
   
  
  }

  /* Set font color for the table headers */
  .table-dark th {
    font-family: 'Oswald', sans-serif;
    color: #fff;
    color: black;
    font-size: 16px;
   


   
  }
  .high-container {
  margin: 0;
  padding: 0;
}
  /* Set font color for the table rows */
  .table-dark td {
    font-family: 'Oswald', sans-serif;
    color: #fff;
   

    
  }

  /* Add a border to the table */
  .table-dark {
    font-family: 'Oswald', sans-serif;
    width: 100%;
    
  }

  /* Add a hover effect to the table rows */
  .table-dark tbody tr:hover {
    
    border: 2px solid black;
  }
 h2 {
  font-family: 'Oswald', sans-serif;
  margin-bottom: 15px;
 }
 .table-responsive {
  margin: 0;
  padding: 0;
}
#randNumValue {
  font-family: 'Oswald', sans-serif;
  position: absolute;
  top: 35%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 6em;
  color: white;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}
#mute-button {
 top: 10px;
 left: 10px;
  position: absolute;
  cursor: pointer;
  width:35px;
}

#mute-button img {
  position: absolute;

  border-radius: 100%;
  border: solid black 2px;
}

#mute-button.muted img {
  content: url("{{ asset('icons/mute.png') }}");
}
@media only screen and (max-width: 600px) {
  
  .styled-table th,
  .styled-table td {
    padding: 5px;
    font-size: 8px;
    height: auto;
  }
  
  .styled-table thead tr {
    font-size: 12px;
  }
  
  .logo {
    margin-bottom: 100px;
  }
  
  .info {
    font-size: 6px;
    top: 360px;
  }
  
  .modal-content {
    width: 80%;
  }
}

      
   
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>
    <body>
      <body>
        <div class="main-container">
        
          <div class="game-live-wrapper gap-4 xl:gap-0 xl:flex-row flex-col">
            <div class="game-container">
              <div class="left-container">
                <!-- Left container content -->
               
                <form id="dice-play-form" class="form-container" method="POST" action="{{ route('dice.play') }}">
                  @csrf
                  <div class="win-chance-input">
                      <label for="winChanceDisplay">Choose win chance with the slider. Roll within the blue area to win! </label>
                      <input type="text" id="winChanceDisplay" readonly style="color: black; border-radius: 10px;   text-align: center;
" disabled>
                        </div>
                  <div class="bet-container">
                    <label for="betAmount">Bet Amount:</label>
                    <input type="hidden" name="winChance" id="winChanceInput" value="{{ $winChance }}" style="border-radius: 6px; width: 20px;">
                    <div class="bet-input-modifiers">
                      <input type="number" id="betAmount" placeholder="0.00" name="betAmount" min="1" max="{{ min($balance, $max_bet) }}" value="{{ session('betAmount', $betAmount) }}" required>
                      <div class="bet-modifiers">
                        <button id="btn01" class="modifier-button">0.1</button>
                        <button id="btn1" class="modifier-button">1</button>
                        <button id="btn10" class="modifier-button">10</button>
                        <button id="btn2x" class="modifier-button">2x</button>
                        <button id="btnMin" class="modifier-button">Min</button>
                        <button id="btnMax" class="modifier-button">Max</button>
                        
                      </div>
                    </div>
                  </div>
                  <button class="button-69" type="submit">Roll the Dice!</button>
                  <div class="result">
                @if(session('winAmount'))
                      @if(session('result') == "win")
                       You rolled <span id="winRandNumValue">{{ session('randNumValue') }}</span> and won <span id="winAmount">{{ session('winAmount')}}</span> coins! 
                       <audio id="win-sound">
                          <source src="{{ asset('icons/win.mp3') }}" type="audio/mpeg">
                     </audio>

                       <script>
                          const muteButton = document.getElementById('mute-button');
                          let isMuted = localStorage.getItem('isMuted') === 'true';
                         var audio = document.getElementById("win-sound");
                         if (!isMuted) {
                            audio.play();
                          }
                         </script>
                      @else
                          
                          
                      @endif
                  @endif
                  </div>
                </form>
                
                  <button id="mute-button">
  <img src="{{ asset('icons/unmute.png') }}" alt="Unmute">
</button>
              
        


              </div>
              <div class="right-container">
                <!-- Right container content -->
                <div class="buttons-container">
                  <button id="button1"style="margin-left: 2px;" class="popup-button">Jackpot</button>
                  <button id="button2" style="margin-left: 65px;" class="popup-button">Fairness</button>
              </div>
              

                 <!-- Add the first modal (initially hidden) -->
                <div id="modal1" class="modal">
                  <div class="modal-content">
                      <span class="close close1">&times;</span>
                      <p>A Jackpot is a huge prize separate from your standard Dice wins, and comes as a percentage of Jackpot Pool.

                         
                       </p>
                  </div>
              </div>
               <!-- Add the second modal (initially hidden) -->
              <div id="modal2" class="modal">
                <div class="modal-content">
                    <span class="close close2">&times;</span>
                    <p>Each bet is generated using a random hash seed. More information coming!</p>
                </div>
            </div>
            
                <form method="GET" action="{{ route('dice.play') }}">
                  @csrf
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     
                      <div class="jackpot-coins">
                       JACKPOT &nbsp;
                      <img src="{{ asset('img/coins2.png') }}" alt="Coin Icon" height="20px" width="20px" >
                      <span id="jackpot-value" class="jackpot-value">{{ $jackpotCoins }}</span>

                      </div>
              
                      <div id="randNumValue">{{ session('randNumValue') }}</div>

                    <div class= "mid-div">
                      <input type="range" min="5" max="90" value="{{ session('winChance', $winChance) }}" id="slider" name="winChance" style="width: 600px;">
                      <div id="selector">
                          <div class="selectBtn"></div>
                          <div id="selectValue"></div>
                      </div>
                    </div>
                      <div class="win-info hidden md:flex">
                          <div class="win-chance" style="display: inline-block;">
                              <p>Win Chance:<br> </p><span id="win-chance">{{ $winChance }} </span>%
                          </div>
                          <div class="payout" style="display: inline-block; margin-left: 10px;">
                              <p>Multiplier:<br></p> <span id="payout">{{ $payout }}</span>x
                          </div>
                          <div class="win-amount" style="display: inline-block; margin-left: 10px;">
                              <p>Potential Win:<br></p> <span id="win-amount" style="prosent">{{ $winAmount }}</span>
                          </div>
                      </div>

                      <div class="info">
                            1 ethdice coin is worth exactly 0.5 USDT. Chance of winning jackpot is 1/100 000 when betting atleast 1 coin. <br>
                            Chosen win chance does not matter - chance of winning the jackpot stays the same! 

                      </div>
              </form>
              </div>
            </div>
            <div class="live-container md:ml-0 md:justify-center">
              <table id="new-games-table" class="styled-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Bet Amount</th>
                        <th>Win Chance</th>
                        <th>Won</th>
                    </tr>
                </thead>
                <tbody id="lastgames-tbody">
                    @foreach($lastGames as $game)
                        <tr>
                            <td>{{ $game->user->name }}</td>
                            <td>{{ $game->bet_amount }}</td>
                            <td>{{ $game->win_chance }}%</td>
                            <td style="{{ $game->win_amount ? 'color: green;' : '' }}">
                              {{ $game->win_amount ?? '' }}
                          </td>
                        </tr>
                    @endforeach
                    <!-- New games will be added here dynamically using JavaScript -->
                </tbody>
            </table>
            </div>
          </div>
          <h2>All Time Biggest Wins | Updates every Hour</h2>
          
            <!-- High container content -->
            <div class="high-container">
            <div class="table-responsive">
              <table class="table table-dark table-striped">
                <thead>
                  <tr>
                    <th scope="col">User</th>
                    <th scope="col">Win Amount</th>
                    <th scope="col">Time</th>
                  </tr>
                </thead>
                <tbody id="biggestwins-tbody">
                  @foreach($biggestWins as $win)
                    <tr>
                      <td>{{ $win->user->name }}</td>
                      <td>{{ $win->win_amount }}</td>
                      <td>{{ $win->created_at }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
 
      </body>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            var button1 = document.getElementById('button1');
            var button2 = document.getElementById('button2');
            var modal1 = document.getElementById('modal1');
            var modal2 = document.getElementById('modal2');
            var closeButton1 = document.getElementsByClassName('close1')[0];
            var closeButton2 = document.getElementsByClassName('close2')[0];
        
            function showModal1() {
                modal1.style.display = 'block';
            }
        
            function showModal2() {
                modal2.style.display = 'block';
            }
        
            function hideModal1() {
                modal1.style.display = 'none';
            }
        
            function hideModal2() {
                modal2.style.display = 'none';
            }
        
            button1.onclick = showModal1;
            button2.onclick = showModal2;
            closeButton1.onclick = hideModal1;
            closeButton2.onclick = hideModal2;
            window.onclick = function(event) {
                if (event.target == modal1) {
                    hideModal1();
                } else if (event.target == modal2) {
                    hideModal2();
                }
            };
        });
        </script>
        
        <script>

       
// Get the range input field and the win chance, payout, and win amount elements
const betAmountInput = document.getElementById('betAmount');
const slider = document.getElementById('slider');
const winChance = document.getElementById('win-chance');
const payout = document.getElementById('payout');
const winAmount = document.getElementById('win-amount');
const winChanceInput = document.getElementById('winChanceInput');
    
function updateWinAmount() {
    // Get the current value of the slider and bet amount input field
    const value = slider.value;
    const betAmount = parseFloat(betAmountInput.value);

    // Calculate the win chance, payout, and win amount based on the slider value
    let chance = value;
    let payoutValue = value == 100 ? 5 : (100 - value) / value + 1;

    // Subtract the house edge from the payout
    const houseEdge = 0.05; // 5% house edge
    payoutValue = payoutValue * (1 - houseEdge);
    payoutValue = payoutValue.toFixed(4);

    let amount = (payoutValue * betAmount).toFixed(2);

    // Update the text content of the win chance, payout, and win amount elements
    winChance.textContent = chance;
    payout.textContent = payoutValue;
    winAmount.textContent = amount;
    winChanceInput.value = value;

    // Update the win chance input field
    const winChanceDisplay = document.getElementById('winChanceDisplay');
    winChanceDisplay.value = chance;
}

// Add an event listener to the bet amount input field to update the win amount
betAmountInput.addEventListener('change', updateWinAmount);

// Add an event listener to the slider to update the win chance, payout, and win amount elements
slider.addEventListener('input', updateWinAmount);


// Call updateWinAmount() to initialize win amount based on the initial bet amount
updateWinAmount();

document.getElementById("btn01").addEventListener("click", function(event) {
  event.preventDefault();
  var betAmount = document.getElementById("betAmount");
  betAmount.value = 0.1;
  updateWinAmount();
});

document.getElementById("btn1").addEventListener("click", function(event) {
  event.preventDefault();
  var betAmount = document.getElementById("betAmount");
  betAmount.value = 1;
  updateWinAmount();
});

document.getElementById("btn10").addEventListener("click", function(event) {
  event.preventDefault();
  var betAmount = document.getElementById("betAmount");
  betAmount.value = 10;
  updateWinAmount();
});

document.getElementById("btn2x").addEventListener("click", function(event) {
  event.preventDefault();
  var betAmount = document.getElementById("betAmount");
  betAmount.value = parseFloat(betAmount.value) * 2;
  updateWinAmount();
});

document.getElementById("btnMin").addEventListener("click", function(event) {
  event.preventDefault();
  var betAmount = document.getElementById("betAmount");

  betAmount.value = betAmount.min;
  updateWinAmount();

});

document.getElementById("btnMax").addEventListener("click", function(event) {
  event.preventDefault();
  var betAmount = document.getElementById("betAmount");
  betAmount.value = betAmount.max;
  updateWinAmount();
});





document.addEventListener('DOMContentLoaded', () => {
  showRandomNr()
const muteButton = document.getElementById('mute-button');
let isMuted = localStorage.getItem('isMuted') === 'true';

if (isMuted) {
  muteButton.classList.add('muted');
  muteButton.firstChild.src = '{{ asset('icons/mute.png') }}';
}

muteButton.addEventListener('click', () => {
  isMuted = !isMuted;
  localStorage.setItem('isMuted', isMuted);
  muteButton.classList.toggle('muted', isMuted);
  muteButton.firstChild.src = isMuted ? '{{ asset('icons/mute.png') }}' : '{{ asset('icons/unmute.png') }}';
  
});
});
  </script>

@vite('resources/js/bootstrap.js')
<script type="module">

Echo.channel('DiceRolled').listen('.DiceRolledEvent',(e) => {
  console.log('[received]', e)
  const {biggestWins, lastGames, jackpotCoins} = e.message
  reRenderTables(biggestWins, lastGames, jackpotCoins)
})
</script>

<script>

  var maxBet = {{ $max_bet }};

  function reRenderTables(biggestWins, lastGames, jackpotCoins) {
  

    document.getElementById('lastgames-tbody').innerHTML = lastGames.reduce((total, e) => {
      let {win_amount} = e
      let styleWinAmount = ""
      if(win_amount)
      styleWinAmount = "color:green"
      return `${total}<tr><td>${e.user.name}</td><td>${e.bet_amount}</td><td>${e.win_chance}</td><td style=${styleWinAmount}>${win_amount ? win_amount : ''}</td></tr>`
    }, "")

    document.getElementById('jackpot-value').innerHTML = jackpotCoins
  }

  function updateUI (response) {
    const { biggestWins, lastGames, balance, randNumValue, result, winAmount, jackpotCoins, jackpotWin} = response
    showRandomNr(randNumValue)
    updateBalance(balance)
    updateWinAmount(result, winAmount, randNumValue)
    document.getElementById('betAmount').max = Math.min(balance, maxBet);

    reRenderTables(biggestWins, lastGames, jackpotCoins)

    if (result == "win") {
      const muteButton = document.getElementById('mute-button');
      let isMuted = localStorage.getItem('isMuted') === 'true';
      var audio = document.getElementById("win-sound");
      if (!isMuted) {
        audio.play();
      }
    }
    if (jackpotWin) {
        swal("Congratulations!", "You won the jackpot!", "success");
    }
}

  $('#dice-play-form').submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      data: $(this).serialize(), 
      success: function(response) {
        console.log(response)
        updateUI(response)
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(status + ": " + error); // Log the error
      }
    })
  })

  function updateBalance(balance) {
    document.querySelector('.coin-balance').innerHTML = balance.toFixed(2)
  
   
  }


  function showRandomNr (value = undefined) {
    var randNumValue = document.getElementById('randNumValue');
    if(value) {
      randNumValue.innerHTML = value
    }
    

    // Show the randNumValue and set a timeout to fade it out
    randNumValue.style.opacity = 1;
    setTimeout(function() {
      randNumValue.style.opacity = 0;
    }, 1000); // Change the time (in milliseconds) to adjust how long the value stays on the screen
  }

function updateWinAmount (result, winAmount, randNumValue) {
    if (typeof result === 'undefined' || typeof winAmount === 'undefined' || typeof randNumValue === 'undefined') {
        return; // Exit the function if any argument is undefined
    }
    var resultDiv = document.querySelector('.result')
    var resultHTML = ""
    if(result == "win"){
        resultHTML = "You rolled <span id='winRandNumValue'>" + randNumValue + "</span> and won <span id='winAmount'>" + winAmount.toFixed(2) + "</span> coins!  \
                   <audio id='win-sound'> \
                      <source src=\"{{ asset('icons/win.mp3') }}\" type='audio/mpeg'> \
                 </audio>"
    }
    else resultHTML = "You rolled <span id='winRandNumValue'>" + (randNumValue || '') + "</span> and lost."

    resultDiv.innerHTML = resultHTML
  }


</script>

    @endsection

    
        
       