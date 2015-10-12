<?php

class Movie extends DataObject{
	
	private static $db = array(
		'Title' => 'Varchar',
		'Countries' => 'Varchar',
		'Locations' => 'Varchar',
		'Genres' => 'Varchar',
		'Languages' => 'Varchar',
		'Metascore' => 'Varchar',
		'Rated' => 'Varchar',
		'Runtime' => 'Varchar',
		'Directors' => 'Varchar',
		'Rating' => 'Decimal',
		'Plot' => 'Text',
		'SimplePlot' => 'Text',
		'Writers' => 'Varchar',
		'UrlPoster' => 'Text'
	);
	
	
	private static $has_one = array(
		'MovieListPage' => 'MovieListPage'
	);
	
	
}
