/** KatlaKit Admin AJAX Logic */
jQuery(document).ready(function($) {
	$('#katlakit-save-settings').on('click', function(e) {
		e.preventDefault();
		var $btn = $(this);
		var originalText = $btn.text();

		$btn.text(katlakitAdmin.i18n.saving).attr('disabled', true);
		
		var formData = {};
		
		$('#katlakit-settings-form').find('input, select, textarea').each(function() {
			var $input = $(this);
			var name = $input.attr('name');
			if (!name) return;

			// Extract key from name="settings[key]"
			var match = name.match(/^settings\[(.+)\]$/);
			var key = match ? match[1] : name;
			
			var value;
			if ($input.is(':checkbox')) {
				value = $input.is(':checked') ? '1' : '0';
			} else {
				value = $input.val();
			}

			formData[key] = value;
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
