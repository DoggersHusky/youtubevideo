<?php

namespace BucklesHusky\YoutubeVideo\Objects;

use SilverStripe\Core\Config\Config;

class YoutubeData {
    
    protected $VideoId;
    protected $Description;
    protected $Thumbnail;
    protected $Title;
    protected $key;
    protected $PublishedAt;
    protected $Channel;
    Protected $ChannelPhoto;


    /*
     * Set the youtube video
     */
    public function setYouTubeVideo($videoID) {
        //Get Config
        $config=Config::inst()->get(YoutubeData::class);
        //set the api key from config
        $this->setKey($config);
        
        $thisVideoID = $fileType = substr(strrchr($videoID, '='), 1);
        
        if ( $thisVideoID === false ) {
            $thisVideoID = $videoID;
        }
        //set the video
        $this->VideoId = $thisVideoID;
    }
    
    /*
     * set the api key
     */
    public function setKey($key) {
        $this->key  = $key;
    }
    
    /*
     * get the data and populate the information
     */
    public function getData() {
        $link =  "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".$this->VideoId."&key=".$this->key."&fields=items(id,snippet(channelId),snippet(title),snippet(description),snippet(publishedAt),snippet(thumbnails(high)))";
        
        
        //place to curl
        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($curl, CURLOPT_REFERER, "http://nana.land");
        $return = curl_exec($curl);
        $return = json_decode($return, true);
        curl_close($curl);
        
        //set the title
        $this->Title = $return['items'][0]['snippet']['title'];
        //set the description
        $this->Description = $return['items'][0]['snippet']['description'];
        //get the date published at
        $this->PublishedAt = $return['items'][0]['snippet']['publishedAt'];
        //set
        $this->Thumbnail = $return['items'][0]['snippet']['thumbnails']['high']['url'];
        
        //link to retrieve channel info
        $link = "https://www.googleapis.com/youtube/v3/channels?part=snippet&id=".$return['items'][0]['snippet']['channelId']."&key=AIzaSyAIX-C7t1wHDIQrncvz8aqOT6VMZA7cEVQ";
        
        //place to curl
        $curl = curl_init($link);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($curl, CURLOPT_REFERER, "http://nana.land");
        $return = curl_exec($curl);
        $return = json_decode($return, true);
        curl_close($curl);
        
        //set the channel info
        $this->Channel = $return['items'][0]['snippet']['title'];
        $this->ChannelPhoto = $return['items'][0]['snippet']['thumbnails']['high']['url'];
        
        return true;
    }
    
    /*
     * returns the title
     * @return string
     */
    public function getTitle() {
        return $this->Title;
    }
    
    /*
     * get the description
     * @return string
     */
    public function getDescription() {
        return $this->Description;
    }
    
    /*
     * get the PublishedAt
     * @return string
     */
    public function getPublishedAt() {
        return $this->PublishedAt;
    }
    
    /*
     * get the thumbnail
     * @return string
     */
    public function getThumbnail() {
        return $this->Thumbnail;
    }
    
    /*
     * get author
     */
    public function getChannelTitle() {
        return $this->Channel;
    }
    
    public function getChannelPhoto() {
        return $this->ChannelPhoto;
    }
    
    public function getVideoID() {
        return $this->VideoId;
    }
    
}