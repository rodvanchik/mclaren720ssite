$(document).ready(function() {
    $('.menu_but').click(function() {
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

});