function getstars(){
	$('.movie-rating-stars').raty({
		number:10,
		readOnly:true,
		score:function(){
			return $(this).attr('stars-count');
		},
		path:'themes/mytheme/images'

	});
}