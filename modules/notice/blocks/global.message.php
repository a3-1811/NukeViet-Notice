<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

if (!nv_function_exists('nv_block_message')) {
  
    function nv_block_message($block_config)
    {
        global $nv_Cache, $global_config, $site_mods, $db,$block_theme,$db_config,$module_data;
        $module = $block_config['module'];
        $messages = array();
        try {
            $result = $db->query('select * from '. $db_config['prefix'] . '_vi_' . 'notice' . '_notices ORDER BY created_at DESC;');
            foreach ($result as $row) {
                // Create new object notice
                $object = new stdClass();
                $object->sender = $row['sender'];
                $object->message = $row['message'];
                $object->created_at = date("Y-m-d H:i:s", $row['created_at']);
                array_push($messages,$object);
            }
        } catch (PDOException $e) {
            trigger_error(print_r($e, true));
        }
        $xtpl = new XTemplate('block.message.tpl', NV_ROOTDIR . '/themes/default' . $block_theme . '/modules/notice');

        foreach($messages as $message){
            $xtpl->assign('MESSAGE',$message);
            $xtpl->parse('main.loop');
        }

        $xtpl->parse('main');

        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_message($block_config);
}
