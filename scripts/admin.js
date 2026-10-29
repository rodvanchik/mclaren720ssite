
$(document).off('submit', '#add-car-form').on('submit', '#add-car-form', function(event) {
    event.preventDefault();
    const carData = {
        car_id: $('#add-id').val(),
        car_name: $('#add-name').val(),
        car_image: $('#add-image').val(),
        car_specs: $('#add-specs').val()
    };

    $.ajax({
        url: '/mclaren720s/backend/admin.php',
        type: 'POST',
        data: carData,
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                $('#add-car-message').text(response.error).css('color', 'red');
            } else {
                $('#add-car-message').text(response.message).css('color', 'green');
                $('#add-car-form')[0].reset();

                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        },
        error: function(xhr) {
            console.error("Помилка від сервера:", xhr.responseText);
            $('#add-car-message').text("Сталася помилка зв'язку з сервером").css('color', 'red');
        }
    });
});