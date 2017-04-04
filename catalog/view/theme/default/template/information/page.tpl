<?php echo $header; ?>
<?php echo $content_top; ?>
    <div class="content">
        <div class="conteiner article-container">
        <?php $description = str_replace('[[contact_form]]',$form,$description); ?>
        <?php echo str_replace('[[right_column]]',$right,$description); ?>
        </div>
    </div>
<?php echo $content_bottom; ?>
<?php echo $footer; ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('details p').hide();
        $('details details').hide();
        $('details summary').click(function(){
            if ($(this).parent('details').children('p').css('display')=='none') {
                $(this).parent('details').children('p').show();
            } else {
                $(this).parent('details').children('p').hide();
            }
            if ($(this).parent('details').children('details').css('display')=='none') {
                $(this).parent('details').children('details').show();
            } else {
                $(this).parent('details').children('details').hide();
            }
        });
    });
</script>