@extends('layouts.test')

@section('title', 'Coinflip')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .main-container {
            padding: 20px;
            
        }
        .btn1 {
  display: inline-block;
  padding: 10px 20px;
  background-color: orange;
  color: black;
  border: none;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  font-family: 'Oswald', sans-serif;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out, transform 0.2s ease-in-out;
}

.btn1:hover {
  background-color: #ff8c00; /* Darker shade of orange */

  transform: scale(1.05);
}


 

}

        .top-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .my-games-container,
        .live-games-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .game-card {
            width: 360px;
          display: flex;
          border-radius: 20px; 
            padding: 20px;
            height: 200px;
            background: #212121;
            box-shadow: 10px 10px 10px rgb(25, 25, 25),
                -10px -10px 10px rgb(60, 60, 60);
        }
 .vs-container {
  display: flex;
  align-items: center;
  width: 30px;
  padding: 10px;
  justify-content: center;
  position: relative
}
.vs-text {
  font-size: 18px; /* Adjust font size as needed */
  color: white;
  margin: 0; /* Remove any default margin */
  padding: 0; /* Remove any default padding */
}
        
.player-card {
  display: flex;
  height: 170px;
  border-radius: 20px; /* Add this line to round the corners */
  background: #383838;
  flex-direction: column;
  align-items: center;
   justify-content: flex-end;
  width: 145px; /* Adjust width as needed */
   padding: 3px;
}
.player-card-2 {
  display: flex;
  height: 170px;
  border-radius: 20px; /* Add this line to round the corners */
  background: #383838;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
  width: 145px; /* Adjust width as needed */
  padding: 3px;
}
.join-container {
margin-bottom: 45px;
padding-top: 40px;
}
        .join-game-btn {
             
            display: inline-block;
            background-color: #27ae60;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
        }

        .join-game-btn:hover {
            background-color: #2ecc71;
        }
        body {
    color: #ffffff;
}
h2 {
  font-size: 30px;
  font-weight: bold;
  padding: 10px;
}
input[type="number"] {
  color: black;
}
.dots-container {
  display: flex;
  align-items: center;
}

.dot {
  display: inline-block;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
  cursor: pointer;
  border: 2px solid #ccc;
  background-size: cover
}

.dot-heads {
  background-image: url(/icons/eth.png);
}

.dot-tails {
  background-image: url(/icons/btc.png);
  
}

.dot.active {
  border-color: #27ae60;
}

#chosen_side {
  display: none;
}
.coin-container {
  width: 200px;
  height: 200px;
  position: relative;
}

#coin {
  position: relative;
  margin: 0 auto;
  width: 100px;
  height: 100px;
  cursor: pointer;
}
#coin div {
  width: 100%;
  height: 100%;
  -webkit-border-radius: 50%;
     -moz-border-radius: 50%;
          border-radius: 50%;
  -webkit-box-shadow: inset 0 0 45px rgba(255,255,255,.3), 0 12px 20px -10px rgba(0,0,0,.4);
     -moz-box-shadow: inset 0 0 45px rgba(255,255,255,.3), 0 12px 20px -10px rgba(0,0,0,.4);
          box-shadow: inset 0 0 45px rgba(255,255,255,.3), 0 12px 20px -10px rgba(0,0,0,.4);
}
.side-a {
     background-image: url('{{ asset('icons/eth.png') }}');
    background-size: cover;
    background-position: center;
    z-index: 1
  }

  .side-b {
    background-image: url('{{ asset('icons/btc.png') }}');
    background-size: cover;
    background-position: center;
    z-index: 1
  }

#coin {
  transition: -webkit-transform 1s ease-in;
  -webkit-transform-style: preserve-3d;
}
#coin div {
  position: absolute;
  -webkit-backface-visibility: hidden;
}
.side-b {
 

}

