$(document).ready(function() {
    let carsDatabase = [];

    function renderCatalog(carsArray) {
        const $container = $('#catalog-container');
        $container.empty(); 

        carsArray.forEach(function(car) {
            const cardHtml = `
                <div class="car-card" data-id="${car.car_id}">
                    <img src="${car.car_image}" alt="${car.car_name}">
                    <h3>${car.car_name}</h3>
                    <button class="btn-specs">Характеристики</button>
                    <button class="admin-only delete-btn" style = "display:none;background-color: red;">Видалити</button>
                </div>
            `;
            $container.append(cardHtml);
        });
    }

    if ($('#catalog-container').length) {
        $.ajax({
            url: '../backend/catalog.php',
            type: 'GET',
            dataType: 'json',
            success: function(dataFromServer) {
                carsDatabase = dataFromServer;
                renderCatalog(carsDatabase);  
            },
            error: function(xhr) {
                console.error("Помилка завантаження каталогу. Текст помилки:", xhr.responseText);
            }
        });
    }

    $('#catalog-container').off('click', '.car-card').on('click', '.car-card', function() {
        
        const carId = $(this).attr('data-id');

        const carInfo = carsDatabase.find(c => c.car_id == carId);

        if(carInfo) {
            $('#modal-title').text(carInfo.car_name);
            $('#modal-img').attr('src', carInfo.car_image);

            const $specsList = $('#modal-specs-list');
            $specsList.empty(); 
            

            if (carInfo.car_specs && carInfo.car_specs !== "null" && carInfo.car_specs.length > 0) {
                
                if (Array.isArray(carInfo.car_specs)) {
                    carInfo.car_specs.forEach(function(spec) {
                        $specsList.append('<li>' + spec + '</li>');
                    });
                } 
                else if (typeof carInfo.car_specs === 'string') {
                    $specsList.append('<li>' + carInfo.car_specs + '</li>');
                }

            } else {
                $specsList.append('<li>Інформація відсутня</li>');
            }

            $('#car-modal').css('display', 'flex').hide().fadeIn(300);
        } else {
            console.error("Помилка: авто з таким ID немає у змінній carsDatabase!");
        }
    });

    $('.close-btn, #car-modal').on('click', function(e) {
        if (e.target === this) {
            $('#car-modal').fadeOut(300);
        }
    });

    $('#catalog-container').on('click', '.delete-btn', function(event) {
        event.stopPropagation();

        const $card = $(this).closest('.car-card');
        const carId = $card.attr('data-id');

        if(!confirm('Ви впевнені?')) {
            return;
        }

        $.ajax({
            url: '/mclaren720s/backend/delete_car.php',
            type: 'POST',
            data: {car_id: carId},
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $card.fadeOut(300, function() {
                        $(this).remove();
                    });
                } else {
                    alert(response.error); 
                }
            },
            error: function(xhr) {
                console.error("Помилка сервера:", xhr.responseText);
                alert("Сталася помилка при видаленні.");
            }
        });
    });
})