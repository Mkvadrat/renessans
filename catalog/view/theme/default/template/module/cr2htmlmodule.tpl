<!-- cr2 html module v1.51 -->

<?php
switch($borderless){
     case 3: // no wrapping
          echo $code; break;
     case 2: // simple container div with class
          echo " \n $code \n<!--$classname-->"; break;
     case 1:
     default: // opencart default ?>
     <div class="box <?php echo $classname; ?>">
          <div class="box-heading" <?php if (!$title) {echo "style=\"height: 5px; background-image: none; border-bottom: none; padding: 0 !important;\""; }; ?>>
          	<?php if($title) { echo $title; } else { echo "&nbsp;"; } ?>
          </div>
          <div class="box-content" style="text-align: left;">
               <?php echo $code; ?>
          </div>
     </div>
<?php break;
};//switch
?>
    
    
