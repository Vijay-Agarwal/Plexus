$(function(){
	$('.search').keyup(function(){
		var search=$(this).val();

		$.post('http://localhost/plexus/search.php',{search:search},function(data){
			$('.search-result').html(data);

		});

	});
});