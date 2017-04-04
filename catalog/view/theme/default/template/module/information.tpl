<nav>
    <div class="container">
        <div class="menu-wrapper">
            <ul class="menu">
                <li><a style="padding-left:7px;" href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
                <?php foreach ($informations as $information) { ?>
                <li><a style="padding-left:7px;" href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                <?php } ?>
                <li><a style="padding-left:7px;" href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
                
               
            </ul>
        </div>
    </div>
</nav>
