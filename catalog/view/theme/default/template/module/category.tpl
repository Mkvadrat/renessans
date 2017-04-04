<!--<?php if ($position == 'content_top'  or $position == 'content_bottom') { ?>

<?php } else { ?>
<div class="box">
    <div class="box-content">
        <div class="box-category">
            <ul>
                <?php foreach ($categories as $category) { ?>
                <li>
                    <?php if ($category['category_id'] == $category_id) { ?>
                    <a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $category['href']; ?>" class="no-active"><?php echo $category['name']; ?></a>
                    <?php } ?>
                    <?php if ($category['children']) { ?>
                    <ul>
                        <?php foreach ($category['children'] as $child) { ?>
                        <li>
                            <?php if ($child['category_id'] == $child_id) { ?>
                            <a href="<?php echo $child['href']; ?>" class="child-active">
                                - <?php echo $child['name']; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $child['href']; ?>"> - <?php echo $child['name']; ?></a>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<?php } ?>-->

<div class="content">
	<div class="container">
		<div class="block-3">
                        <h2>Районы</h2>
						 <?php foreach($category_area as $area){ ?>
                        <a href="<?php echo $category_area_path . $area["category_id"]; ?>"><div class="block-3-1">
                            <?php if($area["image"]){ ?><img src="<?php echo HTTP_IMAGE . '/' . $area["image"]; ?>" alt="" /><?php }else{?><img src="/catalog/view/theme/default/img/nophoto_area.png" alt="Нет изображения"/>
							<?php } ?>
                            <div class="block-3-1-bot"><?php echo $area["name"]; ?></div>
						</div></a>
						 <?php } ?>
		</div>
	</div>
</div>






