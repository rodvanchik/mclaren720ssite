$(document).ready(function() {
                
    $(document).on('submit', '#login-form', function(event) {
        event.preventDefault();

        const userData = {
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            type: 'POST',
            url: '../backend/login.php',
            data: userData,
            success: function(response) {
                if(response.error) {
                    $('#form-message').text(response.error).css('background-color', 'red');
                } else {
                    $('#form-message').text(response.message).css('background-color', 'green');
                    $('#login-form')[0].reset();
                    if(response.is_admin) {
                        console.log("Адміністратор увійшов у систему:", userData['email']);
                    } else {
                        console.log("Новий користувач зайшов", userData['email']);
                    }
                }
            },
            error: function() {
                $('#form-message').text('Сталася помилка зв\'язку з сервером.').css('color', 'red');
            }
        });
    });

    $(document).on('submit', '#register-form', function(event) {
        event.preventDefault();

        const userData = {
            email: $('#email').val(),
            phone: $('#phone-number').val(),
            password: $('#password').val()
        };

        $.ajax({
            type: 'POST',
            url: '../backend/register.php',
            data: userData,
            success: function(response) {
                if(response.error) {
                    $('#form-message').text(response.error).css('background-color', 'red');
                } else {
                    $('#form-message').text(response.message).css('background-color', 'green');
                    $('#register-form')[0].reset();
                }
            },
            error: function() {
                $('#form-message').text('Сталася помилка зв\'язку з сервером.').css('color', 'red');
            }
        });
    });

});