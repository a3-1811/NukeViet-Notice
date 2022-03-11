<?php
// //Structure for Create, Delete, Update Document
// $sql = "SELECT * FROM ". $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_notices';
// $stmt = $db->prepare($sql);
// $sth->execute();

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

$page_title = $lang_module['notice-list'];

// Fetching data
$notices = array();

try {
    try {
        $result = $db->query('select * from '. $db_config['prefix'] . '_vi_' . $module_data . '_notices');
        foreach ($result as $row) {
            // Create new object notice
            $object = new stdClass();
            $object->id = $row['id'];
            $object->sender = $row['sender'];
            $object->message = $row['message'];
            $object->created_at = date("Y-m-d H:i:s", $row['created_at']);
            array_push($notices,$object);
        }
    } catch (PDOException $e) {
        trigger_error(print_r($e, true));
    }
} catch (PDOException $e) {
    trigger_error(print_r($e, true));
}

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);

foreach($notices as $notice){
    $xtpl->assign('NOTICE',$notice);
    $xtpl->parse('main.loop');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
