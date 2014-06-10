<?php

require_once 'common/plugin/PluginDescriptor.class.php';


class ObsolescencePluginDescriptor extends PluginDescriptor {
    
    function __construct() {
        parent::__construct($GLOBALS['Language']->getText('plugin_obsolescence', 'descriptor_name'), false, $GLOBALS['Language']->getText('plugin_obsolescence', 'descriptor_description'));
        $this->setVersionFromFile(dirname(__FILE__).'/../VERSION');
    }
}
?>