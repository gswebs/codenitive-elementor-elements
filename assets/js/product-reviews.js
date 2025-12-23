(function ($) {
	const initReadMore = function ($scope) {
		$scope.find('.cdescription-toggle').off('click').on('click', function (e) {
			e.preventDefault();

			const $btn = $(this);
			const $wrap = $btn.closest('.cdescription');
			const $text = $wrap.find('.cdescription-text');
			const fullHtml = $wrap.find('.cdescription-full').html();
			const shortHtml = $text.data('short'); // now stored properly

			const expanded = $wrap.toggleClass('expanded').hasClass('expanded');

			$text.html(expanded ? fullHtml : shortHtml);
			$btn.text(expanded ? $btn.data('less') : $btn.data('more'));
		});
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/codenit_all_reviews.default',
			initReadMore
		);
	});
})(jQuery);