#coin.heads {
  -webkit-animation: flipHeads 3s ease-out forwards;
  -moz-animation: flipHeads 3s ease-out forwards;
    -o-animation: flipHeads 3s ease-out forwards;
       animation: flipHeads 3s ease-out forwards;
}
#coin.tails {
  -webkit-animation: flipTails 3s ease-out forwards;
  -moz-animation: flipTails 3s ease-out forwards;
    -o-animation: flipTails 3s ease-out forwards;
       animation: flipTails 3s ease-out forwards;
}


.profile-picture {
  width: 75px;
  height: 75px;
  border-radius: 50%;
  margin-bottom: 10px;
  margin-top: 10px;
}
.username {
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  margin-bottom: 5px;
}
.coin-icon {
  width: 20px;
  height: 20px;
  vertical-align: middle;
  margin-right: 8px;
}
.coin-box {
 
  background-color: black;
  border-radius: 2px;
  padding: 3px 6px;
  border: 2px solid orange;
  border-radius: 5px;
  padding: 5px;
  align-items: center;
  justify-content: center;
  
}

.coin-balance {
  display: inline-block;
  margin: 1px;
  font-size: 14px;
  font-weight: bold;
}

@-webkit-keyframes flipHeads {
  from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
  to { -webkit-transform: rotateY(1800deg); -moz-transform: rotateY(1800deg); transform: rotateY(1800deg); }
}
@-webkit-keyframes flipTails {
  from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
  to { -webkit-transform: rotateY(1980deg); -moz-transform: rotateY(1980deg); transform: rotateY(1980deg); }
}
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

    /* Coin Animation */
    .purse {
        height: 160px;
        width: 160px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -80px;
        margin-left: -80px;
        -webkit-perspective: 1000;
        -webkit-box-reflect: below 0 linear-gradient(hsla(0, 0%, 100%, 0), hsla(0, 0%, 100%, 0) 45%, hsla(0, 0%, 100%, 0.2));
        -webkit-filter: saturate(1.45) hue-rotate(2deg);
    }

    .coin {
        height: 160px;
        width: 160px;
        position: absolute;
        -webkit-transform-style: preserve-3d;
        -webkit-transform-origin: 50%;
        -webkit-animation-timing-function: linear;
        -webkit-animation-fill-mode: forwards;
    }

    .coin-1 {
      -webkit-animation: flipcoin1 3s ;
      -webkit-animation-fill-mode: forwards;

    }

    .coin-2 {
      -webkit-animation: flipcoin2 3s ;
      -webkit-animation-fill-mode: forwards;

    }

    .coin .front,
    .coin .back {
        position: absolute;
        height: 160px;
        width: 160px;
        border-radius: 50%;
        background-size: cover;
    }

    .coin .front {
        -webkit-transform: translateZ(8px);
    }

    .coin .back {
        -webkit-transform: translateZ(-8px) rotateY(180deg);
    }

    .coin .side {
        -webkit-transform: translateX(72px);
        -webkit-transform-style: preserve-3d;
        -webkit-backface-visibility: hidden;
    }

    .coin .side .spoke {
        height: 160px;
        width: 16px;
        position: absolute;
        -webkit-transform-style: preserve-3d;
        -webkit-backface-visibility: hidden;
    }

    .coin .side .spoke:before,
    .coin .side .spoke:after {
        content: '';
        display: block;
        height: 15.68274245px;
        width: 16px;
        position: absolute;
        -webkit-transform: rotateX(84.375deg);
        background: hsl(42, 52%, 68%);
        background: linear-gradient(to bottom, hsl(42, 60%, 75%) 0%, hsl(42, 60%, 75%) 74%, hsl(42, 40%, 60%) 75%, hsl(42, 40%, 60%) 100%);
        background-size: 100% 3.48505388px;
    }

    .coin .side .spoke:before {
        -webkit-transform-origin: top center;
    }

    .coin .side .spoke:after {
        bottom: 0;
        -webkit-transform-origin: center bottom;
    }

    .coin .side .spoke:nth-child(16) {
        -webkit-transform: rotateY(90deg) rotateX(180deg);
    }

    .coin .side .spoke:nth-child(15) {
        -webkit-transform: rotateY(90deg) rotateX(168.75deg);
    }

    .coin .side .spoke:nth-child(14) {
        -webkit-transform: rotateY(90deg) rotateX(157.5deg);
    }

    .coin .side .spoke:nth-child(13) {
        -webkit-transform: rotateY(90deg) rotateX(146.25deg);
    }

    .coin .side .spoke:nth-child(12) {
        -webkit-transform: rotateY(90deg) rotateX(135deg);
    }

    .coin .side .spoke:nth-child(11) {
        -webkit-transform: rotateY(90deg) rotateX(123.75deg);
    }

    .coin .side .spoke:nth-child(10) {
        -webkit-transform: rotateY(90deg) rotateX(112.5deg);
    }

    .coin .side .spoke:nth-child(9) {
        -webkit-transform: rotateY(90deg) rotateX(101.25deg);
    }

    .coin .side .spoke:nth-child(8) {
        -webkit-transform: rotateY(90deg) rotateX(90deg);
    }

    .coin .side .spoke:nth-child(7) {
        -webkit-transform: rotateY(90deg) rotateX(78.75deg);
    }

    .coin .side .spoke:nth-child(6) {
        -webkit-transform: rotateY(90deg) rotateX(67.5deg);
    }

    .coin .side .spoke:nth-child(5) {
        -webkit-transform: rotateY(90deg) rotateX(56.25deg);
    }

    .coin .side .spoke:nth-child(4) {
        -webkit-transform: rotateY(90deg) rotateX(45deg);
    }

    .coin .side .spoke:nth-child(3) {
        -webkit-transform: rotateY(90deg) rotateX(33.75deg);
    }

    .coin .side .spoke:nth-child(2) {
        -webkit-transform: rotateY(90deg) rotateX(22.5deg);
    }

    .coin .side .spoke:nth-child(1) {
        -webkit-transform: rotateY(90deg) rotateX(11.25deg);
    }

    .coin.skeleton .front,
    .coin.skeleton .back {
        display: none;
    }

    .coin.skeleton .side,
    .coin.skeleton .side .spoke,
    .coin.skeleton .side .spoke:before,
    .coin.skeleton .side .spoke:after {
        -webkit-backface-visibility: visible;
    }

    .coin.skeleton .side .spoke {
        background: rgba(170, 170, 170, 0.1);
    }

    .coin.skeleton .side .spoke:before {
        background: rgba(255, 170, 170, 0.2);
    }

    .coin.skeleton .side .spoke:after {
        background: rgba(204, 204, 255, 0.2);
    }
    

    @-webkit-keyframes flipcoin1 {
        from {
            -webkit-transform: rotateY(0deg) scale(.5);
        }

        50% {
            -webkit-transform: rotateY(360deg) scale(2)
        }

        to {
            -webkit-transform: rotateY(720deg) scale(.5);
            
        }
    }

    @-webkit-keyframes flipcoin2 {
        from {
            -webkit-transform: rotateY(0deg) scale(.5);
        }

        50% {
            -webkit-transform: rotateY(360deg) scale(2)
        }

        to {
            -webkit-transform: rotateY(900deg) scale(.5);
            
        }
    }

    .coin .front {
        /* background-image: url(./coin-ct-1ea3e21b.png) */
        background-image: url(/icons/btc.png);
    }

    .coin .back {
        /* background-image: url(./coin-t-a17e908e.png) */
        background-image: url(/icons/eth.png);
    }

    .modifier-button {
      font-family: 'Oswald', sans-serif;
      background-color: orange;
      color: black;
      text-align: center;
      font-size: 11px;
      cursor: pointer;
      width: 30px;
      height: 20px;
      border-radius: 5px;
      padding: 0px;
    }

    .modifier-button:hover {
      color: black;
      opacity: 0.7;
    }

    input:focus {
      outline: none;
    }
    .player-card, .player-card-2 {
      position: relative;
    }

    </style>
    
    <body>
      <div class="main-container">
        <div class="top-container" style="display: flex; justify-content: space-between;">
          <div>
            <h2 style="font-size: 36px; font-weight: bold;">COINFLIP</h2>
          </div>
          <div style="display: flex; align-items: center;">
            <form action="{{ route('coinflip.create_game') }}" method="POST" class="flex align-items-center">
              @csrf
              <div class="flex align-items-center">
                <label for="bet_amount" style="margin-right: 10px;">Bet:</label>
                <input type="number" name="bet_amount" class="pl-8 text-white bg-no-repeat h-11 w-24 bg-transparent font-bold" id="bet_amount" required style="background-image: url(/icons/coins3.png); border: 1px solid white; background-size: 18px; background-position: 5px 5px; border-color: rgb(51 53 65 / var(--tw-border-opacity));" placeholder="0.00" value="0.00" min="1" max="1000">
                <div class="mr-3 h-11 flex align-items-center gap-1 pl-2 pr-2" style="border: 1px solid white; border-color: rgb(51 53 65 / var(--tw-border-opacity));">
                  <button data-operation="plus" data-value="0.1" class="modifier-button" type="button">0.1</button>
                  <button data-operation="plus" data-value="1" class="modifier-button" type="button">1</button>
                  <button data-operation="plus" data-value="10" class="modifier-button" type="button">10</button>
                  <button data-operation="multiple" data-value="2" class="modifier-button" type="button">2x</button>
                  <button data-operation="min" class="modifier-button">Min</button>
                  <button data-operation="max" class="modifier-button">Max</button>
                </div>
              </div>
              <div class="flex align-items-center">
                <label for="chosen_side" style="margin-right: 10px;">Choose a side:</label>
                <div class="dots-container">
                  <input type="hidden" name="chosen_side" id="chosen_side" value="heads">
                  <span class="dot dot-heads active"></span>
                  <span class="dot dot-tails"></span>
                </div>
              </div>
              
              <button type="submit" class="btn1">Create Game</button>
            </form>
          </div>
        </div>
        <div class="my-games-wrapper">
          <h2 class="heading-secondary">My Games</h2>
          <div class="my-games-container">
            @forelse ($myGames as $game)
            <div class="game-card game-{{$game->id}}">
              <div class="player-card">
                <div class="profile-picture {{ $game->chosen_side == 'heads' ? 'side-a' : 'side-b' }}"></div>
                <div class="player-info">
                  <div class="username">{{ $game->user->name }}</div>
                  <div class="coin-box">
                    <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
                    <p class="coin-balance">{{ $game->bet_amount }}</p>
                  </div>
                </div>
              </div>
            
              <div class="vs-container">
                <p class="vs-text">VS</p>
              </div>
            
              <div class="player-card-2">
                <!-- Add a second player-card structure here, you can replace the data with appropriate values -->
                @if (auth()->check() && $game->user_id != auth()->user()->id)
                <div class="join-container">
                  <form id="join-form-{{ $game->id }}" action="{{ route('coinflip.join_game', $game->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn1">Join Game</button>
                  </form>
                </div>
                @endif
                <div class="coin-box">
                  <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px" >
                  <p class="coin-balance">{{ $game->bet_amount }}</p>
                </div>
              </div>
            </div> <!-- Make sure this closing div tag is placed here -->
            @empty
            <p>No games found.</p>
            @endforelse
          </div>
        </div>
        <div class="live-games-wrapper">
          <h2 class="heading-secondary">Live Games</h2>
          <div class="live-games-container" id="open-games-container">
            @forelse ($openGames as $game)
            <div class="game-card game-{{ $game->id }}">
              <div class="player-card">
                <div class="profile-picture {{ $game->chosen_side == 'heads' ? 'side-a' : 'side-b' }}"></div>
                <div class="player-info">
                  <div class="username">{{ $game->user->name }}</div>
                  <div class="coin-box">
                    <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
                    <p class="coin-balance">{{ $game->bet_amount }}</p>
                  </div>
                </div>
              </div>
            
              <div class="vs-container">
                <p class="vs-text">VS</p>
              </div>
            
              <div class="player-card-2">
                <!-- Add a second player-card structure here, you can replace the data with appropriate values -->
                <div class="join-container">
                  @if (auth()->check() && $game->user_id != auth()->user()->id)
                  <form id="join-form-{{ $game->id }}" action="{{ route('coinflip.join_game', $game->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn1">Join Game</button>
                  </form>
                  @endif
                </div>
                <div class="coin-box">
                  <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
                  <p class="coin-balance">{{ $game->bet_amount }}</p>
                </div>
              </div>
            </div> <!-- Make sure this closing div tag is placed here -->
            @empty
            <p>No games found.</p>
            @endforelse
          </div>
      </div>
    </body>
