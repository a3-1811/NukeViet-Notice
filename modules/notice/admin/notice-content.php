<?php

//Pusher realtime notice
$options = array(
    'cluster' => 'ap1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '4e75e6169027e6b46053',
    'e4b40f814577b3dd56e1',
    '1357058',
    $options
  );

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

$page_title = $lang_module['notice-add'];

$error = '';
$post = [];

$post['fullName'] = $nv_Request->get_string( 'fullName', 'post');
$post['messages'] = $nv_Request->get_string('messages', 'post');

if(trim($post['fullName']) == '' || trim($post['messages']) == '' ){
    $error = 'Vui lòng nhập đủ trường dữ liệu!';
}

if($error == ''){
  $data = [];
  $data['fullName'] = $post['fullName'];
  $data['messages'] = $post['messages'];
  $pusher->trigger('my-channel', 'my-event', $data);

  //Add new notice
  $sql = 'INSERT INTO '. $db_config['prefix'] . '_vi_' . $module_data . '_notices (id, sender, message, created_at) VALUES(NULL, :sender, :message, :createdAt)';
    $sth = $db->prepare($sql);
    $sth->bindParam('sender', $post['fullName']);
    $sth->bindParam('message', $post['messages']);
    $sth->bindValue('createdAt', NV_CURRENTTIME);
    $sth->execute();
}

$error = '';
/// End pusher content code

$xtpl = new XTemplate('content.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);

$xtpl->assign('FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;');

$xtpl->assign("POST",$post);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
