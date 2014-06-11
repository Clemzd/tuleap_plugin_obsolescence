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

// require_once('www/project/export/project_export_utils.php');
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
	 * @param list of int $listTechIds
	 * @param int $groupId
	 */
	function addTechnologies($listTechIds, $groupId) {

		foreach($listTechIds as $techId) {
			$sql = "INSERT INTO tuleap.plugin_obsolescence_groups_technologies
					VALUES (" + $groupId + "," + $techId + ");";
			$this->retrieve($sql);
		}
	}

	/**
	 * Delete the association between the given technologies and the project in the bdd
	 * 
	 * @param list of int $listTechIds
	 * @param int $groupId
	 */
	function delTechnologies($listTechIds, $groupId) {

		foreach($listTechIds as $techId) {
			$sql = "DELETE FROM tuleap.plugin_obsolescence_groups_technologies
					WHERE group_id = " + $groupId + " AND tech_id = " + $techId + ");";
			$this->retrieve($sql);
		}
	}

	/**
	 * Get the list of technologies associate to the given project
	 * 
	 * @param int $groupId
	 * @return array(array())
	 */
	function getTechnologiesFromProject($groupId) {
		$result = array();
		$cpt = 0;

		$sql = "SELECT obs.tech_name, obs.tech_version, obs.release, obs.endoflife
				FROM tuleap.plugin_obsolescence_technologies obs, tuleap.plugin_obsolescence_groups_technologies groups
				WHERE obs.tech_id = groups.tech_id
				AND groups.group_id = " + $groupId + ";";
		$dar = $this->retrieve($sql);

		foreach(dar as $row) {
			
			$line = array(
				"tech_name" => $row['tech_name'],
				"tech_version" => $row['tech_version'],
				"release" => $row['release'],
				"endoflife" => $row['endoflife']		
			);	
			
			$result[$cpt] = $line;
						
			$cpt++;
		}
		
		return $result;
	}

}

?>