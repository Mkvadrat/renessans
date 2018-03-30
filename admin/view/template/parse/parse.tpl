<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($success) { ?>
		<?php foreach($success as $import) { ?>
			<div class="success"><?php echo $import; ?></div>
		<?php } ?>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_import; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<table class="form">
          <tbody>
					<tr>
						<td>
							<?php echo $text_sitemap; ?></label>
						</td>
						<td>
							<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
							<input name="userfile" type="file" />
							<input type="hidden" value="" name="sitemap" placeholder="<?php //echo $text_sitemap; ?>" />
						</td>
					</tr>
          </tbody>
        </table>
				
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>