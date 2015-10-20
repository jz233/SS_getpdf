<?php

class ViewCount extends DataObject{
    private static $db = array(
        'ViewCount' => 'Int'
        
    );
    
    private static $belongs_to = array(
        'Property' => 'Property.ViewCount'
    );
}

