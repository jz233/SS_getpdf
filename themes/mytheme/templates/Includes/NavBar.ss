<div id="nav-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav class="navbar">
					
					<ul class="nav navbar-nav">
						<% loop $Menu(1) %>
							<li><a class="$LinkingMode" href="$Link">$MenuTitle</a></li>
						<% end_loop %>
					</ul>
				
				</nav>
				
			</div>
		</div>
	</div>
</div>