var aboutYou = null;
var mode = null;
function aboutYouGet() {
	$.ajax(
		{
			url: "./skrypty/php/shoutbox.php?aboutYou",
			type: "GET"
		}
	).done(function (result) {
		window.aboutYou = result;

		if (window.aboutYou.devmode.valueINT == 1) {
			if ( window.mode != "devmode") {
				changeMode("devmode", window.aboutYou.devmode.valueTEXT);
			}
		}
		else if (window.aboutYou.blocksb == 1) {
			if ( window.mode != "banned") {
				changeMode("banned", window.aboutYou.blocksbReason);
			}
		}
		else {
			if ( window.mode != "normal") {
				changeMode("normal");
			}
		}
	});
}

function putMessage( uid, mid, code, date, user, message, blocked, userBlocked, color, accepted, order, servedCount, isFirst) {
	var messageHTML = [];

	messageHTML.push('<div id="sb-message-' + mid + '" class="mdl-cell mdl-cell--');

	if (aboutYou.pshoutboxhide == 1 || aboutYou.pshoutboxblockuser == 1) {
		messageHTML.push('10');
	} else {
		messageHTML.push('12');
	}

	messageHTML.push('-col sb-message-' + uid + ' sb-message" data-message-id="'+ mid +'" ');
	if (userBlocked == 1) { messageHTML.push('data-user-blocked="1" '); }
	messageHTML.push('style="padding: 5px; ');

	if (servedCount != order && isFirst == false) {
		messageHTML.push('border-bottom: 0.2px solid lightgrey;');
	}

	messageHTML.push('">');

	if (blocked == 1) { messageHTML.push('<i>'); }
	if (userBlocked == 1) { messageHTML.push('<i class="material-icons">block</i> '); }

	//messageHTML.push('<!--<div class="mdl-tooltip" for="clock' + Math.pow(mid, 2) + '">' + date + '</div><div style="outline: 0; cursor: default; transform: scale(0.6, 0.6) translateY(6px); margin: -2px;" id="clock' + Math.pow(mid, 2) + '" class="icon material-icons">access_time</div>-->');
	messageHTML.push('<b style="color: ' + color + '; ">');

	if (accepted == 1) {
		if (code != null) {
			messageHTML.push('[' + code + '] ');
		}
		messageHTML.push(user + ':');
	}
	else {
		messageHTML.push('<s>' + user + '</s>:');
	}

	messageHTML.push('</b> ' + message);

	if (blocked == 1) { messageHTML.push('</i>'); }

	messageHTML.push('</div>');

	if (aboutYou.pshoutboxhide == 1 || aboutYou.pshoutboxblockuser == 1) {
		messageHTML.push('<div id="sb-options-' + mid + '" class="mdl-cell mdl-cell--2-col sb-options-' + uid + ' sb-options" style="padding: 5px; ');

		if (servedCount != order && isFirst == false) {
			messageHTML.push('border-bottom: 0.2px solid lightgrey;');
		}

		messageHTML.push('">');

		if (aboutYou.pshoutboxblockuser == 1 && uid != 1 && uid != 2 && uid != parseInt( aboutYou.id ) && aboutYou.blocksb != 1 && userBlocked != 1) {
			messageHTML.push('<div class="mdl-tooltip mdl-tooltip--large" for="block' + Math.pow(mid, 2) + '">Zabierz uĹźytkownikowi uprawnienia do pisania</div><button style="float: right;" id="block' + Math.pow(mid, 2) + '" data-uid="'+ uid +'" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored sb-block-btn sb-block-btn-uid-'+ uid +'"><i class="material-icons">block</i></button>');
		}

		if (aboutYou.pshoutboxhide == 1 && aboutYou.blocksb != 1 && blocked != 1) {
			messageHTML.push('<div class="mdl-tooltip mdl-tooltip--large" for="hide' + Math.pow(mid, 2) + '">Ukryj tÄ wiadomoĹÄ</div><button style="float: right;" data-mid="'+ mid +'" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored sb-hide-btn sb-hide-btn-mid-'+ mid +'"><i class="material-icons">visibility_off</i></button>');
		}

		messageHTML.push('<div style="clear: both;"></div></div>');
	}

	var returnValue = messageHTML.join('');
	$('#shoutbox-messages').prepend( returnValue );

	$(".sb-hide-btn-mid-"+ mid).on("click", function(event) {
		if (window.eventExists == false) {
			window.eventExists = true;

			event.preventDefault();
			var mid = $(this).data('mid');

			$.ajax({
				type: 'POST',
				url: site_address + "/shoutboxCallouts.php",
				data: {
					'action': 'hideMessage',
					'mid': mid
				}
			})
			.done(function(response) {
				window.isPaused = true;

				if (response.success == true) {
					snackbar(response.message, 2000);
				}
				else {
					snackbar("WystÄpiĹ nieznany bĹÄd");
				}

				window.isPaused = false;
			})
			.error(function() {
				snackbar("WystÄpiĹ nieznany bĹÄd");
			});
			window.eventExists = false;
		}
	});

	$(".sb-block-btn-uid-" + uid).on("click", function(event) {
		if (window.eventExists == false) {
			window.eventExists = true;

			event.preventDefault();
			var uid = $(this).data('uid');
			var reason = prompt("Podaj powĂłd zablokowania uĹźytkownika na shoutboxie:");

			$.ajax({
				type: 'POST',
				url: site_address + "/shoutboxCallouts.php",
				data: {
					'action': 'blockUser',
						'uid': uid,
					'reason': reason
				}
			})
			.done(function(response) {
				window.isPaused = true;

				if (response.success == true) {
					snackbar(response.message, 2000);
				}
				else {
					snackbar("WystÄpiĹ nieznany bĹÄd");
				}

				window.isPaused = false;
			})
			.error(function() {
				snackbar("WystÄpiĹ nieznany bĹÄd");
			});
			window.eventExists = false;
		}
	});
}

