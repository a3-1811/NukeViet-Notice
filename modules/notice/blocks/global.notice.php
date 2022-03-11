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

if (!nv_function_exists('nv_block_notice')) {
  
    function nv_block_notice($block_config)
    {
        global $nv_Cache, $global_config, $site_mods, $db,$block_theme;
        $module = $block_config['module'];

            $xtpl = new XTemplate('block.notice.tpl', NV_ROOTDIR . '/themes/default' . $block_theme . '/modules/notice');
            $xtpl->parse('main');

            return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_notice($block_config);
}
