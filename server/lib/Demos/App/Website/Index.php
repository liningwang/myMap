<?php
/**
 * Demos App
 *
 * @category   Demos
 * @package    Demos_App_Server
 * @author     James.Huang <huangjuanshi@163.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    $Id$
 */
require_once '../../../../etc/global.datamap.php';
require_once 'Demos/App/Website.php';
/**
 * @package Demos_App_Server
 */
class List_Page extends Demos_App_Website
{
	/**
	 * ---------------------------------------------------------------------------------------------
	 * > 全局设置：
	 * <code>
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 */
	public function __init ()
	{
		parent::__init();
	}
	
	public function getListAction ()
	{
	echo "wanglining";
	//$this->setTemplate(getcomment.tpl);
	}
}
new List_Page;