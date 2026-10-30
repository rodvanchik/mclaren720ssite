$(document).ready(function() {
    $('#contact-but').on('click', function(event) {
        event.preventDefault();
        
        const formData = {
            name: $('input[name="name"]').val(),
            contactMethod: $('select[name="how-to-contact"]').val(),
            contactOption: $('input[name="contact-option"]').val(),
            contactType: $('select[name="type-of-contact"]').val(),
            otherDetails: $('input[name="otherDetails"]').val()
        };

        $.ajax({
            type: 'POST',
            url: '../../backend/contact.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    $('#form-message').text(response.error).css('background-color', 'red');
                } else {
                    $('#form-message').text(response.message).css('background-color', 'green');
                    $('#contact-form')[0].reset();
                    console.log("Нове звернення відправлено:", formData);
                }
            },
            error: function() {
                $('#form-message').text('Сталася помилка зв\'язку з сервером.').css('color', 'red');
            }
        });
    });
});