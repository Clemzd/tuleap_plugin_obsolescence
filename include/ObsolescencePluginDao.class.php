<?php
/**
 * Copyright (c) Xerox Corporation, Codendi Team, 2001-2009. All rights reserved
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

require_once 'common/dao/include/DataAccessObject.class.php';

/**
 *  Data Access Object for Obsolescence plugin
 */
class ObsolescencePluginDao extends DataAccessObject {

	function __construct($da = null) {
		parent::__construct($da);
	}

	/**
	 * Associate the given technologies with the project in the bdd
	 * 
	 * @param list of int $listTechnologiesIds
	 * @param int $groupId
	 */
	function addTechnologies($listTechnologiesIds, $groupId) {

		foreach($listTechnologiesIds as $techId) {
			$sql = "INSERT INTO plugin_obsolescence_groups_technologies VALUES (" . $groupId . "," . $techId . ")";
			$this->update($sql);
		}
	}

	/**
	 * Delete the association between the given technologies and the project in the bdd
	 * 
	 * @param int $groupId
	 */
	function deleteTechnologies($groupId) {
		$sql = "DELETE FROM plugin_obsolescence_groups_technologies WHERE group_id = " . $groupId;
		$this->update($sql);
	}

	/**
	 * Get the list of technologies associate to the given project
	 * 
	 * @param int $groupId
	 * @return array(array())
	 */
	function readTechnologiesFromProject($groupId) {
		$sql = "SELECT obs.id_tech, obs.tech_name, obs.tech_version, obs.release, obs.endoflife,
				obs.endoflife <= current_date as depreciate_today,
				obs.endoflife <= date_add(current_date, interval 2 year) as depreciate_two_years
				FROM plugin_obsolescence_technologies obs, plugin_obsolescence_groups_technologies groups
				WHERE obs.id_tech = groups.tech_id
				AND groups.group_id = '" . $groupId . "'";
		return $this->retrieve($sql);
	}
	
	function readTechnologies(){
		$sql = "select id_tech,tech_name,tech_version,plugin_obsolescence_technologies.release,endoflife from plugin_obsolescence_technologies";
		return $this->retrieve($sql);
		
	}

}

?>