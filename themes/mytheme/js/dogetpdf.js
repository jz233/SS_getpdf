
$('.get-pdf').click(
	function (){
		var movie_id = $(this).attr('movie-id');
		$.ajax({
			url:'movie-list/doGetIt/' + movie_id,
			method:'GET',
			success: function(){
				//TODO change pdf's name
				$('[movie-id = '+ movie_id +']').parent().append("<a href='pdfs/movie-"+ movie_id +".pdf'>Link</a>");
				alert('success');
			}

		});

	}
);
$('.get-list-pdf').click(
	function (){
		
		$.ajax({
			url:'movie-list/doGetPdf',
			method:'GET',
			success: function(){
				//TODO
				alert('success');
			}

		});

	}
);

