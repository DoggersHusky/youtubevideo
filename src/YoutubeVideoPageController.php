<?php

use SilverStripe\View\Requirements;
use BucklesHusky\YoutubeVideo\Objects\YoutubeVideo;

class YoutubeVideoPageController extends PageController {

    private static $allowed_actions = [
        'showVideo'
    ];
    
    
    public function init() {
        parent::init();
        
        Requirements::css('buckleshusky/youtubevideo:css/styles.css');
        
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
