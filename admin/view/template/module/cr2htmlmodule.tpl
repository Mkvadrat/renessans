<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <div id="tabs" class="htabs">
        <a href="#tab-0"><span><?php echo $entry_modules; ?></span></a>
        <a href="#tab-1"><span><?php echo $entry_area; ?> 1</span></a>
        <a href="#tab-2"><span><?php echo $entry_area; ?> 2</span></a>
        <a href="#tab-3"><span><?php echo $entry_area; ?> 3</span></a>
        <a href="#tab-4"><span>Pro Features</span></a>
    </div>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    <div id="tab-0" style="clear: both;">

      <table id="module" class="list">
        <thead>
          <tr>
            <td class="left"><?php echo $entry_area_id; ?></td>
            <td class="left"><?php echo $entry_classname; ?></td>
            <td class="left"><?php echo $entry_layout; ?></td>
            <td class="left"><?php echo $entry_position; ?></td>
            <td class="left"><?php echo $entry_status; ?></td>
            <td class="right"><?php echo $entry_sort_order; ?></td>
            <td></td>
          </tr>
        </thead>
        <?php $module_row = 0; ?>
        <?php foreach ($modules as $module) { ?>
        <tbody id="module-row<?php echo $module_row; ?>">
          <tr>
            <td class="left">
              <select name="cr2htmlmodule_module[<?php echo $module_row; ?>][area_id]">
              <?php for ($i=1; $i<=3; $i++) { ?>
               <option value="area<?php echo $i; ?>" <?php if ($module['area_id']=="area".$i) {echo "selected=\"selected\"";}; ?>>Area <?php echo $i; ?></option>
              <?php }; ?>
              </select></td>
            <td class="left">
              <input type="text" name="cr2htmlmodule_module[<?php echo $module_row; ?>][classname]" value="<?php echo $module['classname']; ?>" size="15" />
            </td>

            <td class="left"><select name="cr2htmlmodule_module[<?php echo $module_row; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            <td class="left"><select name="cr2htmlmodule_module[<?php echo $module_row; ?>][position]">
                <?php $positions = array("content_top"=>"$text_content_top","content_bottom"=>"$text_content_bottom","column_left"=>"$text_column_left","column_right"=>"$text_column_right");
                foreach($positions as $poid=>$polabel){ ?>
                    <option value="<?php echo $poid; ?>" <?php echo ($poid==$module['position']?"selected=\"selected\"":""); ?>><?php echo $polabel; ?></option>
                <?php };//foreach ?>
              </select>
            </td>
            <td class="left"><select name="cr2htmlmodule_module[<?php echo $module_row; ?>][status]">
                <option value="1" <?php echo ($module['status']==1?"selected=\"selected\"":""); ?>><?php echo $text_enabled; ?></option>
                <option value="0" <?php echo ($module['status']==0?"selected=\"selected\"":""); ?>><?php echo $text_disabled; ?></option>
              </select></td>
            <td class="right"><input type="text" name="cr2htmlmodule_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
            <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
          </tr>
        </tbody>
        <?php $module_row++; ?>
        <?php } ?>
        <tfoot>
          <tr>
            <td colspan="6"></td>
            <td class="left"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
          </tr>
        </tfoot>
      </table>

    </div>
    <div id="tab-1" style="clear: both;">
      <table class="form">
	<tr>
	<td><?php echo $entry_title; ?></td>
	  <td>
	  <?php foreach ($languages as $language) { ?>
	    <input type="text" name="cr2htmlmodule_title1_<?php echo $language['language_id']; ?>" id="cr2htmlmodule_title1_<?php echo $language['language_id']; ?>" size="30" value="<?php echo ${'cr2htmlmodule_title1_' . $language['language_id']}; ?>" />
	    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
       <?php } ?>
       </td>
	</tr>
	<tr>
	  <td><?php echo $entry_header; ?></td>
	  <td>
	    <?php
		if($cr2htmlmodule_header1) {
		   $checked1 = ' checked="checked"';
		   $checked0 = '';
		}else{
		   $checked1 = '';
		   $checked0 = ' checked="checked"';
	    } ?>
		<label for="cr2htmlmodule_header1_1"><?php echo $entry_yes; ?></label>
		<input type="radio"<?php echo $checked1; ?> id="cr2htmlmodule_header1_1" name="cr2htmlmodule_header1" value="1" />
		<label for="cr2htmlmodule_header1_0"><?php echo $entry_no; ?></label>
		<input type="radio"<?php echo $checked0; ?> id="cr2htmlmodule_header1_0" name="cr2htmlmodule_header1" value="0" />
	  </td>
	</tr>

	<tr>
	  <td><?php echo $entry_borderless; ?></td>
	  <td>
	    <select name="cr2htmlmodule_borderless1">
              <option value="1" <?php echo ($cr2htmlmodule_borderless1==1?"selected=\"selected\"":""); ?>><?php echo $entry_borderless1; ?></option>
              <option value="2" <?php echo ($cr2htmlmodule_borderless1==2?"selected=\"selected\"":""); ?>><?php echo $entry_borderless2; ?></option>
              <option value="3" <?php echo ($cr2htmlmodule_borderless1==3?"selected=\"selected\"":""); ?>><?php echo $entry_borderless3; ?></option>
         </select>
         <span class="help"><?php echo $entry_borderlesswarn; ?></span>
	  </td>
	</tr>

     <tr>
	  <td><?php echo $entry_code; ?></td>
          <td>
          <div id="html-lang-tabs-1" class="htabs">
               <?php foreach ($languages as $language) { ?>
                    <a href="#htmlmod1-lang<?php echo $language['language_id']; ?>"><span><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /></span></a>
               <?php } ?>
          </div><!--tabs-->
          <?php foreach ($languages as $language) { ?>
          <div id="htmlmod1-lang<?php echo $language['language_id']; ?>" style="clear: both;">
               <textarea name="cr2htmlmodule_code1_<?php echo $language['language_id']; ?>" cols="40" rows="10"><?php echo isset(${'cr2htmlmodule_code1_'.$language['language_id']}) ? ${'cr2htmlmodule_code1_'.$language['language_id']} : ''; ?></textarea>
               <div style="clear: both;">&nbsp;</div>
          </div>
          <?php } ?>
          </td>
      </tr>
      </table>

     </div><!--area1-->
    <div id="tab-2" style="clear: both;">
      <table class="form">
	<tr>
	<td><?php echo $entry_title; ?></td>
	  <td>
	  <?php foreach ($languages as $language) { ?>
	    <input type="text" name="cr2htmlmodule_title2_<?php echo $language['language_id']; ?>" id="cr2htmlmodule_title2_<?php echo $language['language_id']; ?>" size="30" value="<?php echo ${'cr2htmlmodule_title2_' . $language['language_id']}; ?>" />
	    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
       <?php } ?>
       </td>
	</tr>

	<tr>
	  <td><?php echo $entry_header; ?></td>
	  <td>
	    <?php
		if($cr2htmlmodule_header2) {
		   $checked1 = ' checked="checked"';
		   $checked0 = '';
		}else{
		   $checked1 = '';
		   $checked0 = ' checked="checked"';
	    } ?>
		<label for="cr2htmlmodule_header2_1"><?php echo $entry_yes; ?></label>
		<input type="radio"<?php echo $checked1; ?> id="cr2htmlmodule_header2_1" name="cr2htmlmodule_header2" value="1" />
		<label for="cr2htmlmodule_header2_0"><?php echo $entry_no; ?></label>
		<input type="radio"<?php echo $checked0; ?> id="cr2htmlmodule_header2_0" name="cr2htmlmodule_header2" value="0" />
	  </td>
	</tr>

	<tr>
	  <td><?php echo $entry_borderless; ?></td>
	  <td>
	    <select name="cr2htmlmodule_borderless2">
              <option value="1" <?php echo ($cr2htmlmodule_borderless2==1?"selected=\"selected\"":""); ?>><?php echo $entry_borderless1; ?></option>
              <option value="2" <?php echo ($cr2htmlmodule_borderless2==2?"selected=\"selected\"":""); ?>><?php echo $entry_borderless2; ?></option>
              <option value="3" <?php echo ($cr2htmlmodule_borderless2==3?"selected=\"selected\"":""); ?>><?php echo $entry_borderless3; ?></option>
         </select>
         <span class="help"><?php echo $entry_borderlesswarn; ?></span>
	  </td>
	</tr>

     <tr>
	  <td><?php echo $entry_code; ?></td>
          <td>
          <div id="html-lang-tabs-2" class="htabs">
               <?php foreach ($languages as $language) { ?>
                    <a href="#htmlmod2-lang<?php echo $language['language_id']; ?>"><span><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /></span></a>
               <?php } ?>
          </div><!--tabs-->
          <?php foreach ($languages as $language) { ?>
          <div id="htmlmod2-lang<?php echo $language['language_id']; ?>" style="clear: both;">
               <textarea name="cr2htmlmodule_code2_<?php echo $language['language_id']; ?>" cols="40" rows="10"><?php echo isset(${'cr2htmlmodule_code2_'.$language['language_id']}) ? ${'cr2htmlmodule_code2_'.$language['language_id']} : ''; ?></textarea>
               <div style="clear: both;">&nbsp;</div>
          </div>
          <?php } ?>
          </td>
      </tr>
      </table>
    </div><!--area2-->
    <div id="tab-3" style="clear: both;">
      <table class="form">
	<tr>
	<td><?php echo $entry_title; ?></td>
	  <td>
	  <?php foreach ($languages as $language) { ?>
	    <input type="text" name="cr2htmlmodule_title3_<?php echo $language['language_id']; ?>" id="cr2htmlmodule_title3_<?php echo $language['language_id']; ?>" size="30" value="<?php echo ${'cr2htmlmodule_title3_' . $language['language_id']}; ?>" />
	    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
       <?php } ?>
       </td>
	</tr>
	<tr>
	  <td><?php echo $entry_header; ?></td>
	  <td>
	    <?php
		if($cr2htmlmodule_header3) {
		   $checked1 = ' checked="checked"';
		   $checked0 = '';
		}else{
		   $checked1 = '';
		   $checked0 = ' checked="checked"';
	    } ?>
		<label for="cr2htmlmodule_header3_1"><?php echo $entry_yes; ?></label>
		<input type="radio"<?php echo $checked1; ?> id="cr2htmlmodule_header3_1" name="cr2htmlmodule_header3" value="1" />
		<label for="cr2htmlmodule_header3_0"><?php echo $entry_no; ?></label>
		<input type="radio"<?php echo $checked0; ?> id="cr2htmlmodule_header3_0" name="cr2htmlmodule_header3" value="0" />
	  </td>
	</tr>

	<tr>
	  <td><?php echo $entry_borderless; ?></td>
	  <td>
	    <select name="cr2htmlmodule_borderless3">
              <option value="1" <?php echo ($cr2htmlmodule_borderless3==1?"selected=\"selected\"":""); ?>><?php echo $entry_borderless1; ?></option>
              <option value="2" <?php echo ($cr2htmlmodule_borderless3==2?"selected=\"selected\"":""); ?>><?php echo $entry_borderless2; ?></option>
              <option value="3" <?php echo ($cr2htmlmodule_borderless3==3?"selected=\"selected\"":""); ?>><?php echo $entry_borderless3; ?></option>
         </select>
		<span class="help"><?php echo $entry_borderlesswarn; ?></span>
	  </td>
	</tr>


     <tr>
	  <td><?php echo $entry_code; ?></td>
          <td>
          <div id="html-lang-tabs-3" class="htabs">
               <?php foreach ($languages as $language) { ?>
                    <a href="#htmlmod3-lang<?php echo $language['language_id']; ?>"><span><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /></span></a>
               <?php } ?>
          </div><!--tabs-->
          <?php foreach ($languages as $language) { ?>
          <div id="htmlmod3-lang<?php echo $language['language_id']; ?>" style="clear: both;">
               <textarea name="cr2htmlmodule_code3_<?php echo $language['language_id']; ?>" cols="40" rows="10"><?php echo isset(${'cr2htmlmodule_code3_'.$language['language_id']}) ? ${'cr2htmlmodule_code3_'.$language['language_id']} : ''; ?></textarea>
               <div style="clear: both;">&nbsp;</div>
          </div>
          <?php } ?>
          </td>
      </tr>
      </table>
    </div><!--area3-->
    <div id="tab-4" style="clear: both; font-size: 1.2em;">
    <b>CR2 HTML Module Pro might be a better choice for you if:</b><br />
    <ul>
         <li>you need more HTML Areas</li>
         <li>you want to add custom CSS code along with the module (to style either the custom HTML or some other store item)</li>
         <li>you want to add a custom message on the store and need a predefined coloured box style for it</li>
    </ul><br />
    PRO Features:
    <ul>
         <li>support for 10! (7 more than the free version) different html areas (all these 10 areas can be displayed multiple times throughout the shop)</li>
         <li>support for custom css code output (to customly style the html module, or anything else for that matter, without editing the theme files) with language markup</li>
         <li>predefined colour-styled boxes (dark, blue, red, green and yellow) useful for quickly displaying various messages throughout the shop</li>
    </ul>
    <b><a href="http://demos.cryoutcreations.eu/opencart/modules/" target="_blank">View the demo</a>,
    check out the <a href="http://www.cryoutcreations.eu/html-module/" target="_blank">feature comparison chart</a>,
    or <a href="http://www.opencart.com/index.php?route=extension/extension/info&extension_id=2401" target="_blank">get the PRO version</a>.</b>
    <br /><br /><br /><br />
    </div><!--area4-->
     </form>
    </div>

	<div style="text-align:center; color:#666666;">
		CR2 HTML Module v<?php echo $cr2htmlmodule_version; ?> - <a href="http://www.cryoutcreations.eu/html-module/" target="_blank">Support</a>
	</div>
