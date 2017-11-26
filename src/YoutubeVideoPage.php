<?php

namespace BucklesHusky\YoutubeVideo;

use Page;

class YoutubeVideoPage extends Page {
    
    private static $has_many = array(
        'YoutubeVideo' => 'YoutubeVideo'
    );
    
    Public function getCMSFields() {
        //get parent cms fields
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab('Root.Youtube', GridField::create( 'YoutubeVideo', 'Youtube Videos', $this->YoutubeVideo(), GridFieldConfig_RecordEditor::create() ) );
        
        return $fields;
    }
    
}