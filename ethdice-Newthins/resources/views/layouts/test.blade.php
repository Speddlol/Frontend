<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png"  href="/favicon.ico.png">

<link rel="manifest" href="/site.webmanifest">

<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ethdice') }}</title>

    <!-- Fonts -->

    <!-- Scripts -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap');
</style>

    <style>
       
body {  

        min-height:calc(100vh);
        background:#3b3b47;
        background:-moz-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);
        background:-webkit-gradient(left top,left bottom,color-stop(0,#202027),color-stop(19%,#202027),color-stop(50%,#3e3e4a),color-stop(80%,#202027),color-stop(100%,#202027));
        background:-webkit-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);background:-o-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);background:-ms-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%)}@media (max-width:767px){body{-webkit-user-select:none;
        -webkit-tap-highlight-color:transparent;-webkit-touch-callout:none}}img{max-width:100%
        }
        

.btn {
  background-color: orange;
  color: black;
  transition: opacity 0.3s ease-in-out;
  margin-right: 5px;
 width: 80px; 
 

}
.btn:hover {
  color: black;
  opacity: 0.7;
}
.logo {
  width: 250px;
}


.logo {
  width: 250px;
}

.navbar-brand {
  margin-left: 10px;
}

.navbar-nav li a img {
  height: 25px;
  margin-right: 8px;
}

.navbar {
    font-family: 'Oswald', sans-serif;
  color: #ffffff;
  border-bottom: 1px solid orange;

  
}


.coin-box {
  display: inline-flex;
  background-color: black;
  border-radius: 2px;
  padding: 3px 6px;
  border: 2px solid orange;
  border-radius: 5px;
  padding: 5px;
  align-items: center;
  justify-content: center;
}

.coin-box img {
  vertical-align: middle;
  margin-right: 8px;
  width: 25px;
  height: 25px;
  
}

.coin-balance {
  display: inline-block;
  margin: 1px;
  font-size: 14px;
  font-weight: bold;
}
footer {
  background-color: #16181F;
}

h3 {
  font-size: 24px;
  margin-bottom: 10px;
}

  
 
  h1 {
    font-size: 1.2rem;
    margin: 0;
  }
  .content-section {
    text-align: left;
    display: flex;
    flex-direction: column;
    
  }
  .link-container {
    display: flex;
    justify-content: center;
  }
.a {
    font-size: 12px;
    font-family: 'Oswald', sans-serif;
    color: #fff;
    text-decoration: none;
    margin-left: 25px;
    text-align: left;
  }
  .content {
  text-align: left;
  font-family: 'Oswald', sans-serif;
}
p {
  font-size: 12px;
  font-family: 'Oswald', sans-serif;
  margin-right: 310px;
}
#mains {
  overflow: auto;
  margin-top: 50px;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
#content{
  min-height: 100%;
  
}

#logo2 {
  position: relative;
  left: 60px;
  width: 8%;
  height: 8%; 
  
}

#logo4 {
  position: relative;
  width: 40%;
  height: 40%;
  left: 90px;

}
#logobottom {
  position: relative;

  width: 35%;
  height: 35%; 
  top: 5px;
  left: 20px;

}

  @media (max-width: 768px) {
#logo2 {
  position: relative;
  left: 40px;
  width: 12%;
  height: 12%; 
  top: -6px;
}
#logo4 {
  position: relative;
  width: 55%;
  height: 55%;
  left: 50px;

}
    .btn {
  background-color: orange;
  color: black;
  transition: opacity 0.3s ease-in-out;
  margin-right: 5px;
 border: 1px solid black; 
 width: 30%;



}
.text-wrap {
    white-space: normal;
}
 

}
.dice-container {
  display: flex;
}
.backgroundclass {
min-height:calc(100vh);
        background:#3b3b47;
        background:-moz-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);
        background:-webkit-gradient(left top,left bottom,color-stop(0,#202027),color-stop(19%,#202027),color-stop(50%,#3e3e4a),color-stop(80%,#202027),color-stop(100%,#202027));
        background:-webkit-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);background:-o-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%);background:-ms-linear-gradient(top,#202027 0,#202027 19%,#3e3e4a 50%,#202027 80%,#202027 100%)}@media (max-width:767px){body{-webkit-user-select:none;
        -webkit-tap-highlight-color:transparent;-webkit-touch-callout:none}}img{max-width:100%
        }

        .community img{
          width: 50px
        }

