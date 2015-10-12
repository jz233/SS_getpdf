<?php

class JSONParser {


	public static function parseJSON($url){
		
		$data = file_get_contents($url);
		$de_json = json_decode($data,TRUE);
		
		
		$count_json = count($de_json);	//3 Objects
	
		$movies = $de_json[0]['movies'];
		$count_movies = count($movies);
		
		
		$movies_array = array();
		
		
		
		for($i=0; $i<$count_movies; $i++){
			$movie_json = $movies[$i];
			
								
			$Title = $movie_json['title'];
			$Countries = implode(', ',$movie_json['countries']);
			$Locations = implode(', ',$movie_json['filmingLocations']);
			$Genres = implode(', ',$movie_json['genres']);
			$Languages = implode(', ',$movie_json['languages']);
			$Metascore = $movie_json['metascore'];
			$Rated = $movie_json['rated'];
			$Runtime = implode(', ',$movie_json['runtime']);
			$Directors = $movie_json['directors'][0]['name'];
			$Rating = $movie_json['rating'];
			$Plot = $movie_json['plot'];
			$SimplePlot = $movie_json['simplePlot'];
			$WritersArray = $movie_json['writers'];
			
			$writers_array = array();
			foreach ($WritersArray as $Writer) {
				array_push($writers_array, $Writer['name']);
			}
			$Writers = implode(', ', $writers_array);

			$UrlPoster = $movie_json['urlPoster'];
			


			$movie = Movie::create();
			$movie->Title = $Title;
			$movie->Countries = $Countries;
			$movie->Locations = $Locations;
			$movie->Genres = $Genres;
			$movie->Languages = $Languages;
			$movie->Metascore = $Metascore;
			$movie->Rated = $Rated;
			$movie->Runtime = $Runtime;
			$movie->Directors = $Directors;
			$movie->Rating = $Rating;
			$movie->Plot = $Plot;
			$movie->SimplePlot = $SimplePlot;
			$movie->Writers = $Writers;
			$movie->UrlPoster = $UrlPoster;
			
			array_push($movies_array,$movie);
			
		}
		//var_dump(Movie::custom_database_fields('Movie'));
		//var_dump($movie_json['countries'][0]);
			
		
		return $movies_array;
		
		
	}
	
	
}

