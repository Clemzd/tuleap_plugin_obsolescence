<?php
/**
 * Copyright (c) STMicroelectronics, 2004-2009. All rights reserved
 *
 * This file is a part of Codendi.
 *
 * Codendi is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Codendi is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Codendi. If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'ObsolescencePluginDao.class.php';

class ObsolescencePluginService {
    protected $_obsolescencePluginDao;
    
	public function __construct() {
		$this->_obsolescencePluginDao = new ObsolescencePluginDao(CodendiDataAccess::instance());
	}
    
    public function addTechnologies($listTechnologiesIds, $groupId) {
    	$this->_obsolescencePluginDao->deleteTechnologies($groupId);
        $this->_obsolescencePluginDao->addTechnologies($listTechnologiesIds,$groupId);
    }
    
    public function readTechnologiesFromProject($group_id){
    	return $this->darToArray($this->_obsolescencePluginDao->readTechnologiesFromProject($group_id));
    }
    
    public function readTechnologies() {
    	return $this->darToArray($this->_obsolescencePluginDao->readTechnologies());
    }
    
    public function darToArray($dar){
    	$rows = array();
    	foreach($dar as $row){
			array_push($rows, $row);
    	}
    	return $rows;
    }
    

}

?>