</div>
</div>
<?php echo $footer; ?>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('cr2htmlmodule_code1_<?php echo $language['language_id']; ?>', {
     filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	customConfig: '',
	startupMode: 'source'
});
CKEDITOR.replace('cr2htmlmodule_code2_<?php echo $language['language_id']; ?>', {
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	customConfig: '',
	startupMode: 'source'
});
CKEDITOR.replace('cr2htmlmodule_code3_<?php echo $language['language_id']; ?>', {
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	customConfig: '',
	startupMode: 'source'
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="cr2htmlmodule_module[' + module_row + '][area_id]" > <?php for ($i=1; $i<=3; $i++) { ?><option value="area<?php echo $i;?>">Area <?php echo $i; ?></option><?php }; ?> </td>';
	html += '    <td class="left"><input type="text" name="cr2htmlmodule_module[' + module_row + '][classname]" value="" size="15" /></td>';
	html += '    <td class="left"><select name="cr2htmlmodule_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo htmlspecialchars($layout['name'],ENT_QUOTES,"UTF-8"); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="cr2htmlmodule_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="cr2htmlmodule_module[' + module_row + '][status]">';
     html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
     html += '      <option value="0"><?php echo $text_disabled; ?></option>';
     html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="cr2htmlmodule_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';

	$('#module tfoot').before(html);

	module_row++;
}
//--></script>
<script type="text/javascript"><!--
$(function() { $('#tabs a').tabs();  <?php for ($i=1;$i<=3;$i++) { echo "$('#html-lang-tabs-$i a').tabs(); "; }; ?> });
//--></script>
<script type="text/javascript"><!--
function image_upload(field, preview) {
	$('#dialog').remove();

	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

	$('#dialog').dialog({
		title: 'Image Manager',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>',
					type: 'POST',
					data: 'image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + preview).replaceWith('<img src="' + data + '" alt="" id="' + preview + '" class="image" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');
					}
				});
			}
		},
		bgiframe: false,
		width: 700,
		height: 400,
		resizable: false,
		modal: false
	});
};
<?php echo $footer; ?>