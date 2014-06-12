<?php

require_once('common/plugin/Plugin.class.php');
require_once 'ObsolescencePluginService.class.php';

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
        echo '<h1>Obsolescence</h1>';
        $obsolescenceService = new ObsolescencePluginService();

        if(isset($_POST['$listTechnologiesIds'])){
        	// enregistrement
        }else{
        	// report 
        }
    }
    
}

?>
