hallo


<?php
/**
* @package   yoo_master2
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>





</script>

<head>

<script src="<?php echo home_url(); ?>/js/jquery.js"></script>
<script src="<?php echo home_url(); ?>/js/uikit.min.js"></script>

<script src="<?php echo home_url(); ?>/wp-content/themes/yoo_master2_wp/warp/vendor/uikit/js/addons/cover.js"></script>
<script src="<?php echo home_url(); ?>/wp-content/themes/yoo_master2_wp/warp/vendor/uikit/js/addons/sticky.js"></script>
<script src="<?php echo home_url(); ?>/wp-content/themes/yoo_master2_wp/warp/vendor/uikit/js/addons/nestable.js"></script>


<?php echo $this['template']->render('head'); ?>


<link id="data-uikit-theme" rel="stylesheet" href="<?php echo home_url(); ?>/wp-content/themes/yoo_master2_wp/css/bbpress-custom.css">
<link id="data-uikit-theme" rel="stylesheet" href="<?php echo home_url(); ?>/wp-content/themes/yoo_master2
_wp/css/buddypress-custom.css">
<link id="data-uikit-theme" rel="stylesheet" href="<?php echo home_url(); ?>/wp-content/themes/yoo_master2
_wp/css/wpevents-custom.css">
<link id="data-uikit-theme" rel="stylesheet" href="<?php echo home_url(); ?>/wp-content/themes/yoo_master2
_wp/css/support-system-custom.css">
<link id="data-uikit-theme" rel="stylesheet" href="<?php echo home_url(); ?>/js/css/addons/uikit.almost-flat.addons.css">
<link id="data-uikit-theme" rel="stylesheet" href="<?php echo home_url(); ?>/wp-content/themes/yoo_master2
_wp/css/calender-custom.css">




</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">




<div class="uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-slide-bottom" data-uk-scrollspy="{cls:'uk-animation-slide-bottom', repeat: true}">
	


<div class="logobar">
	<?php if ($this['widgets']->count('logo-small')) : ?>
					<div class="uk-navbar-content uk-navbar-center uk-visible"><a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
					<?php endif; ?>
</div>

	
	
</div>






<div data-uk-sticky="{}">
	
		
		<?php if ($this['widgets']->count('menu + search')) : ?>
			<nav class="tm-navbar uk-navbar uk-container uk-container-center" >
		<?php if ($this['widgets']->count('menu')) : ?>
					<?php echo $this['widgets']->render(''); ?>
					<?php endif; ?>
					
		
					<?php if ($this['widgets']->count('offcanvas')) : ?>
					
					<a href="http://sill-web.de/gzc/" class="toggle-home"></a>
					
					<a href="#offcanvas" class="uk-navbar-toggle"data-uk-offcanvas></a>
					

					
					
					<h1 class="uk-article-title-menu"><?php the_title(); ?></h1>
					
					
					<?php endif; ?>
					
					
					
					
					
					
					
		<div class="uk-navbar-flip uk-visble-medium uk-visble-large uk-hidden-small nav-right">
	      <ul class="uk-navbar-nav">
	         <li>
	            <a class="blink" href="<?php echo home_url(); ?>/registrieren/"><i class="uk-icon-group"></i> Join Us!</a>
	         </li>

	         <li data-uk-dropdown="{mode:'hover'}" class="">
	            <a href="<?php echo home_url(); ?>/forum/"><i class="uk-icon-th-list"></i> Forum <i class="uk-icon-caret-down"></i></a>
	            <div class="uk-dropdown uk-dropdown-small">
	               <ul class="uk-nav uk-nav-dropdown">
	                  <li><a href="<?php echo home_url(); ?>/aktuelle-themen/"><i class="uk-icon-th-list"></i> Aktuelle themen</a> </li>
	               </ul>
	            </div>
	         </li>
	         <li>
	            <a href="<?php echo home_url(); ?>/dwqa-questions//"><i class="uk-icon-medkit"></i> Support</a>
	         </li>

	         <?php
	         	/* Kadaverkomplex: Show Link to 'Mein Profil' only for authenticated in users */
	         	if ( is_user_logged_in() ) {
	         ?> 
	         <li>
	            <a href="<?php global $current_user; echo home_url() . '/mitglieder/' . $current_user->user_login . ''; ?>"><i class="uk-icon-user"></i> Mein Profil</a>
	         </li>
	         <?php } ?>

	         <li>
	            <a class="blink" style="border-right:1px solid #333;" href="#ts" data-uk-offcanvas=""><i class="uk-icon-headphones"></i> Teamspeak Info</a>
	         </li>
	         
	         
	         <li>
	        <?php if ($this['widgets']->count('search')) : ?>
					<div  class="uk-navbar-flip">
						<div class="uk-navbar-content uk-hidden-small"><?php echo $this['widgets']->render('search'); ?></div>
					</div>
					<?php endif; ?>
	      
	         </li>
	         
	      </ul>
	      
	      
	      	
	      
	      
	   </div>
				




					
		
				
		
				
		
				</nav>
				<?php endif; ?>

		
		
	
		<nav class="uk-navbar tm-navbar uk-navbar uk-container uk-container-center info-nav uk-visible-small">
		   <div class="uk-navbar-flip">
		      <ul class="uk-navbar-nav">
		         <li data-uk-dropdown="{mode:'hover'}" class="">
		            <a href="<?php echo home_url(); ?>/forum/"><i class="uk-icon-th-list"></i> Forum <i class="uk-icon-caret-down"></i></a>
		            <div class="uk-dropdown uk-dropdown-small">
		               <ul class="uk-nav uk-nav-dropdown">
		                  <li><a href="<?php echo home_url(); ?>/aktuelle-themen/"><i class="uk-icon-th-list"></i> Aktuelle themen</a> </li>
		               </ul>
		            </div>
		         </li>
		         <li>
		            <a href="<?php echo home_url(); ?>/dwqa-questions//"><i class="uk-icon-medkit"></i></a>
		         </li>
	
		         <?php
		         	/* Kadaverkomplex: Show Link to 'Mein Profil' only for authenticated in users */
		         	if ( is_user_logged_in() ) {
		         ?> 
		         <li>
		            <a href="<?php global $current_user; echo home_url() . '/mitglieder/' . $current_user->user_login . ''; ?>"><i class="uk-icon-user"></i></a>
		         </li>
		         <?php } ?>
	
		         <li>
		            <a href="#ts" data-uk-offcanvas=""><i class="uk-icon-headphones"></i></a>
		         </li>
		      </ul>
		   </div>
		</nav>				
	
	
	
	</div>
		

	<div class="uk-container uk-container-center">

		<?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
		<div class="tm-toolbar uk-clearfix uk-hidden-small">

			<?php if ($this['widgets']->count('toolbar-l')) : ?>
			<div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
			<?php endif; ?>

			<?php if ($this['widgets']->count('toolbar-r')) : ?>
			<div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
			<?php endif; ?>

		</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('logo + headerbar')) : ?>
		<div class="tm-headerbar uk-clearfix uk-hidden-small">

			<?php if ($this['widgets']->count('logo')) : ?>
			<a class="tm-logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
			<?php endif; ?>

			<?php echo $this['widgets']->render('headerbar'); ?>
			
			

		</div>
		
		<?php endif; ?>
	
	
	</div>	

		
		
