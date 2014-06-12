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

    public function __construct() {
    }
    
    public function displayForm($technoUsed, $allTechno) {
    	$content = "<form method=\"post\" action=\"index.php\">";
    	
    	$content .= displayList($technoUsed, $allTechno);
    	    	
    	$content .= "<input type=\"Button\" value=\"Valider\" />
					</form>";
    	
    	return $content;
    }

    public function displayList($technoUsed, $allTechno) {

    	$content = "<SELECT NAME=\"listTechnologiesIds\">";
    	$cpt = 0;
    	
    	if (sizeof($technoUsed) > 0) {
    		
    		foreach($technoUsed as $technoUse) {
    		
    			foreach ($allTechno as $techno) {
    				
    				$content .= "<OPTION value=\"".$technoUsed['tech_id']."\"";
    				
    				if ($techno['tech_id'] == $technoUse['tech_id']) {
    					$content .= " SELECTED=\"SELECTED\"";
    				}
    				
    				$content .= ">".$technoUsed['tech_name']." ".$techUsed['tech_version']."</OPTION>";
    		
    				$cpt++;
    			}
    		
    		}
    	} else {
    		foreach ($allTechno as $techno) {
    			$content .= "<OPTION value=\"".$technoUsed['tech_id']."\>".$technoUsed['tech_name']." ".$techUsed['tech_version']."</OPTION>";
    		}
    	}	
    	
    	$content .= "</SELECT>";
    	
    	return $content;
    }
}
?>
