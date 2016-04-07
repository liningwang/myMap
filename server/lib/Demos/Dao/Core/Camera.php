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
require_once 'Demos/Util/Image.php';

/**
 * @package Demos_Dao_Core
 */
class Core_Camera extends Demos_Dao_Core
{
	/**
	 * @static
	 */
	const TABLE_NAME = 'camera';
	
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
	 * zan
	 * @param int $cameraId
	 */
	 public function cameraZan($cameraId)
	 {
	 	$camera = $this->read($cameraId);
		$camera['zan'] = $camera['zan'] + 1;
		$this->update($camera);
	 }
	/**
	 * buzan
	 * @param int $cameraId
	 */
	 public function cameraBuZan($cameraId)
	 {
	 	$camera = $this->read($cameraId);
		$camera['buzan'] = $camera['buzan'] + 1;
		$this->update($camera);
	 }
	 /**
	  * Get camera by id
	  * @param int $cameraId
	  */
	  public function getCameraById($cameraId) {
	  		$sql = $this->select()
			->from($this->t1, '*')
			->where("{$this->t1}.id = ?", $cameraId);
		$camera = $this->dbr()->fetchRow($sql);
		return $camera;
	  }
	  	 /**
	  * Get camera by lating
	  * @param double $longitude 
	  * @param double $latitude
	  */
	  public function getCameraByLating($longitude,$latitude) {
	  		$sql = $this->select()
			->from($this->t1, '*')
			->where("{$this->t1}.longitude = ?", $longitude)
			->where("{$this->t1}.latitude = ?", $latitude);
		$camera = $this->dbr()->fetchRow($sql);
		return $camera;
	  }
	/**
	 * Get all blog list 
	 * @param int $pageId
	 */
	public function getCameraAll ()
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
