##
## Sql Uninstall Script
##
-- DROP TABLE plugin_obsolescence_my_table;

DROP TABLE `plugin_obsolescence_technologies`;
DROP TABLE `plugin_obsolescence_groups_technologies`;


-- Delete of the service for the plugin Obsolescence
DELETE FROM `service` WHERE `short_name`=`obsolescence`;