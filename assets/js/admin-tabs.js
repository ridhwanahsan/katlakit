/** KatlaKit Admin Tabs Logic */
jQuery(document).ready(function($) {
	$('.katlakit-nav li').on('click', function() {
		$('.katlakit-nav li').removeClass('active');
		$(this).addClass('active');

		var target = $(this).data('tab');
		$('.katlakit-tab-content').removeClass('active');
		$('#tab-' + target).addClass('active');
	});
});
