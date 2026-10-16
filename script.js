$(document).ready(function() {
    $('.down_menu').hide();
    $('.menu_but').click(function() {
        $('.down_menu').slideToggle(500);
    });

    $('.nav_list a').click(function() {
        $('.down_menu').slideToggle(500);
    });

  if (localStorage.getItem('site-theme') === 'dark') {
    $('body').addClass('dark-theme');
    
    if ($('#theme-checkbox').length) {
      $('#theme-checkbox').prop('checked', true);
    }
  }
  $('#theme-checkbox').on('change', function() {
    $('body').toggleClass('dark-theme');

    if ($('body').hasClass('dark-theme')) {
      localStorage.setItem('site-theme', 'dark');
    } else {
      localStorage.setItem('site-theme', 'light');
    }
  });

  $('#play_but').click(function() {
					let video = $('.video').get(0);

					if (video.paused) {
						video.play();
					}
					else {
						video.pause();
					}

					$(this).toggleClass('is-paused')
				});

  $('.modal').hide();
  const carsData = {
    "720s": {
      name: "McLaren 720S GT3 EVO",
      image: "../src/720s.jpg",
      specs: [
        "<span>Двигун:</span> M840T 4.0L Twin-Turbo V8",
        "<span>Потужність:</span> Обмежена регламентом FIA",
        "<span>Трансмісія:</span> 6-ступенева секвентальна",
        "<span>Вага:</span> ~1240 кг"
      ]
    },
    "p1": {
      name: "McLaren P1",
      image: "../src/p1.jpg",
      specs: [
        "<span>Двигун:</span> 3.8L Twin-Turbo V8 + Електромотор",
        "<span>Потужність:</span> 903 к.с.",
        "<span>Розгін 0-100:</span> 2.8 сек",
        "<span>Макс. швидкість:</span> 350 км/год"
      ]
    }
  };

  $('.car-card').on('click', function() {
    const carId = $(this).attr('data-car');
    const carInfo = carsData[carId];

    if(carInfo) {
      $('#modal-title').text(carInfo.name);
      $('#modal-img').attr('src', carInfo.image);
      
      $('#modal-specs-list').empty();
      carInfo.specs.forEach(function(spec) {
        $('#modal-specs-list').append('<li>' + spec + '</li>');
      });

      $('#car-modal').css('display', 'flex').hide().fadeIn(300);
    }
  });

  $('.close-btn').on('click', function() {
    $('#car-modal').fadeOut(300);
  });

  $('#car-modal').on('click', function(event) {
    if ($(event.target).is('#car-modal')) {
      $(this).fadeOut(300);
    }
  });

});