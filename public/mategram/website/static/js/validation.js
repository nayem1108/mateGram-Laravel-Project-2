$('#username').keyup( () => {
    var username = $('#username').val();
    var regex = /^[a-zA-Z0-9]$/

    if(regex.test(username)){
        $('#usernameError').text('');
    }
    else{
        $('#usernameError').text('Accepts Number && Character only');
    }
})
