<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/Style/skin.css" />
        <script  type="text/javascript" src='__PUBLIC__/Js/jquery.js' ></script>
        <script>
            $(function () {
                $('input[type=checkbox]').click(function () {
                    var cbid = $(this).attr('id');
                    checked('input[type=checkbox]', cbid);
                });

                $('select[name=pRole').change(function () {
                    var pRoleId = $(this).val();
                    $.post('__URL__/getAuthor', {id: pRoleId}, function (data) {
                        $('input[type=checkbox]').attr("checked", false);
                        $(data.data).each(function (i, v) {
                            $('input[id=' + v + ']').attr("checked", "checked");
                        });
                    }, 'json');
                });
            });

            /*
             * 递归将子checkbox全选或取消
             * cb  : checkbox集
             * pid : 选中的id  
             */
            function checked(cb, pid) {
                $(cb).each(function (i, v) {
                    var childPid = $(v).attr('pid');
                    var childId = $(v).attr('id');

                    if (childPid == pid) {
                        //递归全选
                        checked(cb, childId);

                        if ($(v).attr('checked')) {
                            $(v).attr("checked", false);
                        } else {
                            $(v).attr("checked", "checked");
                        }
                    }
                });
            }
        </script>
    </head>
    <body>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <!-- 头部开始 -->
            <tr>
                <td width="17" valign="top" background="__PUBLIC__/Images/mail_left_bg.gif">
                    <img src="__PUBLIC__/Images/left_top_right.gif" width="17" height="29" />
                </td>
                <td valign="top" background="__PUBLIC__/Images/content_bg.gif">
                    <table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" background="./__PUBLIC__/Images/content_bg.gif">
                        <tr><td height="31"><div class="title">修改角色</div></td></tr>
                    </table>
                </td>
                <td width="16" valign="top" background="__PUBLIC__/Images/mail_right_bg.gif"><img src="__PUBLIC__/Images/nav_right_bg.gif" width="16" height="29" /></td>
            </tr>
            <!-- 中间部分开始 -->
            <tr>
                <!--第一行左边框-->
                <td valign="middle" background="__PUBLIC__/Images/mail_left_bg.gif">&nbsp;</td>
                <!--第一行中间内容-->
                <td valign="top" bgcolor="#F7F8F9">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <!-- 空白行-->
                        <tr><td colspan="2" valign="top">&nbsp;</td><td>&nbsp;</td><td valign="top">&nbsp;</td></tr>
                        <tr>
                            <td colspan="4">
                                <table>
                                    <tr>
                                        <td width="100" align="center"><img src="__PUBLIC__/Images/mime.gif" /></td>
                                        <td valign="bottom"><h3 style="letter-spacing:1px;">修改角色</h3></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- 一条线 -->
                        <tr>
                            <td height="40" colspan="4">
                                <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                                    <tr><td></td></tr>
                                </table>
                            </td>
                        </tr>
                        <!-- 添加栏目开始 -->
                        <tr>
                            <td width="2%">&nbsp;</td>
                            <td width="96%">
                                <table width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <form action="?" method="POST">
                                                <table width="100%" class="cont">
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>角色名称：</td>
                                                        <td width="20%"><input class="text" type="text" name="name" value="<?php echo ($data["name"]); ?>" /></td>
                                                        <td></td>
                                                        <td width="2%">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>上级角色：</td>
                                                        <td>
                                                            <select name="pRole" >
                                                                <option value="0">顶级角色</option>
                                                                <?php if(is_array($rolelist)): $i = 0; $__LIST__ = $rolelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo (str_repeat('&nbsp;&nbsp;&nbsp;',$vo["level"])); echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>拥有的权限：</td>
                                                        <td width="20%">
                                                            <table>
                                                                <?php if(is_array($catlist)): $i = 0; $__LIST__ = $catlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                                        <td><?php echo (str_repeat('&nbsp;&nbsp;&nbsp;',$vo["level"]*2)); echo ($vo["name"]); ?></td>
                                                                        <td>&nbsp;&nbsp;&nbsp;<input name="author[]" value="<?php echo ($vo["id"]); ?>" id='<?php echo ($vo["id"]); ?>' pid='<?php echo ($vo["pid"]); ?>' type='checkbox' /></td>
                                                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </table>
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                        <td width="2%">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <input type="hidden" name="id" value="<?php echo ($id); ?>" />
                                                        <td colspan="3"><input class="btn" type="submit" name="submit" value="修改" /></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="2%">&nbsp;</td>
                        </tr>
                        <!-- 添加栏目结束 -->
                        <tr>
                            <td height="40" colspan="4">
                                <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                                    <tr><td></td></tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="2%">&nbsp;</td>
                            <td width="51%" class="left_txt">
                                <img src="__PUBLIC__/Images/icon_mail.gif" width="16" height="11"> 客户服务邮箱：rainman@foxmail.com<br />
                                    <img src="__PUBLIC__/Images/icon_phone.gif" width="17" height="14"> 官方网站：<a href="http://www.rain-man.cn">http://www.rain-man.cn</a>
                                        </td>
                                        <td>&nbsp;</td><td>&nbsp;</td>
                                        </tr>
                                        </table>
                                        </td>
                                        <td background="__PUBLIC__/Images/mail_right_bg.gif">&nbsp;</td>
                                        </tr>
                                        <!-- 底部部分 -->
                                        <tr>
                                            <td valign="bottom" background="__PUBLIC__/Images/mail_left_bg.gif">
                                                <img src="__PUBLIC__/Images/buttom_left.gif" width="17" height="17" />
                                            </td>
                                            <td background="__PUBLIC__/Images/buttom_bgs.gif">
                                                <img src="__PUBLIC__/Images/buttom_bgs.gif" width="17" height="17">
                                            </td>
                                            <td valign="bottom" background="__PUBLIC__/Images/mail_right_bg.gif">
                                                <img src="__PUBLIC__/Images/buttom_right.gif" width="16" height="17" />
                                            </td>           
                                        </tr>
                                        </table>
                                        </body>
                                        </html>