<script>
 const dots = document.querySelectorAll('.dot');
dots.forEach(dot => {
  dot.addEventListener('click', (e) => {
    // Remove active class from all dots
    dots.forEach(dot => dot.classList.remove('active'));
    // Set active class to clicked dot
    e.target.classList.add('active');
    // Update chosen_side input value
    const chosenSideInput = document.querySelector('#chosen_side');
    chosenSideInput.value = e.target.classList.contains('dot-heads') ? 'heads' : 'tails';
  });
});   

jQuery(document).ready(function($){

$('#coin').on('click', function(){
  var flipResult = Math.random();
  $('#coin').removeClass();
  setTimeout(function(){
    if(flipResult <= 0.5){
      $('#coin').addClass('heads');
      console.log('it is head');
    }
    else{
      $('#coin').addClass('tails');
      console.log('it is tails');
    }
  }, 100);
});

$('.modifier-button').click(function() {
  let value = Number.parseInt($('#bet_amount').val()).toFixed(2)
  const operation = $(this).data('operation')
  const operand = Number.parseInt($(this).data('value')).toFixed(2)
  console.log(operation, operand, value, Number(value) * Number(operand))

  switch (operation) {
    case 'plus':
      value = Number(value) + Number(operand)
      break;
    case 'multiple':
      value = Number(value) * Number(operand);
      break;
    case 'max':
      value = 1000
      break;
    case 'min': 
      value = 1
      break;
    default:
      break;
  }
  if(value > 1000) value = 1000
  console.log(operation, operand, value)

  $('#bet_amount').val(value)
})

});




    </script>

