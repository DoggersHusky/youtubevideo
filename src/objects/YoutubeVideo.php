<?php

namespace BucklesHusky\YoutubeVideo\Objects;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\ReadonlyField;
use BucklesHusky\YoutubeVideo\YoutubeVideoPage;
use Intervention\Image\Facades\Image;
use BucklesHusky\YoutubeVideo\Objects\YoutubeData;

class YoutubeVideo extends DataObject {
    
    private static $db= [
        'VideoID' => 'Text',
        'Title' => 'Text',
        'Description' => 'Text',
        'Thumbnail' => 'Text',
        'PublishDate' => 'SS_DateTime',
        'ChannelTitle' => 'Text',
        'ChannelThumbnail' => 'Text'
    ];
    
    private static $has_one = [
        'YoutubeVideoPage' => YoutubeVideoPage::class,
        'VideoImage' => Image::class,
        'ChannelImage' =>  Image::class
    ];
    
    private static $singular_name = "Youtube Video";
    private static $plural_name = "Youtube Videos";
    
    private static $summary_fields = [
        'GridThumbnail' => '',
        'Title' => 'Title',
        'Description' => 'Description',
    ];
    
    public function getGridThumbnail() {
        if ($this->VideoImage()->exists()) {
            return $this->VideoImage()->SetWidth(150);
        }
        
        return '(no image)';
        
    }
    
    public function getCMSFields() {
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab( 'Root.Main', TextField::create('VideoID','VideoID')->setDescription("Enter the video ID or the Video URL (ex: http://https://www.youtube.com/watch?v=44rDFE32) ") );
        $fields->addFieldToTab( 'Root.Main', LiteralField::create('Image','<img src="'.$this->ChannelImage()->Link().'" />') );
        $fields->addFieldToTab( 'Root.Main', ReadonlyField::create('ChannelTitle','Channel Name') );
        $fields->addFieldToTab( 'Root.Main', ReadonlyField::create('Title','Title') );
        $fields->addFieldToTab( 'Root.Main', ReadonlyField::create('Description','Description') );
        $fields->addFieldToTab( 'Root.Main', LiteralField::create('Image','<img src="'.$this->VideoImage()->Link().'" />') );
        $fields->addFieldToTab( 'Root.Main', ReadonlyField::create('Thumbnail','Thumbnail') );
        $fields->addFieldToTab( 'Root.Main', ReadonlyField::create('PublishDate','PublishDate') );
        $fields->removeByName('VideoImage');
        $fields->removeByName('ChannelImage');
        $fields->removeByName('ChannelThumbnail');
        
        return $fields; 
    }
    
    public function onBeforeWrite() {
        parent::onBeforeWrite();
        //get the youtube video information
        $this->getChanges();
    }
    
    public function getChanges() {
        if ($this->VideoID) {
            //get the youtube data
            $video = new YoutubeData();
            $video->setYouTubeVideo($this->VideoID);
            $video->getData();
            
            //store it locally so we don't have to fetch it each time
            $this->Title = $video->getTitle();
            $this->Description = $video->getDescription();
            $this->Thumbnail = $video->getThumbnail();
            $this->PublishDate = $video->getPublishedAt();
            $this->ChannelTitle = $video->getChannelTitle();
            $this->ChannelThumbnail = $video->getChannelPhoto();
            //used clear if the user entered a video link
            $this->VideoID = $video->getVideoID();
            
            //get the remote image for video
            $videoImage = new RemoteImage($this->Title, $this->Thumbnail);
            $videoImage->setFolderName("youtube");
            $videoImage->getImage();
            
            //create the link
            $this->VideoImageID = $videoImage->makeImageAndLink();
            
            //get the remote image for channel
            $videoImage = new RemoteImage($this->ChannelTitle, $this->ChannelThumbnail);
            $videoImage->setFolderName("youtubeChannelThumbnails");
            $videoImage->getImage();
            
            $this->ChannelImageID = $videoImage->makeImageAndLink();
            
        }
    }
    
    public function getBetterButtonsActions() {
        $fields = parent::getBetterButtonsActions();

        $fields->push(BetterButtonCustomAction::create('updateMe', 'Update'));

        return $fields;
    }
    
    public function updateMe() {
        $this->getChanges();
        $this->write();
        return "Update Completed and Changes Saved!";
    }
    
    private static $better_buttons_actions = array (
        'updateMe'
    );
    
}