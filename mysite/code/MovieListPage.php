<?php
global $baseDir;
$baseDir = Director::baseFolder();

require_once $baseDir.'\vendor\autoload.php';
use Knp\Snappy\Pdf;

require_once 'JSONParser.php';




class MovieListPage extends Page{
	
	private static $db = array(
		'Title' => 'Varchar'
	);
	
	private static $has_many = array(
		'MoviesList' => 'Movie'
	);
	
	public function getMovieList(){
		return $this->MoviesList();
		
	}
	
	public function getBaseFolder(){
		return Director::baseFolder();
	}
}

class MovieListPage_Controller extends Page_Controller{
	
	public function init(){
		parent::init();

		Requirements::javascript("{$this->ThemeDir()}/js/jquery.raty.js");
		Requirements::css("{$this->ThemeDir()}/css/jquery.raty.css");	
		Requirements::css("{$this->ThemeDir()}/css/movielist.css");
		


	}

	private static $allowed_actions = array(
		'doInsert','doGetPdf','MovieSelector','doGetIt'
	);

	public function MovieSelector(){
	
		$movies = Movie::get();

		$map = $movies->map('ID', 'Title')->toArray();

		$form = Form::create(
			$this,
			__FUNCTION__,
			FieldList::create(
				DropdownField::create(
					'Movie',
					'Movie',
					$map
				)
			),
			FieldList::create(
				FormAction::create('selectMovie','OK')
				
					->addExtraClass('btn btn-default-color btn-lg')
			)
		);

		//TODO setTemplate
		//$form->setTemplate('MyCustomField');
		return $form;
	}

	public function selectMovie($data, $form){
		//	echo $data['Movie']; //ID value
		global $baseDir;

		$result = $this->getMovieList()->byId($data['Movie']);
	
		$pdf_creator = new Pdf($baseDir.'\vendor\bin\wkhtmltopdf');
		
		return $pdf_creator->generateFromHtml(
			$result->renderWith('SingleMovie'),
			$baseDir.'/pdfs/single-movie.pdf',
			array('disable-javascript'=>false),true);
		
	}

	public function doInsert(){
		global $baseDir;
		
		$movies_array = JSONParser::parseJSON($baseDir.'\mysite\inTheatre.json');	//9 items
		
		for($i=0; $i<count($movies_array); $i++){
			$movie = Movie::create();
			$movie = $movies_array[$i];
			$movie->MovieListPageID = $this->ID;
			$movie->write();
		}

		return $this->redirectBack();
		
	}

	public function doGetPdf(SS_HTTPRequest $request){
		global $baseDir;
		
		header("Content-Type: application/pdf");
		header("Content-Disposition: attachment; filename='created.pdf'");
		return $this->generatePDF(
			array(
				'page-size' => 'A4',
				'disable-smart-shrinking' => true,
				'user-style-sheet'=>$baseDir.'/themes/mytheme/css/movielist.css',
				
				'javascript-delay' => 2000
			),
			array('enable-javascript' => true));
		
		
	}

	public function doGetIt(SS_HTTPRequest $request){
		// var_dump($request->params());
		global $baseDir;

		$result = $this->getMovieList()->byId($request->param('ID'));
		printf($result->ID);

		$filePath = $baseDir.'/pdfs/movie-'.$result->ID.'.pdf';
	
		$pdf_creator = new Pdf($baseDir.'\vendor\bin\wkhtmltopdf');
		

		return $pdf_creator->generateFromHtml(
			$result->renderWith('SingleMovie'),
			$filePath,
			array('disable-javascript'=>false),true);
	}
	
	
	
}
		 
