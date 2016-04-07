<?php
/**
 * Demos Dao
 *
 * @category   Demos
 * @package    Demos_Dao_Core
 * @author     James.Huang <shagoo@gmail.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    $Id$
 */

require_once 'Demos/Dao/Core.php';
require_once 'Demos/Dao/Core/Customer.php';

/**
 * @package Demos_Dao_Core
 */
class Core_SafeRoad extends Demos_Dao_Core
{
	/**
	 * @static
	 */
	const TABLE_NAME = 'saferoad';
	
	/**
	 * @static
	 */
	const TABLE_PRIM = 'id';
	
	/**
	 * Initialize
	 */
	public function __init () 
	{
		$this->t1 = self::TABLE_NAME;
		$this->k1 = self::TABLE_PRIM;
		
		$this->_bindTable($this->t1, $this->k1);
	}
	
	/**
	 * Get all camera comment list
	 * @param int $cameraId
	 */
	public function getListByCamera ($cameraId)
	{
		$list = array();
		$sql = $this->select()
			->from($this->t1, '*')
			->where("{$this->t1}.cameraid = ?", $cameraId)
			->order("{$this->t1}.uptime desc");
			
		
		$res = $this->dbr()->fetchAll($sql);
		/*if ($res) {
			$customerDao = new Core_Customer();
			foreach ($res as $row) {
				$customer = $customerDao->read($row['customerid']);
				$comment = array(
					'id'		=> $row['id'],
					'content'	=> '<b>'.$customer['name'].'</b> : '.$row['content'],
					'uptime'	=> $row['uptime'],
				);
				array_push($list, $comment);
			}
		}
		return $list;*/
		return $res;
	}
		/**
	 * Get all camera comment list
	 * @param int $customerId
	 */
	public function getSafeRoadById ($customerId)
	{
		$list = array();
		$sql = $this->select()
			->from($this->t1, '*')
			->where("{$this->t1}.customerid = ?", $customerId)
			->order("{$this->t1}.uptime desc");
			
		
		$res = $this->dbr()->fetchAll($sql);
		return $res;
	}
	/**
	 * Get all saferoad list 
	 */
	public function getSafeRoadAll ()
	{
		$list = array();
		$sql = $this->select()
			->from($this->t1, '*')
			->order("{$this->t1}.uptime desc");
		
		$res = $this->dbr()->fetchAll($sql);
		/*if ($res) {
			foreach ($res as $row) {
				$blog = array(
					'id'		=> $row['id'],
					'longitude'	=> $row['longitude'],
					'latitude'	=> $row['latitude'],
					'uptime'	=> $row['uptime'],
				);
				array_push($list, $blog);
			}
		}*/
		return $res;
	}
}