<?php
/**
* @package   Widgetkit
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// set attributes
$attributes = array();
$attributes['type']  = 'text';
$attributes['name']  = $name;
$attributes['class'] = 'html';
$attributes['style'] = 'width:100%;min-height:150px;';
$attributes['id']    = $id = isset($attributes['id']) ? $attributes['id'] : 'html-'.uniqid();

?>

<div id="editor-<?php echo $id;?>" class="html-editor">

	<?php if($this["system"]->use_old_editor):?>
		
			<?php printf('<textarea %s>%s</textarea>', $this['field']->attributes($attributes, array('label', 'description', 'default')), $value); ?>

	<?php else: ?>
	
		<?php
            wp_editor($value, $id, array(
                'wpautop' => false,
                'media_buttons' => true,
                'textarea_name' => $name,
                'textarea_rows' => 10,
                'editor_class' => "horizontal",
                'teeny' => false,
                'dfw' => false,
                'tinymce' => true,
                'quicktags' => true
            ));
        ?>

        <script>

        	jQuery(function($){
			
				if(!window["tinyMCE"]) return;
			
        		var tinyParams = {},
        			editor_id  = "<?php echo $id;?>",
        			editor     = $("#editor-"+editor_id);


				if (editor.data("tinyfied")) {
					return;
				}

                if (tinyMCEPreInit.mceInit[editor_id]) {
                	tinyParams = tinyMCEPreInit.mceInit[editor_id];
                } else {
                	for (var settings in tinyMCEPreInit.mceInit) {
                		tinyParams = tinyMCEPreInit.mceInit[settings];
                		break;
                	}
                }

                tinyParams.mode = "exact";
                tinyParams.elements = editor_id;

                quicktags({
                    id: editor_id,
                    buttons: "",
                    disabled_buttons: ""
                });
                QTags._buttonsInit();
                jQuery('#wp-' + editor_id + '-wrap').removeClass('html-active').addClass('tmce-active');

                tinyMCE.init(tinyParams);

                tb_init(jQuery('#editor-' + editor_id + ' .horizontal-slide-media a.thickbox'));
                tb_init(jQuery('#editor-' + editor_id + ' .vertical-slide-media a.thickbox'));

                editor.find('.media-buttons a.thickbox').unbind('click').bind('click', function(){
            		if (typeof tinyMCE != 'undefined' && tinyMCE.activeEditor) {
			            var url = jQuery(e).attr('href');
			            url = url.split('editor=');
			            if (url.length>1) {
			                url = url[1];
			                url = url.split('&');
			                if (url.length>1) {
			                    editorid = url[0];
			                }
			            }
			            tinyMCE.get(editor_id).focus();
			            tinyMCE.activeEditor.windowManager.bookmark = tinyMCE.activeEditor.selection.getBookmark('simple');
			            jQuery(window).resize();
			        }
        		});

        		editor.bind("editor-action-start", function(){
					
					tinyMCE.execCommand('mceRemoveControl', false, editor_id);
					
				}).bind("editor-action-stop", function(){

					if (jQuery('#wp-' + editor_id + '-wrap').hasClass('tmce-active')) {
						tinyMCE.execCommand('mceAddControl', true, editor_id);
					}
					
				}).data("tinyfied", true);

				//save in html mode fix
				var textarea = editor.find("textarea:first");

				textarea.bind("blur", function(){
					var ed = tinyMCE.get(editor_id);

					if (ed) {
						ed.setContent($(this).val());
					}
				});

				if (editor.find('.quicktags-toolbar').length>1) {
	            	editor.find('.quicktags-toolbar:first').remove();
	            }
        	});
        </script>

	<?php endif; ?>
</div>