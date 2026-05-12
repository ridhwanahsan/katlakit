/** KatlaKit Admin AJAX Logic */
jQuery(document).ready(function($) {
	$('#katlakit-save-settings').on('click', function(e) {
		e.preventDefault();
		var $btn = $(this);
		var originalText = $btn.text();

		$btn.text(katlakitAdmin.i18n.saving).attr('disabled', true);
		
		var formData = {};
		
		// Serialize standard inputs (text, password, hidden)
		var serialized = $('#katlakit-settings-form').serializeArray();
		$.each(serialized, function() {
			formData[this.name] = this.value;
		});

		// Explicitly handle all checkboxes (checked and unchecked)
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
