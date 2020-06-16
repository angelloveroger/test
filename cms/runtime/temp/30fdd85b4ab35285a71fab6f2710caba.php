<?php /*a:2:{s:69:"G:\roger\test\cms\application\admin\view\auth_manager\edit_group.html";i:1592272211;s:58:"G:\roger\test\cms\application\admin\view\index_layout.html";i:1592272211;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>YZNCMS后台管理系统</title>
    <meta name="author" content="YZNCMS">
    <link rel="stylesheet" href="/static/libs/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/css/admin.css?t=1590715645">
    <link rel="stylesheet" href="/static/common/font/iconfont.css">
    <script src="/static/libs/layui/layui.js"></script>
    <script src="/static/libs/jquery/jquery.min.js"></script>
    <script type="text/javascript">
    //全局变量
    var GV = {
        'image_upload_url': '<?php echo !empty($image_upload_url) ? htmlentities($image_upload_url) :  url("attachment/upload/upload", ["dir" => "images", "module" => request()->module()]); ?>',
        'file_upload_url': '<?php echo !empty($file_upload_url) ? htmlentities($file_upload_url) :  url("attachment/upload/upload", ["dir" => "files", "module" => request()->module()]); ?>',
        'jcrop_upload_url': '<?php echo !empty($jcrop_upload_url) ? htmlentities($jcrop_upload_url) :  url("attachment/Attachments/cropper"); ?>',
        'WebUploader_swf': '/static/libs/webuploader/Uploader.swf',
        'ueditor_upload_url': '<?php echo !empty($ueditor_upload_url) ? htmlentities($ueditor_upload_url) :  url("attachment/upload/upload", ["dir" => "images","from"=>"ueditor", "module" => request()->module()]); ?>',
        'ueditor_grabimg_url': '<?php echo !empty($ueditor_upload_url) ? htmlentities($ueditor_upload_url) :  url("attachment/Attachments/geturlfile"); ?>',
        'image_select_url': '<?php echo !empty($image_select_url) ? htmlentities($image_select_url) :  url("attachment/Attachments/select"); ?>',
    };
    </script>
</head>

<body class="childrenBody">
    
    <script type="text/javascript">
    //console.log(layui.cache);
    layui.config({
        version: '1557143998899',
        base: '/static/libs/layui_exts/'
    }).extend({
        treeGrid: 'treeGrid/treeGrid',
        clipboard: 'clipboard/clipboard',
        notice: 'notice/notice',
        iconPicker: 'iconPicker/iconPicker',
        tableSelect: 'tableSelect/tableSelect',
        ztree: 'ztree/ztree',
        dragsort:'dragsort/dragsort',
        tagsinput: 'tagsinput/tagsinput',
        common: '{/}/static/admin/js/common'
    }).use('common');
    </script>
    
    
<div class="layui-card">
    <div class="layui-card-header"><?php echo !empty($auth_group['id']) ? '编辑' : '新增'; ?>权限组</div>
    <div class="layui-card-body">
        <form class="layui-form" action="<?php echo url('writeGroup'); ?>" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">父级</label>
                <div class="layui-input-block w300">
                    <select name="parentid">
                        <?php echo $Groupdata; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">权限组</label>
                <div class="layui-input-block w300">
                    <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="权限组" class="layui-input" value="<?php echo htmlentities($auth_group['title']); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block w300">
                    <textarea name="description" placeholder="权限的相关描述" class="layui-textarea"><?php echo htmlentities($auth_group['description']); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="w300">
                    <input type="radio" name="status" value="1" title="正常" <?php if($auth_group['status'] == '1'): ?>checked<?php endif; ?>>
                    <input type="radio" name="status" value="0" title="禁用" <?php if($auth_group['status'] == '0'): ?>checked<?php endif; ?>>
                </div>
            </div>
            <?php if(isset($auth_group['id'])): ?>
            <input type="hidden" name="id" value="<?php echo htmlentities($auth_group['id']); ?>" />
            <?php endif; ?>
            <div class="layui-form-item">
                <div class="layui-input-block w300">
                    <button class="layui-btn" lay-submit="" lay-filter="formSubmit">立即提交</button>
                    <button class="layui-btn layui-btn-normal" type="button" onclick="javascript:history.back(-1);">返回</button>
                </div>
            </div>
        </form>
    </div>
</div>

    
</body>

</html>