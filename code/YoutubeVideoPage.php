<?php

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

class YoutubeVideoPage_Controller extends Page_Controller {

    private static $allowed_actions = array (
        'showVideo'
    );
    
    
    public function init() {
        parent::init();
        
        Requirements::css(YOUTUBEVIDEO_BASE.'/css/styles.css');
        
    }
    
    public function showVideo(SS_HTTPRequest $request) {
        
        $ID = $request->param('ID');

        $data = YoutubeVideo::get()->filter(array(
            'ID' => $ID
        ));
        
        return array (
                'Data' => $data
        );
    }
}