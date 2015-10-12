
<div>_pdf.ss</div>
<div class="content">
	<div class="container">
		<div class="row">
			<div class="main col-sm-8">
				<% loop $MoviesList %>
				<div class="movie-row" style="width:800px;height:350px;">
					<div class="movie-poster" style="display:inline-block;margin:8px;">
						<img src=$UrlPoster/>
					</div>
					<div class="movie-description" style="display: inline-block;vertical-align:top;margin: 10px;width: 420px;height: 100%; ">
						<div class="movie-title" style="text-align: center;"><span><b>$Title</b></span></div>
						<div class="movie-info">
							<span class="movie-rated">$Rated</span>
							<span class="movie-runtime">$Runtime</span>
							<span class="movie-countries">$Countries</span>
							<span class="movie-genres">$Genres</span>
						</div>
						<div class="movie-directors" >$Directors</div>
						
						<div class="movie-rating" movie-rating=$Rating>
							<span class='rating-number'>$Rating</span>
							<span>
							<script type="text/javascript">
								(function(){
									$('.movie-rating').raty({
										number:10,
										readOnly:true,
										score:function(){
											return $(this).attr('movie-rating');
										},
										path:'themes/mytheme/images'

									});
								})();
							</script>
							</span>
						</div>
						<div class="movie-simple-plot" style="word-wrap: break-word;text-align:justify;">$SimplePlot</div>
					</div>
				</div>
				<% end_loop %>
			</div>
		</div>
	</div>
</div>