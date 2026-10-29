$(document).ready(function() {
  $('.admin-only').hide(); 
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

  $.ajax({
    url: '/mclaren720s/backend/auth_check.php',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        if (response.logged_in) {
            $('#nav-login').hide();
            $('#nav-logout').show();
            $('#nav-admin-panel').hide();
        } else {
            $('#nav-login').show();
            $('#nav-logout').hide();
            $('#nav-admin-panel').hide();
        }

        if (response.is_admin) {
            $('#nav-admin-panel').show();
            $('body').addClass('admin-logged-in');
        }
    }
  });

  $('#nav-logout').on('click', function(event) {
        event.preventDefault();

        $.ajax({
            url: '/mclaren720s/backend/logout.php',
            type: 'GET',
            success: function() {
                window.location.reload(); 
            }
        });
    });
});