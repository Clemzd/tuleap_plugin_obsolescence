<?php

require_once('common/plugin/Plugin.class.php');
require_once 'ObsolescencePluginService.class.php';
require_once('ObsolescencePluginViews.class.php');
require_once('ObsolescenceReportPluginViews.class.php');

class ObsolescencePlugin extends Plugin {
	
	function ObsolescencePlugin($id) {
		$this->Plugin($id);
        $this->_addHook('hook_name');
        $this->_addHook('site_admin_option_hook', 'siteAdminHooks', false);
	}
	
    function getPluginInfo() {
        if (!is_a($this->pluginInfo, 'ObsolescencePluginInfo')) {
            require_once('ObsolescencePluginInfo.class.php');
            $this->pluginInfo = new ObsolescencePluginInfo($this);
        }
        return $this->pluginInfo;
    }

	function CallHook($hook, $params) {
		if ($hook == 'hook_name') {
			//do Something
		}
	}
    
    function siteAdminHooks($params) {
        echo '<li><a href="'.$this->getPluginPath().'/">Obsolescence</a></li>';
    }
    
    function process() {        
        echo '<h1 class="well">Obsolescence</h1>';
        $obsolescenceService = new ObsolescencePluginService();
        $obsolescenceViews = new ObsolescencePluginViews();
		$obsolescenceReportViews = new ObsolescenceReportPluginViews();
		$technoUsed = $obsolescenceService->readTechnologiesFromProject($_GET['group_id']);
		
        if(isset($_GET['modify']) && $_GET['modify'] == 'true'){
        	// enregistrement
        	echo '<a href=https://localhost/>Accueil</a>';
        	$allTechno = $obsolescenceService->readTechnologies();
        	$content = $obsolescenceViews->displayForm($technoUsed, $allTechno);
        	echo $content;
        }else{
	 		// report    
	 		echo "<div class='alert alert-info'><a href=?modify=true&group_id=".$_GET['group_id']."\">Modifier les technos</a></div>";
        	
			if (isset($_POST['idTech'])) {
				$techIds = $_POST['idTech'];	
				 		
				$obsolescenceService->addTechnologies($techIds, $_GET['group_id']);
        	
	        	$technoUsed = $obsolescenceService->readTechnologiesFromProject($_GET['group_id']);
	        	$content = $obsolescenceReportViews->displayReport($technoUsed);
	        	echo $content;
			}
        
 
        }
    }
    
}

?>
