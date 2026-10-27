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
  };
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

  let carsDatabase = [
    {
      id: "720s",
      name: "McLaren 720S GT3 EVO",
      image: "../src/720s.jpg",
      specs: ["Двигун: M840T 4.0L Twin-Turbo V8", "Вага: ~1240 кг"]
    },
    {
      id: "p1",
      name: "McLaren P1",
      image: "../src/p1.jpg", 
      specs: ["Двигун: 3.8L V8 Гібрид", "Потужність: 903 к.с."]
    },
    {
      id: "720s",
      name: "McLaren 720S GT3 EVO",
      image: "../src/720s.jpg",
      specs: ["Двигун: M840T 4.0L Twin-Turbo V8", "Вага: ~1240 кг"]
    },
    {
      id: "720s",
      name: "McLaren 720S GT3 EVO",
      image: "../src/720s.jpg",
      specs: ["Двигун: M840T 4.0L Twin-Turbo V8", "Вага: ~1240 кг"]
    },
  ];

  function renderCatalog(carsArray) {
    const $container = $('#catalog-container');
    $container.empty(); 

    carsArray.forEach(function(car) {
      const cardHtml = `
        <div class="car-card" data-id="${car.id}">
          <img src="${car.image}" alt="${car.name}">
          <h3>${car.name}</h3>
          <button class="btn-specs">Характеристики</button>
        </div>
      `;
      $container.append(cardHtml);
    });
  };

  renderCatalog(carsDatabase);

  /*$.ajax({  
    url: '../backend/catalog.php',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
      if(data.error) {
        console.error(data.error);
      } else {
        carsDatabase = data;
        renderCatalog(carsDatabase);
      }
    },
    error: function() {
      console.error("помилка");
    }
  })*/

  $('#catalog-container').on('click', '.car-card', function() {
    const carId = $(this).attr('data-id');
    const carInfo = carsDatabase.find(c => c.id === carId);

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

  $('.close-btn, #car-modal').on('click', function(e) {
    if (e.target === this) {
      $('#car-modal').fadeOut(300);
    }
  });
});