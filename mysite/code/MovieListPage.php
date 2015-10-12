<?php
global $baseDir;
$baseDir = Director::baseFolder();

//define("DOMPDF_ENABLE_HTML5PARSER", false);
//require_once $baseDir.'/vendor/dompdf/dompdf/dompdf_config.inc.php';
require_once $baseDir.'\vendor\autoload.php';
use Knp\Snappy\Pdf;

require_once 'JSONParser.php';
//use Heyday\SilverStripe\WkHtml;



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
		Requirements::css("{$this->ThemeDir()}/css/jquery.raty.css");
		Requirements::css("{$this->ThemeDir()}/css/movielist.css");
		Requirements::javascript("{$this->ThemeDir()}/js/jquery.raty.js");
		Requirements::javascript("{$this->ThemeDir()}/js/star-rating.js");


	}

	private static $allowed_actions = array(
		'doInsert','doGetPdf','MovieSelector'
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

		//$form->setTemplate('MyCustomField');
		return $form;
	}

	public function selectMovie($data, $form){
		//	echo $data['Movie']; //ID value
		global $baseDir;

		$result = $this->getMovieList()->byId($data['Movie']);
	
		$pdf_creator = new Pdf($baseDir.'\vendor\bin\wkhtmltopdf');
		// header('Content-Type','application/pdf');
		// header('Content-Disposition','inline;filename="123.pdf"');	
		return $pdf_creator->generateFromHtml(
			$result->renderWith('SingleMovie'),
			$baseDir.'/pdfs/single-movie.pdf',
			array('disable-javascript'=>false),true);
		//,'user-style-sheet'=>$baseDir.'/themes/mytheme/css/singlemovie.css'
		// echo $pdf_creator->getOutputFromHtml($result->renderWith('SingleMovie'),array('disable-javascript'=>false));
		//echo $pdf_creator->getOutput($result->renderWith('SingleMovie'));
		

		//return $result->renderWith('SingleMovie');
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
		
		/*

		$generator = new WkHtml\Generator(
		    new \Knp\Snappy\Pdf($baseDir.'/vendor/bin/wkhtmltopdf'),
		    new \Heyday\SilverStripe\WkHtml\Input\String('<html>HAHAHAHAHA</html>'),
		    new \Heyday\SilverStripe\WkHtml\Output\Browser('test.pdf', 'application/pdf')
		);
		return $generator->process();*/
		

		//$pdf_creator = new Pdf($baseDir.'\vendor\bin\wkhtmltopdf');
		// SS_HTTPRequest.addHeader('Content-Type','application/pdf');
		// SS_HTTPRequest.addHeader('Content-Disposition','inline;filename="file.pdf"');

		//header('Content-Type: application/pdf');
		//header('Content-Disposition: inline; filename="file.pdf"');	

		//echo $pdf_creator->generateFromHtml('$base',$baseDir.'/pdf/movie-list.pdf');
	}
	
	
	
}
		 
