let findFavItemsl

$(function(){
	if ($("#mmenu").length) {
		$("#mmenu").mmenu({
			"extensions": [
			"position-front",
			"pagedim-black"
			]
		},{
			"language":"ru",
		});
	}
	
	findFavItems = function() {
		$.each(favValues, function(index, item) {
			$('.fav-btn[data-id='+ item +']')
				.removeClass('glyphicon-heart-empty')
				.addClass('glyphicon-heart').addClass('active');
		});
	}
	
	function updateFavCounter() {
		if (favValues.length > 0)
			$('#fav-header-count').show().find('.val').text(favValues.length);
		else
			$('#fav-header-count').hide();
	}
	
	let favValues = JSON.parse(localStorage.getItem('fav')) || [];
	
	if (favValues.length > 0) {				
		findFavItems();
		updateFavCounter();
	}	

	
	$(document).on('click', '.fav-btn', function() {
		const $t = $(this);
		$t.toggleClass('active');
		
		let values = favValues;
		
		if ($t.hasClass('active')) {			
			$t.removeClass('glyphicon-heart-empty').addClass('glyphicon-heart');
			values.push($t.data('id'));			
		} else {
			const index = values.indexOf($t.data('id'));
			values.splice(index, 1);
			$t.removeClass('glyphicon-heart').addClass('glyphicon-heart-empty');
		}
		
		localStorage.setItem('fav', JSON.stringify(values));
		favValues = values;
		
		updateFavCounter();
	});
});