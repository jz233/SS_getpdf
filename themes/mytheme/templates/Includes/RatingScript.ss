<script type="text/javascript">
function getstars(){
	$('.movie-rating').raty({
		number:10,
		readOnly:true,
		score:function(){
			return $(this).attr('movie-rating');
		},
		path:'themes/mytheme/images'

	});
}
</script>