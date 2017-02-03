<!-- Кнопка додати + 3 кнопки коментарів -->

<div class="add_com"> Додати/Подивитись коментар</div>
<div style='display: none;' class='group_social'>
    <div style='display: none; padding: 6px 15px;' class="add_com_vk">Вконтакт</div>
    <div style='display: none;' class="add_com_fb">Фейсбук</div>
    <div style='display: none;' class="add_com_site">На сайті</div>
</div>

<!-- Скрипт для вкладок коментарів -->
<script type="text/javascript">
    (function($) {
        $(document).ready(function(){
            function del_fyn(){
                $('#vk_comments').show(10, function(){
                    $('.add_com').hide(100);
                    $('.group_social').show(100);
                    $('.add_com_vk').show(100);
                    $('.add_com_vk').css({"border-top":"2px solid #53af3a", "border-right":"2px solid #53af3a", "border-left":"2px solid #53af3a","border-bottom":"2px solid white","background-color":"white","color":"#444444","padding":"6px 15px","display":"inline-block"});
                    $('.add_com_fb').show(100);
                    $('.add_com_site').show(100);
                    $('.add_com_fb').css('display', 'inline-block');
                    $('.add_com_site').css('display', 'inline-block');
                });
            }
            function del_fyn_vs(){
                $('#vk_comments, #comments').hide(100, function(){
                    $('.fb-comments').show();
                    $('.fb-comments').css('display', 'inline-block');
                    $('.add_com_vk,.add_com_site').css({"border-top":"none", "border-right":"none", "border-left":"none","border-bottom":"none","background-color":"#53af3a","color":"#ffffff","padding":"8px 17px"});
                    $('.add_com_fb').css({"border-top":"2px solid #53af3a", "border-right":"2px solid #53af3a", "border-left":"2px solid #53af3a","border-bottom":"2px solid white","background-color":"white","color":"#444444","padding":"6px 15px"});
                });
            }
            function del_fyn_fs(){
                $('.fb-comments, #comments').hide(100, function(){
                    $('#vk_comments').show();
                    $('.add_com_fb,.add_com_site').css({"border-top":"none", "border-right":"none", "border-left":"none","border-bottom":"none","background-color":"#53af3a","color":"#ffffff","padding":"8px 17px"});
                    $('.add_com_vk').css({"border-top":"2px solid #53af3a", "border-right":"2px solid #53af3a", "border-left":"2px solid #53af3a","border-bottom":"2px solid white","background-color":"white","color":"#444444","padding":"6px 15px"});
                });
            }
            function del_fyn_fv(){
                $('.fb-comments,#vk_comments').hide(100, function(){
                    $('#comments').show();
                    $('.add_com_vk,.add_com_fb').css({"border-top":"none", "border-right":"none", "border-left":"none","border-bottom":"none","background-color":"#53af3a","color":"#ffffff","padding":"8px 17px"});
                    $('.add_com_site').css({"border-top":"2px solid #53af3a", "border-right":"2px solid #53af3a", "border-left":"2px solid #53af3a","border-bottom":"2px solid white","background-color":"white","color":"#444444","padding":"6px 15px"});
                });
            }
            $('.add_com').bind('click', del_fyn);
            $('.add_com_fb').bind('click', del_fyn_vs);
            $('.add_com_vk').bind('click', del_fyn_fs);
            $('.add_com_site').bind('click', del_fyn_fv);
            var srcc = $('.field-name-field-anpic img').attr('src');
            var doc_w = $(window).width();
            var doc_h = $(window).height();
            $('.node-article .field-name-body a[href$=".jpg"],.node-article .field-name-body a[href$=".png"]').attr('rel', 'gallery').colorbox({
                height: doc_h
            });
            $('#comments .item-list-pager').css('display','none');
        });
    })(jQuery);
</script>

<section id="comments" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php if ($content['comments'] && $node->type != 'forum'): ?>
    <?php print render($title_prefix); ?>
   <!-- <h2 class="title">      <?php print format_plural($node->comment_count, '1 Коментар', '@count Коментарів'); ?>    </h2> -->
    <?php print render($title_suffix); ?>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

  <?php if ($content['comment_form']): ?>
	<h2 class="title comment-form"><?php print t('Додати новий коментар'); ?></h2>
	<?php print render($content['comment_form']); ?> 
  <?php endif; ?>

</section>

<!-- коментарі Вконтакті -->
<script type="text/javascript">
    VK.init({apiId: 4991364, onlyWidgets: true});
</script>
<div  style='display: none; margin: 35px auto 0; ' id="vk_comments"></div>
<script type="text/javascript">
    VK.Widgets.Comments("vk_comments", {limit: 10, width: "700", attach: "*"});
</script>

<!-- коментарі Фейсбук -->
<div style='display: none; margin: 35px auto 0; text-align: center; width: 100%;' class="fb-comments" data-href="poesie.pp.ua/<?php print request_uri(); ?>" data-numposts="7" data-width="700" data-colorscheme="light"></div>

