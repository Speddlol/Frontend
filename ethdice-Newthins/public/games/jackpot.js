$(document).ready(function(){
	var users = JSON.parse($('#users').val());
	shuffled = [],
	loadout = $("#loadout"),
	insert_times = 30,
	duration_time = 10000;
	$("#roll").click(function(){
		users = [];
		var lines = $('textarea').val().split('\n');
		if(lines.length < 2){
			$("#msgbox").slideToggle(100);
			setTimeout(function() {
				  $("#msgbox").slideToggle(100);
			}, 3000);
			return false;
		}
		for(var i = 0;i < lines.length;i++){
			if(lines[i].length > 0){
				users.push(lines[i]);
			}
		}
		$("#roll").attr("disabled",true);
		var scrollsize = 0,
		diff = 0;
		$(loadout).html("");
		$("#log").html("");
		loadout.css("left","100%");
		if(users.length < 10){
			insert_times = 20;
			duration_time = 5000;
		}else{
			insert_times = 10;
			duration_time = 10000;
		}
		for(var times = 0; times < insert_times;times++){
			shuffled = users;
			shuffled.shuffle();
			for(var i = 0;i < users.length;i++){
				loadout.append('<td><div class="roller"><div>'+shuffled[i]+'</div></div></td>');
				scrollsize = scrollsize + 192;
			}
		}
		
		
		diff = Math.round(scrollsize /2);
		diff = randomEx(diff - 300,diff + 300);
		$( "#loadout" ).animate({
			left: "-="+diff
		},  duration_time, function() {
			$("#roll").attr("disabled",false);
			$('#loadout').children('td').each(function () {
				var center = window.innerWidth / 2;
				if($(this).offset().left < center && $(this).offset().left + 185 > center){
					var text = $(this).children().text();
					$("#log").append("THE WINNER IS<br/> <span class=\"badge\">"+text+"</span>");
					
				}
				
			});
		});
	});
	Array.prototype.shuffle = function(){
		var counter = this.length, temp, index;
		while (counter > 0) {
			index = (Math.random() * counter--) | 0;
			temp = this[counter];
			this[counter] = this[index];
			this[index] = temp;
		}
	}
	function randomEx(min,max)
	{
		return Math.floor(Math.random()*(max-min+1)+min);
	}

	// join game button
	if (auth) {
        $("#join-game-btn").click(function(){
            $.ajax({
                url: '/join-game',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'game_id': '{{ $game->id }}'
                },
                success: function(data){
                    if (data.success && data.users.length >= 2) {
                        // Start the game using the user data
                        startGame(data.users);
                    } else {
                        // Reload the page after joining the game
                        location.reload();
                    }
                },
                error: function(xhr, status, error){
                    alert(xhr.responseText);
                }
            });
        });
    }

    function startGame(users) {
        // TODO: Add your game logic to start the game using the user data
        // For example, you could display the user names in the UI or shuffle the users

        console.log('Starting game with users:', users);
    }
});