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

class ObsolescenceReportPluginViews {

    public function __construct() {
    }
    
    public function displayReport($technoUsed) {
  	
    	$content = '
    	<table class="table table-striped">
    	
    	<thead>
	    	<tr>
	    		<th>Technologie</th>
	    		<th>Dépréciation aujourd\'hui</th>
	    		<th>Dépréciation dans 2 ans</th>
	    	</tr>
		</thead>';
    		
    	$counterDepreciateToday = 0;
    	$counterDepreciateTowYears = 0;
    		
    	foreach($technoUsed as $technoUse) {
    		
    		
    		$depreciate_today = ($technoUse['depreciate_today']==1);
    		$depreciate_two_years = ($technoUse['depreciate_two_years']==1);
    		if($depreciate_today){
    			$counterDepreciateToday++;
    		}
    		if($depreciate_two_years){
    			$counterDepreciateTowYears++;
    		}
    		
    		$content .= '<tbody>
    				<tr>
    					<td>' . $technoUse['tech_name'] . '</td>' .
    					'<td class="' . $this->styleDeprecated($depreciate_today) . '">X</td>' .
    					'<td>' . $technoUse['depreciate_two_years'] . '</td>'
    				. '</tr></tbody>';
    	}
    	$content .= '</table>';
    	$score = (($counterDepreciateToday*2) + $counterDepreciateTowYears) / (3 * count($technoUsed));
		$content .=  '<h3>Score : ' . $score . '<h3>';
    	
    	return $content;
    }
    
    public function styleDeprecated($bool){
    	if($bool){
    		return 'green';
    	}else{
    		return 'black';
    	}
    }
}
?>
