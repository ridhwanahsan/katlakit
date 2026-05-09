jQuery(document).ready(function($) {
	// Tab Switching
	$('.katlakit-nav li').on('click', function() {
		$('.katlakit-nav li').removeClass('active');
		$(this).addClass('active');

		var target = $(this).data('tab');
		$('.katlakit-tab-content').removeClass('active');
		$('#tab-' + target).addClass('active');
	});

	// Save Settings via AJAX
	$('#katlakit-save-settings').on('click', function(e) {
		e.preventDefault();
		var $btn = $(this);
		var originalText = $btn.text();

		$btn.text(katlakitAdmin.i18n.saving).attr('disabled', true);

		// Unchecked checkboxes aren't serialized, so we must add them manually if needed,
		// or handle it in PHP. For ease, we can just serialize the form.
		// However, a simple serializeArray works if we inject hidden fields for unchecked,
		// or we can iterate all inputs.
		
		var formData = {};
		$('#katlakit-settings-form input[type="checkbox"]').each(function() {
			formData[$(this).attr('name')] = $(this).is(':checked') ? '1' : '0';
		});

		$.ajax({
			url: katlakitAdmin.ajaxUrl,
			type: 'POST',
			data: {
				action: 'katlakit_save_settings',
				nonce: katlakitAdmin.nonce,
				settings: formData
			},
			success: function(response) {
				$btn.text(katlakitAdmin.i18n.saved);
				setTimeout(function() {
					$btn.text(originalText).attr('disabled', false);
				}, 2000);
			},
			error: function() {
				alert(katlakitAdmin.i18n.error);
				$btn.text(originalText).attr('disabled', false);
			}
		});
	});
});