@vite('resources/js/bootstrap.js')
<script type="module">

Echo.channel('CoinFlipGameJoined').listen('.CoinFlipGameJoinedEvent', e => {
  const { id, chosen_side_2, bet_amount, user, user_2, winner } = e.message.game
  
  $(`.game-${id} .player-card-2`).html(`
      <div class="profile-picture ${chosen_side_2 == 'heads' ? 'side-a' : 'side-b'}"></div>
      <div class="player-info">
        <div class="username">${user_2 ? user_2.name : '?'}</div>
        <div class="coin-box">
          <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
          <p class="coin-balance">${bet_amount}</p>
        </div>
      </div>
  `)
  let nCount = 4
  let vsText = $(`.game-${id} .vs-container .vs-text`)
  let countDown = setInterval(() => {
    nCount--
    if(nCount < 0){
      clearInterval(countDown)
      vsText.html(`
        <div class="purse" style="z-index:101">
          <div class="coin ${winner == 'heads' ? 'coin-2' : 'coin-1'}">
            <div class="front"></div>
            <div class="back"></div>
            <div class="side">
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
              <div class="spoke"></div>
            </div>
          </div>
        </div>`)
             setTimeout(() => {
          // add style to mark loser
          if(winner == 'heads'){
            $("<style>")
              .prop("type", "text/css")
              .html(`\
              .game-${id} .side-b::before {\
                content: '';\
                background: rgba(0, 0, 0, 0.5);\
                position: absolute;\
                width: 75px;\
                height: 75px;\
                border-radius: 50%;\
           
              }`)
              
              
              .appendTo("head");
              
              
          }
          else {
            $("<style>")
              .prop("type", "text/css")
              .html(`\
              .game-${id} .side-a::before {\
                content: '';\
                background: rgba(0, 0, 0, 0.5);\
                position: absolute;\
                width: 75px;\
                height: 75px;\
                border-radius: 50%;\
      
              }`)
              .appendTo("head");
          }
  
          // update user's balance
          let myUserId = "{{ auth()->user() ? auth()->user()->id : "undefined" }}"
          if(user_2.id == myUserId) {
            $('#app .coin-balance').html(user_2.coins)
          }
          if(user.id == myUserId) {
            $('#app .coin-balance').html(user.coins)
          }
        }, 3000);
        
      setTimeout(function() {
        $(`.game-${id}`).fadeOut()
        
        
      }, 7000)
      if($('.live-games-container .game-card').length == 0)
        $('.live-games-container').html(`<p>No games found.</p>`)
    }
    else if(nCount < 4)
      vsText.html(`<h1>${nCount}</h1>`)
  }, 1000);
  
})

