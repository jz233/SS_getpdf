<?php

class MapsPage extends Page{
    
    private static $db = array(
        'Title' => 'Varchar'
    );
    
    private static $has_many = array(
        'PropertyList' => 'Property'
    );
    
    public function getPropertyList(){
        return $this->PropertyList();
    }
        
            
}

class MapsPage_Controller extends Page_Controller{
    
    public function init() {
        parent::init();
        Requirements::javascript("{$this->ThemeDir()}/js/gmaps.js");
//        Requirements::javascript("{$this->ThemeDir()}/js/richmarker.js");
        Requirements::css("{$this->ThemeDir()}/css/transition.css");
    }
    
    private static $allowed_actions = array(
        'doInsert','doGetProperties'
    );
    
    public function doGetProperties(SS_HTTPRequest $request){
        $range = $request->getVar('range');
        $list = $this->PropertyList()->filter(array(
                    'Latitude:LessThan' => floatval($range[0]),
                    'Latitude:GreaterThan' => floatval($range[2]),
                    'Longitude:LessThan' => floatval($range[1]),
                    'Longitude:GreaterThan' => floatval($range[3])
                ));
        
        
        $json = JSONDataFormatter::create()->convertDataObjectSet($list);
        return $json;
    }
    
    public function doInsert(){
        $contactID = $this->doInsertContact();
        $viewcountID = $this->doInsertViewCount();
        $this->doInsertProperty($contactID,$viewcountID);
        
        $this->redirectBack();
    }
    public function doInsertContact(){
        $contact = ContactPerson::create();
        $contact->FirstName = 'Stephen';
        $contact->LastName = 'Wang';
        $contact->Mobile = '0212921969';
        $contact->Email = 'stephenw@lodge.co.nz';
        $contact->write();
      
        return $contact->ID;
    }
    
     public function doInsertViewCount(){
        $viewcount = ViewCount::create();
        $viewcount->ViewCount = 0;
        $viewcount->write();
        
        return $viewcount->ID;
    }
    public function doInsertProperty($contactID, $viewcountID){
          
        $property = Property::create();
     
        $property->Latitude = '-37.786428';
        $property->Longitude = '175.278766';
        $property->Address = '3 Defoe Avenue, Hillcrest Hamilton, New Zealand';
        $property->LandArea = 615;
        $property->FloorArea = 95;
        $property->PropertyIDNumber = 'LH11070';
        $property->Status = 0;
        $property->BedRoomCount = 3;
        $property->LivingRoomCount = 1;
        $property->BathRoomCount = 1;
        $property->GarageCount = 1;
        $property->ListedDate = '2015-10-15';
        
        $property->ContactPersonID =  $contactID;
        $property->ViewCountID = $viewcountID;
        $property->MapsPageID = $this->ID;
                
        $property->write();
    }
    
  
   
}