@media only screen and (max-width: 767px) {


    
}





</style>
   
<script async src="https://www.googletagmanager.com/gtag/js?id=G-868DP62C77"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-868DP62C77');
</script>
     
</head>
<body>
  @stack('modals')

  @livewireScripts

  <div id="app">
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
            <div class="dice-container">

            <img src="{{ asset('icons/LERRET.png') }}"   alt="Cahoot Logo" id="logo2">
            
            <img src="{{ asset('icons/ethdice1.png') }}"   alt="Ethdice2 Logo" id="logo4">
                  

            
          </div>
        
          
          
          
          
          
            </a>
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                      
                    </li>
                </ul>              
           

                <ul class="navbar-nav ml-auto">
                
                    <li class="nav-item">
                        <a href="{{ url('/matchbetting') }}" class="btn">Bets</a>
                    </li>
                     </li>
                      <li class="nav-item">
                        <a href="{{ url('/') }}" class="btn">Dice</a>
                    </li>
                      <li class="nav-item">
                        <a href="{{ url('/coinflip') }}" class="btn">Coinflip</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('withdraw') }}" class="btn">Withdraw</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('deposit') }}" class="btn">Deposit</a>
                   
                    
                    
                    <li class="nav-item">
                        @auth
                        <div class="coin-box">
  <img src="{{ asset('img/coins.png') }}" alt="Coin Icon" height="20px" width="20px">
  <p class="coin-balance">{{ auth()->user()->coins }}</p>
</div>
<div class="dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="user-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ Auth::user()->name }}
  </a>
  <div class="dropdown-menu" aria-labelledby="user-dropdown">
    <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a> 
    <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
    </form>
  </div>
</div>




@endauth
                    @guest
                    <a class="nav-link bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer w-15" href="{{ route('login') }}">Login</a>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>        
<div id="content">
     <div id="mains">
      @yield('content')
      <br><br><br><br><br><br>
</div>
</div>
        
<footer class="flex text-white flex-col md:flex-row md:px-4 lg:px-48 xl:px-64 items-center md:items-start">
  <div class="flex flex-1 flex-column mt-4">
    <div class="dice-container">
      <img src="{{ asset('icons/ethdice1.png') }}" alt="Cahoot Logo" style="max-width: 220px">
    </div>
    <p class="m-0 ml-1 mt-4">Copyright© 2022 - 2023 ethdice.net - All rights reserved.
      <br>Contact: support@ethdice.net
    </p>
  </div>
  <div class="flex flex-1 mt-8">
    <div class="md:flex-1"></div>
    <div class="flex flex-1 flex-column font-bold">
      <h3 class="text-2xl">About</h3>
      <ul>
        <li><a href="/ETHDICE_About.pdf" class="text-xs hover:text-white">About</a></li>
        <li><a href="/ETHDICE_Roadmap_v1.pdf" class="text-xs hover:text-white">Roadmap</a></li>
        <li><a href="/ETHDICE_Whitepaper_v1.pdf" class="text-xs hover:text-white">Whitepaper</a></li>
        <li><a href="/ETHDICE_Terms_of_Service_v1.pdf" class="text-xs hover:text-white">Terms of Service</a></li>
      </ul>
    </div>
  </div>
  <div class="flex flex-1 mt-8">
    <div class="md:flex-1"></div>
    <div class="flex flex-1 flex-column">
      <h3 class="text-2xl font-bold">Community</h3>
      <div class="flex community gap-6">
        <a href="https://twitter.com/ETHDICEOfficial"><img src="{{ asset('icons/twitter.png') }}" alt="Twitterlogo"></a>
        <a href="https://t.me/ETHDICEOfficial"><img src="{{ asset('icons/telegram.png') }}" alt="Telegramlogo"></a>
        <br><br><br><br><br><br>
      </div>
    </div>
  </div>
</footer>
    </div>

   
    </div>
</div>
</body>
</html>