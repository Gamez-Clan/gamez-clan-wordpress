<?php
/**
 * @version   $Id: iview.php 10888 2013-05-30 06:32:18Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2014 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

interface RokSprocket_Views_IView
{
	public function renderHeader();
	public function renderInlines();
	public function render();
	public function initialize();
}