<div class="voll" id="">		



<?php if ($this['widgets']->count('top-a')) : ?>
<section class="<?php echo $grid_classes['top-a']; echo $display_classes['top-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?></section>
<?php endif; ?>



</div>

		


		<?php if ($this['widgets']->count('top-b')) : ?>
		
		
		<div class="voll-inset" id="">		

		<div class="uk-container-center uk-container" id="">
		
		<section class="<?php echo $grid_classes['top-b']; echo $display_classes['top-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>
		
		</div>
		</div>

		
		<?php endif; ?>
	




	<div class="uk-container uk-container-center">


		
		<?php if ($this['widgets']->count('top-c')) : ?>
		<section class="<?php echo $grid_classes['top-c']; echo $display_classes['top-c']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('top-c', array('layout'=>$this['config']->get('grid.top-c.layout'))); ?></section>
		<?php endif; ?>

		<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
		<div class="tm-middle uk-grid" data-uk-grid-match data-uk-grid-margin>

			<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
			<div class="<?php echo $columns['main']['class'] ?>">

				<?php if ($this['widgets']->count('main-top')) : ?>
				<section class="<?php echo $grid_classes['main-top']; echo $display_classes['main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
				<?php endif; ?>

				<?php if ($this['config']->get('system_output', true)) : ?>
				<main class="tm-content">

					<?php if ($this['widgets']->count('breadcrumbs')) : ?>
					<?php echo $this['widgets']->render('breadcrumbs'); ?>
					<?php endif; ?>

					<?php echo $this['template']->render('content'); ?>

				</main>
				<?php endif; ?>

				<?php if ($this['widgets']->count('main-bottom')) : ?>
				<section class="<?php echo $grid_classes['main-bottom']; echo $display_classes['main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
				<?php endif; ?>

			</div>
			<?php endif; ?>

            <?php foreach($columns as $name => &$column) : ?>
            <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
            <aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
            <?php endif ?>
            <?php endforeach ?>

		</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('bottom-a')) : ?>
		<section class="<?php echo $grid_classes['bottom-a']; echo $display_classes['bottom-a']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
		<?php endif; ?>

		<?php if ($this['widgets']->count('bottom-b')) : ?>
		<section class="<?php echo $grid_classes['bottom-b']; echo $display_classes['bottom-b']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
		<?php endif; ?>

		<?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
		<footer class="tm-footer">

			<?php if ($this['config']->get('totop_scroller', true)) : ?>
			<a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
			<?php endif; ?>

			<?php
				echo $this['widgets']->render('footer');
				$this->output('warp_branding');
				echo $this['widgets']->render('debug');
			?>
			

		</footer>
		<?php endif; ?>

	</div>

	<?php echo $this->render('footer'); ?>

	<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
	<?php endif; ?>
	

