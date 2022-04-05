<?php
	
?>

<div id="product-list-module"></div>

<script>
	$(function() {
		$.post('<?= $this->createUrl('/catalog/favorites') ?>', {fav: localStorage.getItem('fav')}, function(html) {
			$('#product-list-module').empty().html(html);	
			findFavItems();
		})
	});
</script>