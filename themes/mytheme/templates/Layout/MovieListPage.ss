<!-- CUSTOM TEMPLATE BEGINS-->
<% base_tag %>
<%-- <% include MyCustomField %> --%>


<div class="content">
	<div class="container">
		<div class="row">
		
			<div >
				<% loop $MoviesList %>
				<div class="movie-row">
					<div class="movie-poster" >
						<img src=$UrlPoster/>
					</div>
					<div class="movie-description">
						<div class="movie-title"><span><b>$Title</b></span></div>
						<p>
						<div class="movie-info" >
							<span class="movie-rated"><% if $Rated %> $Rated <% else %> N/A <% end_if %></span> |
							<span class="movie-runtime"><% if $Runtime %> $Runtime <% else %> N/A <% end_if %></span> |
							<span class="movie-countries">$Countries</span>
							<br>
							<span class="movie-genres">$Genres</span>
						</div>
						</p>
						<p>
						<div class="movie-directors"><span><b>Director: </b>&nbsp;$Directors</span></div>
						</p>
						<div class="movie-rating-stars" stars-count=$Rating>
							<span>
							<script>
								getstars();
							</script>
							</span>
						</div>
						<div class="movie-rating"><span>$Rating</span></div>
						<p></p>
						<div class="movie-simple-plot"><span>$SimplePlot</span></div>
						<div><button type="button" class="get-pdf" movie-id=$ID >Get it</button></div>
					</div>
				</div>
				<% end_loop %>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{$ThemeDir}/js/dogetpdf.js"></script>

<!-- CUSTOM TEMPLATE ENDS-->