<div id="ts" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
    
<div class="uk-grid">
        <div class="uk-width-medium-1-1">
            <div class="uk-panel">
                
                <h3 class="uk-panel-title">Teamspeak Info</h3>
                Teamspeak Server Daten:<br />
                IP: ts.gamez-clan.de<br />
                Das Passwort ist: raw<br />
            </div>
        </div>
        <div class="uk-width-medium-1-1">
            <div class="uk-panel">
               
                <h3 class="uk-panel-title">Teamspeak Server</h3>

								<div id="ts3viewer_1022378"> </div>
								<script src="http://static.tsviewer.com/short_expire/js/ts3viewer_loader.js" type="text/javascript"></script>
								<script type="text/javascript">// <![CDATA[
								function initTs() {
								var ts3v_url_1 = "http://www.tsviewer.com/ts3viewer.php?ID=1022378&text=888888&text_size=9&text_family=4&js=1&text_s_weight=bold&text_s_style=normal&text_s_variant=normal&text_s_decoration=none&text_s_color_h=525284&text_s_weight_h=bold&text_s_style_h=normal&text_s_variant_h=normal&text_s_decoration_h=underline&text_i_weight=normal&text_i_style=normal&text_i_variant=normal&text_i_decoration=none&text_i_color_h=525284&text_i_weight_h=normal&text_i_style_h=normal&text_i_variant_h=normal&text_i_decoration_h=underline&text_c_weight=normal&text_c_style=normal&text_c_variant=normal&text_c_decoration=none&text_c_color_h=525284&text_c_weight_h=normal&text_c_style_h=normal&text_c_variant_h=normal&text_c_decoration_h=underline&text_u_color=BF2E2E&text_u_weight=bold&text_u_style=normal&text_u_variant=normal&text_u_decoration=none&text_u_color_h=525284&text_u_weight_h=bold&text_u_style_h=normal&text_u_variant_h=normal&text_u_decoration_h=none";
								ts3v_display.init(ts3v_url_1, 1022378, 100);
								}
								initTs();
								// ]]></script>

            </div>
        </div>
    </div>

   </div>
    </div>	
	

</body>
</html>