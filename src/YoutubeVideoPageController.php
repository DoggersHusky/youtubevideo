<?php
namespace BucklesHusky\YoutubeVideo;

use SilverStripe\View\Requirements;
use BucklesHusky\YoutubeVideo\Objects\YoutubeVideo;
use SilverStripe\Control\HTTPRequest;
use PageController;

class YoutubeVideoPageController extends PageController {

    private static $allowed_actions = [
        'showVideo'
    ];
    
    
    public function init() {
        parent::init();
        
        Requirements::css('buckleshusky/youtubevideo:css/styles.css');
        
    }
    
    public function showVideo(HTTPRequest $request) {
        
        $ID = $request->param('ID');

        $data = YoutubeVideo::get()->filter(array(
            'ID' => $ID
        ));
        
        return array (
                'Data' => $data
        );
    }
}
