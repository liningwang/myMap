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
class SafeRoadServer extends Demos_App_Server
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
	 * @action /safeRoad/safeRoadList
	 * @method get
	 */
	public function safeRoadListAction ()
	{
		//$this->doAuth();	
		$commentDao = $this->dao->load('Core_SafeRoad');
		$safeRoadList = $commentDao->getSafeRoadAll();

		if ($safeRoadList) {
			$this->render('10000', 'Get comment list ok', array(
				'SafeRoad.list' => $safeRoadList
			));
		}
		$this->render('14010', 'Get comment list failed');
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
	 * @action /safeRoad/safeRoadCountById
	 * @params customerId 0 INT
	 * @method post
	 */
	public function safeRoadCountByIdAction ()
	{
		//$this->doAuth();	
		$customerId = intval($this->param('customerId'));
		$commentDao = $this->dao->load('Core_SafeRoad');
		$replyDao = $this->dao->load('Core_ReplyRoad');
		$safeRoadList = $commentDao->getSafeRoadById($customerId);
		$allCount = 0;
		if ($safeRoadList) {
			foreach ($safeRoadList as $row) {
				$roadList = $replyDao->getRoadScanById($row['id']);
				$allCount = $allCount + count($roadList);
			}
			$itemCount = array('count' => $allCount);
			$this->render('10000', 'Get comment list ok', array(
				'AllRoadCount' => $itemCount
			));
		}
		$this->render('14010', 'Get comment list failed');
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
	 * @action /safeRoad/safeRoadEachCountById
	 * @params customerId 0 INT
	 * @method post
	 */
	public function safeRoadEachCountByIdAction ()
	{
		//$this->doAuth();	
		$list = array();
		$customerId = intval($this->param('customerId'));
		$commentDao = $this->dao->load('Core_SafeRoad');
		$replyDao = $this->dao->load('Core_ReplyRoad');
		$safeRoadList = $commentDao->getSafeRoadById($customerId);
		if ($safeRoadList) {
			foreach ($safeRoadList as $row) {
				$roadList = $replyDao->getRoadScanById($row['id']);
				$item = array(
						'id' => $row['id'],
						'content' => $row['content'],
						'customerid' => $row['customerid'],
						'url' => $row['url'],
						'username' => $row['username'],
						'replycount' => $row['replycount'],
						'uptime'	 =>$row['uptime'],
						'itemcount'	=> count($roadList));
				array_push($list, $item);
			}
			$this->render('10000', 'Get each safe road list ok', array(
				'SafeEachRoad.list' => $list
			));
		}
		$this->render('14010', 'Get comment list failed');
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
	 * @action /safeRoad/safeRoadCount
	 * @params safeId 0 INT
	 * @params count 0 INT
	 * @method get
	 */
	public function safeRoadCountAction ()
	{
		//$this->doAuth();	
		$safeId = $this->param('safeId');
		$count = $this->param('count');
		$commentDao = $this->dao->load('Core_SafeRoad');
		$where = 'id = ' . $safeId;
		$safeRoadList = $commentDao->update(array('replycount' => $count),$where);

		if ($safeRoadList) {
			$this->render('10000', 'Get comment list ok'
			);
		}
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
	 * @action /safeRoad/safeRoadCreate
	 * @params customerId 0 INT
	 * @params content '' STRING
	 * @params url '' STRING
	 * @params username '' STRING
	 * @method post
	 */
	public function safeRoadCreateAction ()
	{
		
		$url = $this->param('url');
		$customerId = intval($this->param('customerId'));
		$content = $this->param('content');
		$username = $this->param('username');
		
		
		
			$commentDao = $this->dao->load('Core_SafeRoad');
			$item = $commentDao->create(array(	
				'customerid'	=> $customerId,
				'url'			=> $url,
				'content'		=> $content,
				'username'		=> $username
			));
			$safe = array('id' => $item);
			if($item) {
				$this->render('10000', 'Create saferoad ok',
				array('SafeId' => $safe));
			} else {
		      $this->render('14009', 'Create saferoad failed');
			}
	}
}