$(function() {

$('#envoyer-message').click(function() {
	var message = $('#message').val();
	var username = $('#loggedInUser').val();
	if (message != '') {
		$.ajax({
			data: { username: username, message: message },
			type: "POST",
			url: "message.php",
			success: function() {
				$('#message').val('');
			}
		});
	}
});
var scrollHeight = $('#list_messages').scrollHeight;
setInterval(function() {
	$('#list_messages').load('display.php');
	$('#list_messages').scrollTop( scrollHeight );
    $('#list-users-connected').load('users_connected.php');
}, 1000);

});