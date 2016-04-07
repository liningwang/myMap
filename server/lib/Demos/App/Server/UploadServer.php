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

require_once 'Demos/App/Server.php';

/**
 * @package Demos_App_Server
 */
class UploadServer extends Demos_App_Server
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
	
	////////////////////////////////////////////////////////////////////////////////////////////////
	// service api methods
	
	/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：测试接口
	 * <code>
	 * URL地址：/test/index
	 * 提交方式：POST
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 测试接口
	 * @action /test/index
	 * @method get
	 */
	public function uploadAction ()
	{
	if ($_FILES["file"]["error"] > 0)
	{
		$this->render('10004', $_FILES["file"]["error"]);
	} else {
		move_uploaded_file($_FILES['file']['tmp_name'], "F:/camera-server/server/myMap/server/www/website/faces/road/".$_FILES["file"]["name"]);
		$this->render('10000', 'upload file successfully');
	}
	}
	public function wangAction ()
	{
		echo "First Api is" . $_SESSION['count'];
	}
}