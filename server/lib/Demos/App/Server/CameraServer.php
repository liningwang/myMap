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
class CameraServer extends Demos_App_Server
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
	 * > 接口说明：微博列表接口
	 * <code>
	 * URL地址：/blog/blogList
	 * 提交方式：GET
	 * 参数#1：typeId，类型：INT，必须：YES
	 * 参数#2：pageId，类型：INT，必须：YES
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 获得所有camera接口
	 * @action /camera/getCamera
	 * @method get
	 */
	public function getCameraAction ()
	{
		$blogDao = $this->dao->load('Core_Camera');
		$camera = $blogDao->getCameraAll();
		//Hush_Util::dump($camera);
		if ($camera) {
			$this->render('200', 'Get blog list ok', array(
				'Camera.list' => $camera
			));
		}
		$this->render('14008', 'Get blog list failed');
	}
	
	/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：点赞
	 * <code>
	 * URL地址：/camera/cameraZan
	 * 提交方式：POST
	 * 参数#1：cameraId，类型：INT，必须：YES，示例：1
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 点赞
	 * @action /camera/cameraZan
	 * @params cameraId 0 INT
	 * @method post
	 */
	public function cameraZanAction ()
	{	
		$cameraId = $this->param('cameraId');
		$camera = $this->dao->load('Core_Camera');
		$camera->cameraZan($cameraId);
		$this->render('10000', 'camera zan ok');
	}
	/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：不点赞
	 * <code>
	 * URL地址：/camera/cameraBuZan
	 * 提交方式：POST
	 * 参数#1：cameraId，类型：INT，必须：YES，示例：1
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 不点赞
	 * @action /camera/cameraBuZan
	 * @params cameraId 0 INT
	 * @method post
	 */
	public function cameraBuZanAction ()
	{	
		$cameraId = $this->param('cameraId');
		$camera = $this->dao->load('Core_Camera');
		$camera->cameraBuZan($cameraId);
		$this->render('10000', 'camera buzan ok');
	}
		/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：通过Id获得camera
	 * <code>
	 * URL地址：/camera/getCameraById
	 * 提交方式：POST
	 * 参数#1：cameraId，类型：INT，必须：YES，示例：1
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title  通过Id获得camera
	 * @action /camera/getCameraById
	 * @params cameraId 0 INT
	 * @method post
	 */
	public function getCameraByIdAction ()
	{	
		$cameraId = $this->param('cameraId');
		$cameraDao = $this->dao->load('Core_Camera');
		$camera = $cameraDao->getCameraById($cameraId);
		if($camera) {
			$this->render('10000', 'get camera ok',array(
				'Camera' => $camera));
		} else {
			$this->render('14009', 'get camera failed');
		}
	}
		/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：通过Id删除camera
	 * <code>
	 * URL地址：/camera/deleteCamera
	 * 提交方式：POST
	 * 参数#1：id，类型：INT，必须：YES，示例：1
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title  通过Id删除camera
	 * @action /camera/deleteCamera
	 * @params id 0 INT
	 * @method post
	 */
	public function deleteCameraAction ()
	{
		$id = $this->param('id');
		$blogDao = $this->dao->load('Core_Camera');
		$blogDao->delete($id,'id');
		$commentDao = $this->dao->load('Core_Comment');
		$commentDao->delete($id,'cameraid');
		$this->render('10000', 'get camera');
	}
		/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：通过Id删除camera
	 * <code>
	 * URL地址：/camera/deleteCamera
	 * 提交方式：POST
	 * 参数#1：id，类型：INT，必须：YES，示例：1
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title  通过Id删除camera
	 * @action /camera/gongGao
	 * @method post
	 */
	public function gongGaoAction ()
	{
		$gongGao = array(
					'title'	=> '注意',
					'content'	=> '欢迎进入外地车地图');
		$this->render('10000', 'get message from server',array(
				'GongGao' => $gongGao));
	}
	/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：发表微博接口
	 * <code>
	 * URL地址：/blog/blogCreate
	 * 提交方式：POST
	 * 参数#1：content，类型：STRING，必须：YES
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 发表微博接口
	 * @action /camera/cameraCreate
	 * @params longitude '' DOUBLE
	 * @params latitude '' DOUBLE
	 * @params name '' STRING
	 * @params address '' STRING
	 * @params type '' INT
	 * @params direction '' STRING
	 * @params zan '' INT
	 * @params buzan '' INT
	 * @method get
	 */
	public function cameraCreateAction ()
	{
		$longitude = $this->param('longitude');
		$latitude = $this->param('latitude');
		$name = $this->param('name');
		$address = $this->param('address');
		$type = $this->param('type');
		$direction = $this->param('direction');
		$zan = $this->param('zan');
		$buzan = $this->param('buzan');
		
		//if ($content) {
			$blogDao = $this->dao->load('Core_Camera');
			$blogDao->create(array(
				'longitude' => $longitude,
				'latitude'  => $latitude,
				'name'		=> $name,
				'address'	=> $address,
				'type'		=> $type,
				'direction' => $direction,
				'zan'		=> $zan,
				'buzan'		=> $buzan
			));
			$camera = $blogDao->getCameraByLating($longitude,$latitude);
			// add customer blogcount
			if(camera) {
				$this->render('10000', 'Create blog ok',array(
				'Camera' => $camera));
			} else {
		      $this->render('14009', 'Create blog failed');
			}
	}

}