Echo.channel('CoinFlipGameCreated').listen('.CoinFlipGameCreatedEvent', e => {
  const {id, bet_amount, chosen_side, user} = e.message.coinflipGame
  const url = "{{ url('/coinflip/join_game/') }}/" + id
  const newGameElement = `
        <div class="game-card game-${id}">
          <div class="player-card">
            <div class="profile-picture ${chosen_side == 'heads' ? 'side-a' : 'side-b'}"></div>
            <div class="player-info">
              <div class="username">${user.name}</div>
              <div class="coin-box">
                <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
                <p class="coin-balance">${bet_amount}</p>
              </div>
            </div>
          </div>
        
          <div class="vs-container">
            <p class="vs-text">VS</p>
          </div>
        
          <div class="player-card-2">
            <!-- Add a second player-card structure here, you can replace the data with appropriate values -->
            <div class="join-container">
              <form id="join-form-${id}" action="${url}" method="POST">
                <input type="hidden" name="_token" value={{ csrf_token() }} />
                <button type="submit" class="btn1">Join Game</button>
              </form>
            </div>
            <div class="coin-box">
              <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
              <p class="coin-balance">${ bet_amount }</p>
            </div>
          </div>
        </div>`
    if($('.live-games-container .game-card').length == 0)
      $('.live-games-container').html(``)
    $('.live-games-container').append(newGameElement)
    
})

