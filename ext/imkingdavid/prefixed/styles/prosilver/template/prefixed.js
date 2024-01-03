$(document).ready(function() {

	$('#used_prefixes').sortable({
		connectWith: '.prefixed_sortable',
		placeholder: 'prefix_placeholder',
		cancel: 'no-prefix-text',
		over: function(event, ui) {
			$('.no-prefix-text:visible').hide();
		}
	}).disableSelection().on('mouseup', '.prefix-item-click-area', function () {
		$(this).appendTo($("#available_prefixes").not($(this).closest("span")));
		if ($('#used_prefixes').children().length < 2) {
			$('.no-prefix-text:hidden').show();
		}
	});

	$('#available_prefixes').sortable({
		connectWith: '.prefixed_sortable',
		placeholder: 'prefix_placeholder',
		over: function(event, ui) {
			if ($('#used_prefixes').children().length < 2) {
				$('.no-prefix-text:hidden').show();
			}
		}
	}).disableSelection().on('mouseup', '.prefix-item-click-area', function () {
		$(this).appendTo($("#used_prefixes").not($(this).closest("span")));
		$('.no-prefix-text:visible').hide();
	});

	// Add data to the form on submission
	$(this).on('submit', '#postform', function(event) {
		var input = $("<input>").attr("type", "hidden").attr("name", "prefixes_used").val($('#used_prefixes').sortable('serialize'));
		console.log($('#used_prefixes').sortable('serialize'));
		$('#postform').append($(input));
	});

	$('#prefix_dropdown_toggle').click(function(e) {
		e.preventDefault();
		$('#prefix_dropdown').toggle();
		$('#prefix_dropdown_toggle i.fa-arrow-down').toggle();
		$('#prefix_dropdown_toggle i.fa-arrow-up').toggle();
	});
});
