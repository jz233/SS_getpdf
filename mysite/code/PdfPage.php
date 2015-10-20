<?php

global $baseDir;
$baseDir = Director::baseFolder();

require_once $baseDir.'\vendor\autoload.php';
use Knp\Snappy\Pdf;

class PdfPage extends Page{
	
	
	private static $db = array(
		'Title' => 'Varchar'
	);
	
	
}

class PDFPage_Controller extends Page_Controller{
	
	
	private static $allowed_actions = array(
		'GetPdfForm'
	);
	
	public function GetPdfForm(){
		
		$form = Form::create(
			$this,
			"GetPdfForm",
			FieldList::create(
				TextField::create('Website','Website Address')
					->setAttribute('placeholder','Input website...')
				
			),
			FieldList::create(
				FormAction::create('doGetPdf','Get PDF')
					->setUseButtonTag(true)
					->addExtraClass('btn btn-default')
					
			),
			RequiredFields::create('Website')
		)->addExtraClass('form-style');
		
		
		return $form;
	}
	
	public function doGetPdf($data, $form){
	
		global $baseDir;
		
		$website = $data['Website'];
		
		$pdf_creator = new Pdf($baseDir.'\vendor\bin\wkhtmltopdf');
		
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename="file.pdf"');
		echo $pdf_creator->getOutput($website);
				
                return $this->redirectBack();	
		
	}
	
	
}
