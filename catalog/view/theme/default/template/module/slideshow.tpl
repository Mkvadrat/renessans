<div class="container">
<div class="slider">
                    <div class="fluid_container">
                        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1<?php echo $module; ?>">   
						<?php foreach ($banners as $banner) { ?>
						<?php if ($banner['link']) { ?>
                            <div data-src="<?php echo $banner['image']; ?>" data-link="<?php echo $banner['link']; ?>">
                                <div class="camera_caption moveFromBottom">
                                    <?php echo $banner['descr']; ?>
								</div>
							</div>
						<?php } else { ?>
						    <div data-src="<?php echo $banner['image']; ?>">
                                <div class="camera_caption moveFromBottom">
                                    <?php echo $banner['descr']; ?>
								</div>
							</div>
						<?php } ?>
						<?php } ?>
						</div><!-- #camera_wrap_1 -->
					</div><!-- .fluid_container -->
				</div>

</div>

<script>
    jQuery(function(){
        jQuery('#camera_wrap_1<?php echo $module; ?>').camera({
            height: '<?php echo $height; ?>px',
			width: '<?php echo $width; ?>px',
            playPause: false,
            navigationHover: false,
            hover: true,
			time: 1200,
            thumbnails: false,
            loaderOpacity: 0.7,
            loaderBgColor: '#fff',
            loaderColor: '#30d5c8',
        });
    });
</script>
	