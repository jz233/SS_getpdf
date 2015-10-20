<?php

class ContactPerson extends DataObject{
    
    private static $db = array(
//        'PhotoUrl' => 'Varchar'
        'FirstName' => 'Varchar',
        'LastName' => 'Varchar',
        'Mobile' => 'Varchar',
        'Email' => 'Varchar'
        
    );
    
    private static $has_many = array(
        'Properties' => 'Property'
    );
    
    
    
}

