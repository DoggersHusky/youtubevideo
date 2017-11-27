
<% loop $Data %>
    <h2><a href="$Top.Link()">$Top.Title</a> >> $Title</h2>


    <section>
        <!-- Content -->
        <div class="content videoPanel videoPanelFix">
            <section>
                <div class="videoInfo pageVideoFix">
                    <img src="{$ChannelImage.Fill(50,50).URL}" class="roundedImage"/>
                    <p>
                        $ChannelTitle
                    </p>
                </div>
                <iframe src="https://www.youtube.com/embed/{$VideoID}" frameborder="0" allowfullscreen width="100%" height="600px" ></iframe>
                <br/>
                <div class="fb-like" data-href="$Top.AbsoluteLink" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
                <br/>
                <div>
                    $Description
                </div>
                $Content
                <br/>
                <div class="fb-like" data-href="$AbsoluteLink" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
            </section>
        </div>
    </section>
<% end_loop %>
