<?php
/**
 * Demos App
 *
 * @category   Demos
 * @package    Demos_App
 * @author     James.Huang <huangjuanshi@163.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    $Id$
 */

require_once 'Hush/Page.php';

/**
 * @package Demos_App
 */
class Demos_App_Website extends Hush_Page
{
		/**
	 * Do something before __prepare() method
	 * @see Hush_Page
	 */
	public function __before_prepare ()
	{
		// auto init page tpl path
		if (defined('__LIB_TPL')) {
			$this->setTemplateDir(__LIB_TPL);
		}
	}
}
