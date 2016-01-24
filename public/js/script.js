$(document).ready(function() {
	$("#slider").owlCarousel({
		autoPlay : 3000,
	    navigation : true,
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
		navigation: false
	});
	
	$(document).ready(function() {
		$('.zoom-image').magnificPopup({type:'image'});
	});
});