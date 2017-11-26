<?php

namespace BucklesHusky\YoutubeVideo;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use BucklesHusky\YoutubeVideo\Objects\YoutubeVideo;
use SilverStripe\View\Requirements;
use Page;

class YoutubeVideoPage extends Page {
    
    private static $has_many = [
        'YoutubeVideo' => YoutubeVideo::class
    ];
    
    Public function getCMSFields() {
        //get parent cms fields
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab('Root.Youtube', GridField::create( 'YoutubeVideo', 'Youtube Videos', $this->YoutubeVideo(), GridFieldConfig_RecordEditor::create() ) );
        
        return $fields;
    }
    
}