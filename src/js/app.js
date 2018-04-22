jQuery(document).ready(($) => {
	$('.image-grid').masonry({
		itemSelector: '.image-grid .image-grid-item',
		gutter: 10,
		columnWidth: '.grid-sizer',
		percentPosition: true,
	});
});
