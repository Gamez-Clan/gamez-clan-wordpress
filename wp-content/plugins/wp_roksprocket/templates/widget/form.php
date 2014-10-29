<?php
/**
 * @version   $Id: form.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

//rs_load_class('RokSprocket_Forms_Fields_Widgetpicker');
$fieldSet      = $form->getFieldset('roksprocket_widget');
$hidden_fields = ''; ?>
<script type="text/javascript">
    window.addEvent('domready', function () {
        new Tips(".rok-tips", {title:"data-tips"});
    });
</script>
<!-- Begin RokSprocket Widget Admin -->

<div class="wrap" id="rs-content">
	<?php foreach ($fieldSet as $field) : ?>
		<?php if (!$field->hidden) : ?>
    <p>
        <label class="rok-tips" data-tips="<?php rc_e($field->description); ?>" for="<?php echo $field->id; ?>">
			<?php rc_e($form->getFieldAttribute($field->fieldname, 'label')); ?>
        </label>
		<?php echo $field->input; ?>
    </p>
		<?php else : $hidden_fields .= $field->input; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php echo $hidden_fields; ?>
</div>
<div style="clear:both;"></div>
<!-- End RokSprocket Widget Admin -->
