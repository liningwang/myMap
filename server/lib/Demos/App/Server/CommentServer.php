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
class CommentServer extends Demos_App_Server
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
	 * > 接口说明：评论列表接口
	 * <code>
	 * URL地址：/comment/commentList
	 * 提交方式：GET
	 * 参数#1：cameraId，类型：INT，必须：YES
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 评论列表接口
	 * @action /comment/commentList
	 * @params cameraId 0 INT
	 * @method get
	 */
	public function commentListAction ()
	{
		//$this->doAuth();
		
		$cameraId = intval($this->param('cameraId'));
		
		$commentDao = $this->dao->load('Core_Comment');
		$commentList = $commentDao->getListByCamera($cameraId);

		if ($commentList) {
			$this->render('10000', 'Get comment list ok', array(
				'Comment.list' => $commentList
			));
		}
		$this->render('14010', 'Get comment list failed');
	}
	/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：发表评论接口
	 * <code>
	 * URL地址：/comment/commentCreate
	 * 提交方式：POST
	 * 参数#1：cameraId，类型：INT，必须：YES
	 * 参数#2：customerId，类型：INT，必须：YES
	 * 参数#3：name，类型：STRING，必须：YES
	 * 参数#4：content，类型：STRING，必须：YES
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 发表评论接口
	 * @action /comment/commentCreate
	 * @params cameraId 0 INT
	 * @params customerId 0 INT
	 * @params content '' STRING
	 * @params name '' STRING
	 * @method post
	 */
	public function commentCreateAction ()
	{
		
		$cameraId = intval($this->param('cameraId'));
		$customerId = intval($this->param('customerId'));
		$content = $this->param('content');
		$name = $this->param('name');
		
		
		
			$commentDao = $this->dao->load('Core_Comment');
			$commentDao->create(array(
				'cameraid'		=> $cameraId,	
				'customerid'	=> $customerId,
				'name'			=> $name,
				'content'		=> $content
			));
			$this->render('10000', 'Create comment ok');

	}
			/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：评论列表接口
	 * <code>
	 * URL地址：/comment/commentList
	 * 提交方式：GET
	 * 参数#1：cameraId，类型：INT，必须：YES
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 评论列表接口
	 * @action /comment/commentCount
	 * @params commentId 0 INT
	 * @params count 0 INT
	 * @method get
	 */
	public function commentCountAction ()
	{
		//$this->doAuth();	
		$safeId = $this->param('commentId');
		$count = $this->param('count');
		$commentDao = $this->dao->load('Core_Comment');
		$where = 'id = ' . $safeId;
		$safeRoadList = $commentDao->update(array('replycount' => $count),$where);

		if ($safeRoadList) {
			$this->render('10000', 'Get comment list ok'
			);
		}
	}
}