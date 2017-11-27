Youtube Video
=================
Adds a new page type called YoutubeVideoPage. This page will allow the Admin to quickly add their Youtube videos to their site. 

## Maintainer Contact
* Buckles

## Requirements
* SilverStripe CMS 3.1.x 


## Installation
* Run composer require buckleshusky/YoutubeVideo dev-master in the project folder
* Run dev/build?flush=all to regenerate the manifest


## Usage
Create a new YoutubeVideoPage and give it a name. Click on the Youtube tab, and click add Youtube Video. Enter the VideoID or, simply, enter the URL. If you decide to enter a URL, the system will automatically get the VideoID out of the entered url.


#### Configuration Options
You will need to add your google api key to your config.yml
"https://developers.google.com/youtube/v3/getting-started"

```yml
BucklesHusky\YoutubeVideo\Objects\YoutubeData:
    Api:  #Api key required
```