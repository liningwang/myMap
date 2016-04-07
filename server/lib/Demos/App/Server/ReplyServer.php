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
class ReplyServer extends Demos_App_Server
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
	 * URL地址：/reply/replyList
	 * 提交方式：GET
	 * 参数#1：cameraId，类型：INT，必须：YES
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 评论列表接口
	 * @action /reply/replyList
	 * @params commentId 0 INT
	 * @method get
	 */
	public function ReplyListAction ()
	{
		//$this->doAuth();
		
		$commentId = intval($this->param('commentId'));
		
		$replyDao = $this->dao->load('Core_Reply');
		$replyList = $replyDao->getListById($commentId);

		if ($replyList) {
			$this->render('10000', 'Get comment reply list ok', array(
				'Reply.list' => $replyList
			));
		}
		$this->render('14010', 'Get comment list failed');
	}
	
	/**
	 * ---------------------------------------------------------------------------------------------
	 * > 接口说明：发表评论接口
	 * <code>
	 * URL地址：/reply/replyCreate
	 * 提交方式：POST
	 * 参数#1：cameraId，类型：INT，必须：YES
	 * 参数#2：customerId，类型：INT，必须：YES
	 * 参数#3：name，类型：STRING，必须：YES
	 * 参数#4：content，类型：STRING，必须：YES
	 * </code>
	 * ---------------------------------------------------------------------------------------------
	 * @title 发表评论接口
	 * @action /reply/replyCreate
	 * @params commentId 0 INT
	 * @params content '' STRING
	 * @params name '' STRING
	 * @method post
	 */
	public function ReplyCreateAction ()
	{
		
		$commentId = intval($this->param('commentId'));
		$content = $this->param('content');
		$name = $this->param('name');
		
		
		
			$commentDao = $this->dao->load('Core_Reply');
			$commentDao->create(array(
				'commentId'		=> $commentId,
				'name'			=> $name,
				'content'		=> $content
			));
			$this->render('10000', 'Create comment ok');

	}
}