function refreshMessages( first = false ) {
	if (first === true) {
		var scriptURL = "./skrypty/php/shoutbox.php";
		var dataToPass = {};
	} else {
		var elementsCounted = $(".sb-message").length;
		var elementsArray = [];

		for( i = 0; i < elementsCounted; i++) {
			elementsArray.push($(".sb-message").eq(i).attr("data-message-id"));
		}

		elementsArray = elementsArray.join(",");

		var scriptURL = "./skrypty/php/shoutbox.php?update";
		var dataToPass = {
			"messagesToUpdate": elementsArray,
		};
	}

	aboutYouGet();
	$.ajax(
		{
			url: scriptURL,
			type: "GET",
			data: dataToPass,
		}
	).done(function(result) {
		for( let i = 0; i < result.messages; i++) {
			var actualData = result.messages[i];
			var isFirst = false;

			if ( first == true && i == 0) isFirst = true;
				if ( actualData.action == "add") {
					putMessage(actualData.uid, actualData.mid, actualData.code, actualData.date, actualData.user, actualData.message, actualData.blocked, actualData.userBlocked, actualData.color, actualData.accepted, i, result.messages, isFirst);
				} else if ( actualData.action == "update") {
					if (typeof actualData.blocked !== 'undefined') {
						if (actualData.blocked == '1') {
							if (typeof hideMessageAdmin === "function") {
								hideMessageAdmin(actualData.mid);
							}
							else {
								hideMessage(actualData.mid);
							}
						}
					}
					else if (typeof actualData.userBlocked !== 'undefined') {
						blockuser( actualData.uid, actualData.userBlocked );
					}
				}
			if (first == true) $("#shoutbox-form").show();
		}
	});
}

function hideMessage( id ) {
	$("#sb-message-" + id).remove();
	$("#sb-options-" + id).remove();
}

function blockuser( id, value ) {
	if (value == 1) {
		if ($(".sb-message-" + id).data("user-blocked") != 1) {
			$(".sb-message-" + id).prepend("<i class='material-icons'>block</i> ");
			$(".sb-message-" + id).attr("data-user-blocked", "1");
		}
	}
	else {
		$(".sb-message-" + id +" > .material-icons").remove();
		$(".sb-message-" + id).removeAttr("data-user-blocked");
	}
}

function changeMode( mode = "normal", reason = null ) {
	if ( mode == "devmode" ) {
		if ( reason != null && reason != '') {
			reason = ' PowĂłd: ' + reason;
		}
		else {
			reason = '';
		}
		$("#mode").html('<span style="font-size: 17px; color: #D50000;"><b>Shoutbox wyĹÄczony.' + reason + '</b></span>');
		window.mode = "devmode";
	} else if ( mode == "banned" ) {
		if ( reason != null && reason != '' ) {
			reason = 'PowĂłd: ' + reason;
		}
		else {
			reason = '';
		}
		$("#mode").html('<span style="font-size: 17px; color: #D50000;"><b>MoĹźliwoĹÄ pisania na shoutboxie zostaĹa odebrana. ' + reason + '</b></span>');
		window.mode = "banned";

	} else if ( mode == "normal" ) {
		$("#mode").html('<form method="post" id="shoutbox-form"><div style="width: 100%;" class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" name="sbmessage" autocomplete="off" maxlength="1024" type="text" id="sbTextBox"><label class="mdl-textfield__label" for="sbTextBox">Wpisz wiadomoĹÄ...</label></div><input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" /></form>');

		$("#shoutbox-form").submit(function(event) {
			event.preventDefault();
			$.ajax({
				type: 'POST',
				url: "./skrypty/php/shoutbox.php",
				data: $(this).serialize()
			})
			.done(function(response) {
				window.isPaused = true;

				refreshMessages();
				$("#sbTextBox").val('');
				if (response.error != 0) {
					snackbar(response.message, 5000);
				}
				window.isPaused = false;
			})
			.error(function() {
				snackbar("WystÄpiĹ nieznany bĹÄd");
			});

			return false;
		});

		window.mode = "normal";
	}
}

var firstTime = true;
var i = 0;
var isPaused = false;
var block = null;
var eventExists = false;

$(document).ready(function() {
	aboutYouGet();

	timer = window.setInterval(function(){
		if (!window.isPaused) {
			window.i++;

			if (window.i == 2) { window.firstTime = false; }
			if (window.i < 2) { $('#shoutbox-messages').html("") };
			refreshMessages( window.firstTime );
		}
	}, 1000);

	$("#shoutbox-form").submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: "./skrypty/php/shoutbox.php",
			data: $(this).serialize()
		})
		.done(function(response) {
			window.isPaused = true;

			refreshMessages();
			$("#sbTextBox").val('');
			componentHandler.upgradeDom();
			if (response.error != 0) {
				snackbar(response.message, 5000);
			}
			window.isPaused = false;
		})
		.error(function() {
			snackbar("WystÄpiĹ nieznany bĹÄd");
		});

		return false;
	});
});