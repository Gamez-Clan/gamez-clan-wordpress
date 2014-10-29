<?php
/**
 * @package        Joomla.Administrator
 * @subpackage     com_modules
 * @copyright      Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */


?>
<!-- Begin RokGallery MetaBox -->
<script type="text/javascript">
    window.addEvent('domready', function () {
        new Tips(".rok-tips", {title:"data-tips"});
    });
    jQuery(document).ready(function ($) {
        $("#rok-tabs").tabs();
    });
</script>
<div class="page-header">
    <div id="icon-roksprocket" class="icon32"></div>
    <h2>RokSprocket Widget Settings</h2>
    <?php echo RokCommon_Composite::get($that->context)->load('toolbar.php', array('that' => $that->toolbar, 'data_id' => $that->data->id, 'site_url' => $that->siteURL));?>
</div>
<div style="clear:both;"></div>

<div class="page-body">
<div id="system-message-container" class="sprocket-messages">
	<div id="message"></div>
</div>

<form autocomplete="off" action="<?php echo $this->base_url; ?>"
	  method="post" name="adminForm" id="module-form" class="form-validate">

	<div id="details">
		<?php echo $that->form->getInput('id'); ?>
		<?php echo $that->form->getInput('uuid'); ?>
		<ul>
			<li>
				<?php echo $that->form->getLabel('title'); ?>
				<?php echo $that->form->getInput('title'); ?>
			</li>
			<?php if ($that->data->id > 0) : ?>
			<li class="details">
				<label class="sprocket-tip" data-original-title="<?php echo rc__('ROKSPROCKET_SHORTCODE_DESC'); ?>"><?php echo rc__('ROKSPROCKET_SHORTCODE_LABEL'); ?></label>
				<div class="shortcode">
					[roksprocket id="<?php echo $that->data->id; ?>"]
				</div>
				<a class="copy-to-clipboard sprocket-tip" data-original-title="Copy to Clipboard" data-placement="above" href="#"><i class="icon tool clipboard"></i></a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
	<div id="tabs-container">
		<div class="roksprocket-version">RokSprocket <span>v<?php echo str_replace("\2.1.2", "DEV", ROKSPROCKET_VERSION); ?></span></div>
		<?php if ($that->data->id > 0): ?>
		<ul class="tabs">
			<li class="badge">
				<?php
					$provider = $that->container['roksprocket.providers.registered.'.$that->provider];
					$layout   = $that->container['roksprocket.layouts.'.$that->layout];
				?>
				<ul>
					<li ><i class="icon provider provider_<?php echo $that->provider;?> <?php echo $that->provider;?>"></i> <span><?php echo $provider->displayname;?> Provider</span></li>
					<li><i class="icon layout layout_<?php echo $that->layout;?> <?php echo $that->layout;?>"></i> <span><?php echo $layout->displayname?> Layout</span></li>
				</ul>
			</li>
		</ul>
		<?php endif; ?>
		<div class="panels">
			<div data-panel="options" class="panel options active">
				<?php if ($that->data->id > 0): ?>
				<?php echo RokCommon_Composite::get($that->context)->load('edit_roksprocket.php', array('that'=>$that)); ?>
				<?php else: ?>
				<?php echo RokCommon_Composite::get($that->context)->load('edit_roksprocket_new.php', array('that'=>$that)); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
    <input name="task" type="hidden" value="" id="task">
</form>

</div>
<div style="clear:both;"></div>
