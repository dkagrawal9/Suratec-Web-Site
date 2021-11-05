$(document).ready(function(){
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

    // remove all .active classes when clicked anywhere
    hide = true;
    $('body').on("click", function () {
        if (hide) $('.s-admin').removeClass('active');
        hide = true;
    });

    // add and remove .active
    $('body').on('click', '.s-admin', function () {

        var self = $(this);

        if (self.hasClass('active')) {
            $('.s-admin').removeClass('active');
            return false;
        }

        $('.s-admin').removeClass('active');

        self.toggleClass('active');
        hide = false;
    });

})