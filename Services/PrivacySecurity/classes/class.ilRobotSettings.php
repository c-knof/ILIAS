<?php
/*
	+-----------------------------------------------------------------------------+
	| ILIAS open source                                                           |
	+-----------------------------------------------------------------------------+
	| Copyright (c) 1998-2006 ILIAS open source, University of Cologne            |
	|                                                                             |
	| This program is free software; you can redistribute it and/or               |
	| modify it under the terms of the GNU General Public License                 |
	| as published by the Free Software Foundation; either version 2              |
	| of the License, or (at your option) any later version.                      |
	|                                                                             |
	| This program is distributed in the hope that it will be useful,             |
	| but WITHOUT ANY WARRANTY; without even the implied warranty of              |
	| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               |
	| GNU General Public License for more details.                                |
	|                                                                             |
	| You should have received a copy of the GNU General Public License           |
	| along with this program; if not, write to the Free Software                 |
	| Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA. |
	+-----------------------------------------------------------------------------+
*/

/** 
* 
* @author Stefan Meyer <smeyer@databay.de>
* @version $Id$
* 
* 
* @ingroup ServicesPrivacySecurity 
*/
class ilRobotSettings
{
	private $open_robots = false;
	private $settings = null;
	
	private static $instance = null;
	/**
	 * Private constructor => use getInstance
	 *
	 * @access private
	 * @param
	 * 
	 */
	private function __construct()
	{
		global $ilSetting;
		
		$this->settings = $ilSetting;
	 	$this->read();
	}
	
	/**
	 * Get instance
	 *
	 * @access public
	 * @static
	 *
	 * @param
	 */
	public static function _getInstance()
	{
		if(isset(self::$instance) and self::$instance)
		{
			return self::$instance;
		}
		else
		{
			return self::$instance = new ilRobotSettings();
		}
	}
	
	/**
	 * Check if client is open for robots
	 *
	 * @access public
	 * @return bool support given 
	 */
	public function robotSupportEnabled()
	{
	 	return (bool) $this->open_robots;
	}
	
	/**
	 * Read settings
	 *
	 * @access private
	 * 
	 */
	private function read()
	{
	 	$this->open_robots = (bool) $this->settings->get('open_google',false);
	 	if(!$this->checkModRewrite())
	 	{
	 		$this->open_robots = false;
	 	}
	}
	
	/**
	 * Check if mod_rewrite module is available
	 *
	 * @access public
	 * @param
	 * 
	 */
	public function checkModRewrite()
	{
	 	if(in_array('mod_rewite',apache_get_modules()))
	 	{
	 		return true;
	 	}
	 	return false;
	}
}


?>