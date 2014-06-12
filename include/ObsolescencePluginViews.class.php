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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Codendi. If not, see <http://www.gnu.org/licenses/
 */
/**
 *
 * This is a part of lite Model/View/Controler design pattern.
 *
 * @package Codendi-mvc
 * @author    Guillaume Storchi
 * @license   http://opensource.org/licenses/gpl-license.php GPL
 */

class ObsolescencePluginViews {
	
	private $cpt = 0;

	public function __construct() {
	}

	public function displayForm($technoUsed, $allTechno) {

		$testTab = json_encode($allTechno);

		$content = "<script type=\"text/javascript\">
	
		var cptJs = 0;
		
		function add(cpt){
				cpt += cptJs;
				cptJs++;
				list = document.createElement('select');
				list.name = 'idTech['+cpt+']';
				var index;
				var tabTechnos = ".$testTab.";
				
						for (index = 0; index < tabTechnos.length; ++index) {					
	 						list.options[index] = new Option(tabTechnos[index]['tech_name']+' '+tabTechnos[index]['tech_version'],tabTechnos[index]['id_tech']);
 						}
				document.getElementById('listTechnologiesIds').appendChild(list);				
				document.getElementById('listTechnologiesIds').appendChild(document.createElement('br'));
		}

				</script>";

		$content .= "<form method=\"post\" action=\"?modify=false&group_id=".$_GET['group_id']."\">";

		$content .= $this->displayList($technoUsed, $allTechno);

		$content .= "<input type=\"Button\" value=\"Ajouter\" onclick=\"add(".$this->cpt.")\" /><br/>";

		$content .= "<br/><input type=\"Submit\" value=\"Valider\" />
				</form>";

		return $content;
	}

	public function displayList($technoUsed, $allTechno) {

		$content = "<DIV ID=\"listTechnologiesIds\">";

		if (sizeof($technoUsed) > 0) {

			foreach($technoUsed as $technoUse) {

				$content .= $this->addList($technoUse['id_tech'], $allTechno);

			}
		} else {
			$content .=  $this->addList(null, $allTechno);
		}

		$content .= "</DIV>";

		return $content;
	}

	public function addList($tech_id, $allTechno) {
		
		$content = "<SELECT NAME=\"idTech[".$this->cpt."]\">";

		if (isset($tech_id)) {

			foreach ($allTechno as $techno) {

				$content .= "<OPTION value=\"".$techno['id_tech']."\"";

				if ($techno['id_tech'] == $tech_id) {
					$content .= " SELECTED=\"SELECTED\"";
				}

				$content .= ">".$techno['tech_name']." ".$techno['tech_version']."</OPTION>";
				
			}
		} else {
			foreach ($allTechno as $techno) {
				$content .= "<OPTION value=\"".$techno['id_tech']."\>".$techno['tech_name']." ".$techno['tech_version']."</OPTION>";
			}
		}

		$content .= '</SELECT><BR/>';
		
		$this->cpt++;

		return $content;
	}
}
?>