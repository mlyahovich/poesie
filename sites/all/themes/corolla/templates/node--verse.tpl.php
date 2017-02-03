<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js" async="async"></script>

<!-- vk like -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>

<!-- бібліотека для печенюшок-->
<script type="text/javascript" src="/themes/corolla/js/jquery.cookie.js"></script>

<!--лайки вконтакті-->
<script type="text/javascript">
    VK.init({apiId: 4991364, onlyWidgets: true});
</script>


<!-- скріпт для віджетів FB -->
<div id="fb-root"></div>
<script>

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v2.4&appId=1620784941529353";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

</script>

<script>
    /*
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1620784941529353',
            xfbml      : true,
            version    : 'v2.4'
        });
    };
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    */
</script>






<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <div class="node-inner">

        <?php print $unpublished; ?>

        <?php print render($title_prefix); ?>
        <?php if ($title || $display_submitted): ?>
            <header<?php print $header_attributes; ?>>

                <?php if ($title && !$page): ?>
                    <h1<?php print $title_attributes; ?>>
                        <a href="<?php print $node_url; ?>" rel="bookmark"><?php print $title; ?></a>
                    </h1>
                <?php endif; ?>

                <?php if ($display_submitted): ?>
                    <p class="submitted"><?php print $submitted; ?></p>
                <?php endif; ?>

            </header>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <div<?php print $content_attributes; ?>>
            <?php print $user_picture; ?>
            <?php
            hide($content['comments']);
            hide($content['links']);
            print render($content);
            ?>
        </div>

        <?php if ($links = render($content['links'])): ?>
            <!-- <nav<?php print $links_attributes; ?>><?php print $links; ?></nav> -->
        <?php endif; ?>
        <div class="addthis_button_nasa">
            <a class="addthis_button_vk"></a>
            <a class="addthis_button_facebook"></a>

            <!--Лайки вконтакте-->
            <div style="vertical-align: middle; line-height: 36px;" id="vk_like"></div>
            <script type="text/javascript">
                VK.Widgets.Like("vk_like", {type: "button", height: 24});
            </script>

            <!--Лайки фейсбук-->
            <div style="vertical-align: text-top;" class="fb-like" data-href="poesie.pp.ua/<?php print request_uri(); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
        </div>


        <?php print render($content['comments']); ?>



    </div>
<script>
    var hidecomment = document.getElementById('edit-comment-body-und-0-format');
    hidecomment.style.display = 'none';
</script>



</article>
