jQuery(function($) {
	function getConfig() {
		return window.katlakitHeaderFooter || {};
	}

	function getRow($element) {
		return $element.closest('.katlakit-hf-rule-row');
	}

	function resetSpecificTarget($row) {
		$row.find('.katlakit-hf-rule-value').val('');
		$row.find('.katlakit-hf-specific-search').val('');
		$row.find('.katlakit-hf-search-results').empty().prop('hidden', true);
	}

	function syncRuleRow($row) {
		var selectedRule = $row.find('.katlakit-hf-rule-type').val();
		var $specificWrap = $row.find('.katlakit-hf-specific-wrap');

		if ('specific-target' === selectedRule) {
			$specificWrap.removeClass('is-hidden');

			if ($row.find('.katlakit-hf-rule-value').val().indexOf('specific:') !== 0) {
				resetSpecificTarget($row);
			}

			return;
		}

		$specificWrap.addClass('is-hidden');
		resetSpecificTarget($row);
		$row.find('.katlakit-hf-rule-value').val(selectedRule);
	}

	function createMessageItem(message) {
		return $('<div />', {
			'class': 'katlakit-hf-search-empty',
			text: message
		});
	}

	function renderSearchResults($row, items) {
		var config = getConfig();
		var $results = $row.find('.katlakit-hf-search-results');

		$results.empty();

		if (!items.length) {
			$results.append(createMessageItem(config.noResults || 'No matches found.'));
			$results.prop('hidden', false);
			return;
		}

		items.forEach(function(item) {
			$results.append(
				$('<button />', {
					type: 'button',
					'class': 'katlakit-hf-search-result',
					'data-value': item.value,
					'data-label': item.label,
					text: item.label
				})
			);
		});

		$results.prop('hidden', false);
	}

	function searchSpecificTargets($row, keyword) {
		var config = getConfig();
		var $results = $row.find('.katlakit-hf-search-results');

		$results.empty().append(createMessageItem(config.searching || 'Searching...')).prop('hidden', false);

		$.ajax({
			url: config.ajaxUrl || ajaxurl,
			type: 'GET',
			dataType: 'json',
			data: {
				action: config.action || 'katlakit_header_footer_search_targets',
				nonce: config.nonce || '',
				keyword: keyword
			}
		}).done(function(response) {
			if (!response || !response.success || !response.data) {
				renderSearchResults($row, []);
				return;
			}

			renderSearchResults($row, response.data.items || []);
		}).fail(function() {
			renderSearchResults($row, []);
		});
	}

	function addNewRuleRow($panel) {
		var $template = $panel.find('.katlakit-hf-rule-template').first();
		var $clone = $template.clone();

		$clone.removeClass('katlakit-hf-rule-template').prop('hidden', false);
		$clone.find('input, select').prop('disabled', false);
		$clone.find('.katlakit-hf-rule-type').val('');
		resetSpecificTarget($clone);
		syncRuleRow($clone);

		$panel.find('.katlakit-hf-rules-list').append($clone);
	}

	$(document).on('change', '.katlakit-hf-rule-type', function() {
		syncRuleRow(getRow($(this)));
	});

	$(document).on('click', '.katlakit-hf-add-rule', function() {
		addNewRuleRow($(this).closest('.katlakit-hf-rules-panel'));
	});

	$(document).on('click', '.katlakit-hf-remove-rule', function() {
		var $row = getRow($(this));
		var $rows = $row.closest('.katlakit-hf-rules-list').find('.katlakit-hf-rule-row').not('.katlakit-hf-rule-template');

		if ($rows.length > 1) {
			$row.remove();
			return;
		}

		$row.find('.katlakit-hf-rule-type').val('');
		resetSpecificTarget($row);
		syncRuleRow($row);
	});

	$(document).on('input', '.katlakit-hf-specific-search', function() {
		var config = getConfig();
		var $input = $(this);
		var $row = getRow($input);
		var keyword = $input.val().trim();
		var timer = $row.data('searchTimer');

		$row.find('.katlakit-hf-rule-value').val('');

		if (timer) {
			clearTimeout(timer);
		}

		if (keyword.length < 2) {
			$row.find('.katlakit-hf-search-results')
				.empty()
				.append(createMessageItem(config.searchMinimum || 'Type at least 2 characters.'))
				.prop('hidden', false);
			return;
		}

		timer = setTimeout(function() {
			searchSpecificTargets($row, keyword);
		}, 250);

		$row.data('searchTimer', timer);
	});

	$(document).on('focus', '.katlakit-hf-specific-search', function() {
		var $row = getRow($(this));
		var value = $(this).val().trim();
		var $results = $row.find('.katlakit-hf-search-results');

		if (value.length >= 2 && $results.children().length) {
			$results.prop('hidden', false);
		}
	});

	$(document).on('click', '.katlakit-hf-search-result', function() {
		var $button = $(this);
		var $row = getRow($button);

		$row.find('.katlakit-hf-rule-value').val($button.data('value'));
		$row.find('.katlakit-hf-specific-search').val($button.data('label'));
		$row.find('.katlakit-hf-search-results').empty().prop('hidden', true);
	});

	$(document).on('click', function(event) {
		if ($(event.target).closest('.katlakit-hf-specific-wrap').length) {
			return;
		}

		$('.katlakit-hf-search-results').prop('hidden', true);
	});

	$('.katlakit-hf-rule-row').not('.katlakit-hf-rule-template').each(function() {
		syncRuleRow($(this));
	});
});
