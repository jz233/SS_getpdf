<% base_tag %>
<link rel="stylesheet" type="text/css" href="{$ThemeDir}/css/singlemovie.css">

<div class="content">
	<div class="single-movie-item">
		<div class="single-movie-baseinfo">
			<div class="single-movie-poster" >
				<div class="single-movie-image" ><img src=$UrlPoster /></div>
			</div>
			<div class="single-movie-description" >
				<div class="single-movie-title" >
					<span><b>$Title</b></span>
				</div>
				<div class="divider" ></div>
				<p>
					<div class="single-movie-info">
						<div class="single-movie-rated" ><span><b>Rated: </b></span><span><% if $Rated %> $Rated <% else %> N/A <% end_if %></span></div>
						<div class="single-movie-runtime" ><span><b>Runtime: </b></span><span><% if $Runtime %> $Runtime <% else %> N/A <% end_if %></span></div>
						<div class="single-movie-countries" ><span><b>Countries: </b></span><span><% if $Countries %> $Countries <% else %> N/A <% end_if %></span></div>
						<div class="single-movie-languages" ><span><b>Languages: </b></span><span><% if $Languages %> $Languages <% else %> N/A <% end_if %></span></div>
					
						<div class="single-movie-genres" ><span><b>Genres: </b></span><span>$Genres</span></div>
						<div class="single-movie-directors" ><span><b>Director: </b>&nbsp;</span>$Directors</div>
						<div class="single-movie-writers" ><span><b>Writer: </b>&nbsp;</span>$Writers</div>
					</div>
				</p>
				<div class="divider" ></div>
				<div class="single-movie-rating" ><span><b>Rating: </b>&nbsp;</span>$Rating &nbsp;(metascore:&nbsp;<span>$Metascore</span>)</div>
				<p></p>
					
			</div>
		</div>
		<div class="single-movie-plot" >$Plot</div>
	</div>
</div>