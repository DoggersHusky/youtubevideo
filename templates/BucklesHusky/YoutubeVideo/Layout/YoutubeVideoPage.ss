
<span class="fa-youtube-play"></span>
<h2>$Title</h2>

$Content
<br/>

<% if YoutubeVideo %>
    <% loop $YoutubeVideo %>
        <div class="videoPanel">
            <section>
                <span class="fa-play"></span>
                <% if $VideoImage %>
                    <a href="$Link" class="button" style="display: inline-flex; padding: 0px;">$VideoImage.CroppedImage(300,125)</a>
                <% else %>
                    <div style="height:300px; width:125px;">
                    </div>
                <% end_if %>
                <header>
                    <h3>$Title</h3>
                </header>
                <div class="videoInfo">
                    <img src="$Link" class="roundedImage"/>
                    <p>
                        $ChannelTitle
                    </p>
                </div>
                <div class="clearBoth"></div>
                <p>$Description.LimitCharacters(100)</p>
            </section>
        </div>                        
    <% end_loop %>
<% end_if %>