$(document).on('submit', 'form', function(event) {
  event.preventDefault();
  $.ajax({
    url: $(this).attr('action'),
    type: $(this).attr('method'),
    data: $(this).serialize(), 
    success: function(response) {
      const {coinflipGame} = response
      if(coinflipGame) {
        const {id, bet_amount, chosen_side, user} = coinflipGame
        const cancelUrl = "{{ url('/coinflip/cancel_game/') }}/" + id
        const newGameElement = `
        <div class="game-card game-${id}">
          <div class="player-card">
            <div class="profile-picture ${chosen_side == 'heads' ? 'side-a' : 'side-b'}"></div>
            <div class="player-info">
              <div class="username">{{ auth()->user() ? auth()->user()->name : "?" }}</div>
              <div class="coin-box">
                <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
                <p class="coin-balance">${bet_amount}</p>
              </div>
            </div>
          </div>
        
          <div class="vs-container">
            <p class="vs-text">VS</p>
          </div>
        
          <div class="player-card-2">
            <button type="button" class="cancel-button" data-url="${cancelUrl}">Cancel Game</button>
            <div class="coin-box">
              <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
              <p class="coin-balance">${bet_amount}</p>
            </div>
          </div>
        </div>`
        if($('.my-games-container .game-card').length == 0)
          $('.my-games-container').html(``)
        $('.my-games-container').append(newGameElement)
        $('#app .coin-balance').html(user.coins)
      }
    },
    error: function(xhr, status, error) {
      // Handle errors
      console.log(status + ": " + error); // Log the error
    }
  })
});
Echo.channel('CoinFlipGameCanceled')
    .listen('.CoinFlipGameCanceledEvent', e => {
        const { id } = e.message;

        // Remove the game card from the DOM
        $(`.game-card.game-${id}`).remove();
    });


</script>

</html>
@endsection