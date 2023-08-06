$(document).ready(function () {
	var loadout = $("#loadout");
	var visibleSlots = Math.floor(window.innerWidth / 192);


	function roll(winner) {
		var users = winner.players;
		var animationUsers = [];
		console.log("Received winner:", winner);
	  
		users.forEach(function (player) {
		  player.color = getRandomColor();
		});
	  
		var totalBetAmount = users.reduce(function (sum, player) {
		  return sum + player.bet_amount;
		}, 0);
	  
		var totalLoadouts = 100; // Set total loadouts to 100
	  
		users.forEach(function (player) {
			player.color = getRandomColor();
			player.relativeWeight = player.bet_amount / totalBetAmount;
			player.loadouts = Math.max(1, Math.round(player.relativeWeight * totalLoadouts));
			for (var i = 0; i < player.loadouts; i++) {
			  var loadoutNumber = animationUsers.length;
			  if (player.name === winner.name && (loadoutNumber + 1) === winner.loadoutNumber) {
				animationUsers.push({
				  name: player.name,
				  color: player.color,
				  loadoutNumber: winner.loadoutNumber - 1
				});
			  } else {
				animationUsers.push({
				  name: player.name,
				  color: player.color,
				  loadoutNumber: loadoutNumber
				});
			  }
			}
		  });
		console.log("Animation users:", animationUsers);
	
		// Set the winning loadout number for the winner
		var winningLoadoutNumber = -1;
for (var i = 0; i < animationUsers.length; i++) {
  if (animationUsers[i].name === winner.name) {
    winningLoadoutNumber = animationUsers[i].loadoutNumber;
    break;
  }
}
if (winningLoadoutNumber === -1) {
  console.error("Winner's loadout not found in animationUsers array");
  return;
}
	  
		loadout.html("");
		$("#log").html("");
		loadout.css("left", "100%");
	  
		var duration_time = 10000;
		var loadoutRepeats = 1;
	  
		for (var repeat = 0; repeat < loadoutRepeats; repeat++) {
			for (var j = 0; j < animationUsers.length; j++) {
			  var loadoutNumber = animationUsers[j].loadoutNumber + 1;
			  var name = animationUsers[j].name;
			  if (loadoutNumber === winningLoadoutNumber + 1 && name === winner.name) {
				name += " (WINNER)";
			  }
			  loadout.append('<td><div class="roller" style="background-color:' + animationUsers[j].color + '"><div>' + name + ' (' + loadoutNumber + ')' + "</div></div></td>");
			}
		  }
		  
		  var diff = 1 * (winningLoadoutNumber * 192) + Math.floor(window.innerWidth / 2) - (2100 / 2);
		  
		  $("#loadout").animate(
			  {
				left: "-=" + diff,
			  },
			  duration_time,
			  function () {
				$("#log").html("THE WINNER IS<br/><span class=\"badge\">" + winner.name + "</span> Winning loadout number: " + (winningLoadoutNumber + 1));
				console.log("Winning user name:", winner.name, "Winning loadout number:", (winningLoadoutNumber + 1));
			  }
			);
		  }
	  
	  
	  
	  function getRandomColor() {
		var letters = '0123456789ABCDEF';
		var color = '#';
		for (var i = 0; i < 6; i++) {
		  color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
	  }
	  
  
	  Array.prototype.shuffle = function () {
		for (var i = this.length - 1; i > 0; i--) {
		  var j = Math.floor(Math.random() * (i + 1));
		  var temp = this[i];
		  this[i] = this[j];
		  this[j] = temp;
		}
	  };
    // Add this line to set up the AJAX headers with the CSRF token
	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
  
	// Event handler for Play Jackpot form submission
	$('#playJackpotForm').on('submit', function (event) {
	  event.preventDefault();
  
	  // Use AJAX to call the jackpot.jackpotGame route
	  $.ajax({
		url: "/jackpot/jackpot-game",
		method: "POST",
		dataType: "json",
		success: function (data) {
		  console.log(data);
		  roll(data.winner); // call the roll function with the winner data
		},
		error: function (xhr, status, error) {
		  console.log(xhr.responseText);
		},
	  });
	});
  });
