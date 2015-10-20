<?php

class Property extends DataObject{
       private static $db = array(
           'Latitude' => 'Varchar',
           'Longitude' => 'Varchar',
           'Address' => 'Text',
           'LandArea' => 'Int',
           'FloorArea' => 'Int',
           'PropertyIDNumber' => 'Varchar',
           'Status' => 'Int',
           'BedRoomCount' => 'Int',
           'LivingRoomCount' => 'Int',
           'BathRoomCount' => 'Int',
           'GarageCount' => 'Int',
           'ListedDate' => 'Date'
           
           //'ViewedTimes'
           //'Listed on'
           //'Contact
           
       );
       
       private static $has_one = array(
           'ViewCount' => 'ViewCount',
           'ContactPerson' => 'ContactPerson',
           'MapsPage' => 'MapsPage' 
            //TODO change relation name for MapsPage
       );
       
       
       
    
}

