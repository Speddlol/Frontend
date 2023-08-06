@extends('layouts.test')

@section('title', 'matchbetting')

@section('content')
<style>

body {
    font-family: Oswald;
}    
.selected {
    background-color: #28a745; 
}

.odds {
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.odds:hover {
    background-color: #f5f5f5;
}
.card-content {
    display: flex;
    align-items: center;
}

.input-group {
    margin-top: 10px;
}

.input-group {
    margin-top: 10px;
}

.input-group {
    margin-top: 10px;
}

.odds-container {
  display: flex;
  justify-content: space-around;
}

.odds-container .odds-item {

}

.odds-container .odds-item label {
  margin-top: 25px;
  cursor: pointer;
  display: inline-block;
  text-align: center;
  vertical-align: top;
  padding: 10px 15px;
  border: 2px solid grey;
  border-radius: 5px;
  transition: background-color 0.3s ease, border-color 0.3s ease;
}
.odds-container .odds-item input[type="radio"] {
  display: none; 
}

.odds-container .odds-item input[type="radio"]:checked + label {
  background-color: #28a745;
  border-color: #28a745;
  color: white;
}
.odds-container .odds-item label:hover {
  background-color: #f5f5f5;
}
.odds-container .odds-item .odd-label-text {
  margin-bottom: 5px; 
  font-size: 14px; 
  position: absolute; /* Add relative positioning to the odds-item */
  bottom: 110px; 
  margin-left: 25px;

}

.card {
    background: #212121;
            box-shadow: 10px 10px 10px rgb(25, 25, 25),
                -10px -10px 10px rgb(60, 60, 60); 
    border: 2px solid orange; 
    color: white;
}

.card-content {
    display: flex;
    align-items: center;
    padding: 15px; 
}

.card-img-top {
    width: 100px; 
    height: auto;
    margin-right: 10px; 
}

.card-description {
    flex: 1;
}

h5{
    font-family: Oswald;
    font-size: 24px;
}
h2{
    font-family: Oswald;
    font-size: 20px;
    color: white;
    margin-bottom: 10px;
    justify-content: center;
}

</style>
<div class="container">
    <h2>Want YOUR coin listed here with odds? Contact us on Telegram!</h2>
    <div class="row justify-content-center">
        @foreach($betslips as $betslip)
            <div class="col-lg-6 col-md-8 mb-4">
                <div class="card h-100">
                    <form action="{{ route('placeBet', ['betslip' => $betslip->id]) }}" method="POST">
                        @csrf  <!-- CSRF token for Laravel -->
                        <div class="card-content">
                            <img src="{{ asset($betslip->picture) }}" class="card-img-top" alt="{{ $betslip->name }}">
                            <div class="card-description">
                                <h5>{{ $betslip->description }}</h5>
                            </div>
                        </div>
                        <div class="odds-container">
                            <div class="odds-item">
                            <input type="radio" id="odd_one_{{ $betslip->id }}" name="selected_odd" value="odd_one">
                            <label for="odd_one_{{ $betslip->id }}">{{ $betslip->odd_one }}x</label>
                            <p class="odd-label-text">YES</p>
                            
                            
                            
                            </div>
                            <div class="odds-item">
                            <input type="radio" id="odd_two_{{ $betslip->id }}" name="selected_odd" value="odd_two">
                                <label for="odd_two_{{ $betslip->id }}">{{ $betslip->odd_two }}x</label>
                                <p class="odd-label-text">NO</p>
                               
                              
                               
                            </div>
                            @if ($betslip->odd_three !== null)
                            <div class="odds-item">
                            <input type="radio" id="odd_three_{{ $betslip->id }}" name="selected_odd" value="odd_three">
                            <label for="odd_three_{{ $betslip->id }}">{{ $betslip->odd_three }}x</label>    
                            <p class="odd-label-text">EQUAL</p>
                     
                                
                               
                            </div>
                            @endif
                        </div>
                        <div class="input-group mt-3 d-flex justify-content-center">
                            <input type="number" name="bet_amount" class="pl-8 text-white bg-no-repeat h-11 w-24 bg-transparent font-bold" id="bet_amount" required style="background-image: url(/icons/coins3.png); border: 1px solid white; background-size: 24px; background-position: 5px 5px; border-color: rgb(51 53 65 / var(--tw-border-opacity));" placeholder="0.00" value="0.00" min="1" max="1000">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Bet</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>


<script>
function selectOdd(element) {
    const odds = document.querySelectorAll('.odds');
    odds.forEach(odd => odd.classList.remove('selected'));
    element.classList.add('selected');
}
</script>

@endsection

