<?php
// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2007 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

//公共函数
function toDate($time, $format = 'Y-m-d H:i:s') {
    if (empty ( $time )) {
        return '';
    }
    $format = str_replace ( '#', ':', $format );
    return date ($format, $time );
}

function get_client_ip() {
    if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
        $ip = getenv ( "HTTP_CLIENT_IP" );
    else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
        $ip = getenv ( "HTTP_X_FORWARDED_FOR" );
    else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
        $ip = getenv ( "REMOTE_ADDR" );
    else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
        $ip = $_SERVER ['REMOTE_ADDR'];
    else
        $ip = "unknown";
    return ($ip);
}
// 缓存文件
function cmssavecache($name = '', $fields = '') {
    $Model = D ( $name );
    $list = $Model->select ();
    $data = array ();
    foreach ( $list as $key => $val ) {
        if (empty ( $fields )) {
            $data [$val [$Model->getPk ()]] = $val;
        } else {
            // 获取需要的字段
            if (is_string ( $fields )) {
                $fields = explode ( ',', $fields );
            }
            if (count ( $fields ) == 1) {
                $data [$val [$Model->getPk ()]] = $val [$fields [0]];
            } else {
                foreach ( $fields as $field ) {
                    $data [$val [$Model->getPk ()]] [] = $val [$field];
                }
            }
        }
    }
    $savefile = cmsgetcache ( $name );
    // 所有参数统一为大写
    $content = "<?php\nreturn " . var_export ( array_change_key_case ( $data, CASE_UPPER ), true ) . ";\n?>";
    file_put_contents ( $savefile, $content );
}

function cmsgetcache($name = '') {
    return DATA_PATH . '~' . strtolower ( $name ) . '.php';
}
function getStatus($status, $imageShow = true) {
    switch ($status) {
        case 0 :
            $showText = '禁用';
            $showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/locked.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="禁用">';
            break;
        case 2 :
            $showText = '待审';
            $showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/prected.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="待审">';
            break;
        case - 1 :
            $showText = '删除';
            $showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="删除">';
            break;
        case 1 :
        default :
            $showText = '正常';
            $showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="正常">';

    }
    return ($imageShow === true) ?  $showImg  : $showText;

}
function getDefaultStyle($style) {
    if (empty ( $style )) {
        return 'blue';
    } else {
        return $style;
    }

}
function IP($ip = '', $file = 'UTFWry.dat') {
    $_ip = array ();
    if (isset ( $_ip [$ip] )) {
        return $_ip [$ip];
    } else {
        import ( "ORG.Net.IpLocation" );
        $iplocation = new IpLocation ( $file );
        $location = $iplocation->getlocation ( $ip );
        $_ip [$ip] = $location ['country'] . $location ['area'];
    }
    return $_ip [$ip];
}

function getNodeName($id) {
    if (Session::is_set ( 'nodeNameList' )) {
        $name = Session::get ( 'nodeNameList' );
        return $name [$id];
    }
    $Group = D ( "Node" );
    $list = $Group->getField ( 'id,name' );
    $name = $list [$id];
    Session::set ( 'nodeNameList', $list );
    return $name;
}

function get_pawn($pawn) {
    if ($pawn == 0)
        return "<span style='color:green'>没有</span>";
    else
        return "<span style='color:red'>有</span>";
}
function get_patent($patent) {
    if ($patent == 0)
        return "<span style='color:green'>没有</span>";
    else
        return "<span style='color:red'>有</span>";
}


function getNodeGroupName($id) {
    if (empty ( $id )) {
        return '未分组';
    }
    if (isset ( $_SESSION ['nodeGroupList'] )) {
        return $_SESSION ['nodeGroupList'] [$id];
    }
    $Group = D ( "Group" );
    $list = $Group->getField ( 'id,title' );
    $_SESSION ['nodeGroupList'] = $list;
    $name = $list [$id];
    return $name;
}

function getCardStatus($status) {
    switch ($status) {
        case 0 :
            $show = '未启用';
            break;
        case 1 :
            $show = '已启用';
            break;
        case 2 :
            $show = '使用中';
            break;
        case 3 :
            $show = '已禁用';
            break;
        case 4 :
            $show = '已作废';
            break;
    }
    return $show;

}

// zhanghuihua@msn.com
function showStatus($status, $id, $callback="") {
    switch ($status) {
        case 0 :
            $info = '<a href="__URL__/resume/id/' . $id . '/navTabId/__MODULE__" target="navTabTodo" callback="'.$callback.'">恢复</a>';
            break;
        case 2 :
            $info = '<a href="__URL__/pass/id/' . $id . '/navTabId/__MODULE__" target="navTabTodo" callback="'.$callback.'">批准</a>';
            break;
        case 1 :
            $info = '<a href="__URL__/forbid/id/' . $id . '/navTabId/__MODULE__" target="navTabTodo" callback="'.$callback.'">禁用</a>';
            break;
        case - 1 :
            $info = '<a href="__URL__/recycle/id/' . $id . '/navTabId/__MODULE__" target="navTabTodo" callback="'.$callback.'">还原</a>';
            break;
    }
    return $info;
}

/**
+----------------------------------------------------------
 * 获取登录验证码 默认为4位数字
+----------------------------------------------------------
 * @param string $fmode 文件名
+----------------------------------------------------------
 * @return string
+----------------------------------------------------------
 */
function build_verify($length = 4, $mode = 1) {
    return rand_string ( $length, $mode );
}


function getGroupName($id) {
    if ($id == 0) {
        return '无上级组';
    }
    if ($list = F ( 'groupName' )) {
        return $list [$id];
    }
    $dao = D ( "Role" );
    $list = $dao->findAll ( array ('field' => 'id,name' ) );
    foreach ( $list as $vo ) {
        $nameList [$vo ['id']] = $vo ['name'];
    }
    $name = $nameList [$id];
    F ( 'groupName', $nameList );
    return $name;
}
function sort_by($array, $keyname = null, $sortby = 'asc') {
    $myarray = $inarray = array ();
    # First store the keyvalues in a seperate array
    foreach ( $array as $i => $befree ) {
        $myarray [$i] = $array [$i] [$keyname];
    }
    # Sort the new array by
    switch ($sortby) {
        case 'asc' :
            # Sort an array and maintain index association...
            asort ( $myarray );
            break;
        case 'desc' :
        case 'arsort' :
            # Sort an array in reverse order and maintain index association
            arsort ( $myarray );
            break;
        case 'natcasesor' :
            # Sort an array using a case insensitive "natural order" algorithm
            natcasesort ( $myarray );
            break;
    }
    # Rebuild the old array
    foreach ( $myarray as $key => $befree ) {
        $inarray [] = $array [$key];
    }
    return $inarray;
}

/**
+----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
+----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
+----------------------------------------------------------
 * @return string
+----------------------------------------------------------
 */
function rand_string($len = 6, $type = '', $addChars = '') {
    $str = '';
    switch ($type) {
        case 0 :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
            break;
        case 1 :
            $chars = str_repeat ( '0123456789', 3 );
            break;
        case 2 :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
            break;
        case 3 :
            $chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
            break;
        default :
            // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
            $chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
            break;
    }
    if ($len > 10) { //位数过长重复字符串一定次数
        $chars = $type == 1 ? str_repeat ( $chars, $len ) : str_repeat ( $chars, 5 );
    }
    if ($type != 4) {
        $chars = str_shuffle ( $chars );
        $str = substr ( $chars, 0, $len );
    } else {
        // 中文随机字
        for($i = 0; $i < $len; $i ++) {
            $str .= msubstr ( $chars, floor ( mt_rand ( 0, mb_strlen ( $chars, 'utf-8' ) - 1 ) ), 1 );
        }
    }
    return $str;
}
function pwdHash($password, $type = 'md5') {
    return hash ( $type, $password );
}

//截取字符串的长度utf-8
function utf_substr($str, $start, $len) {
    if (strlen ( $str ) < $start) {
        return "";
    }
    $start = (ceil ( $start / 3 )) * 3;
    $str = substr($str,$start);
    $new_str = array();
    for($i = 0; $i < $len; $i ++) {
        $temp_str = substr ( $str, 0, 1 );
        if (ord ( $temp_str ) > 127) {
            $i ++;
            if ($i < $len) {
                $new_str [] = substr ( $str, 0, 3 );
                $str = substr ( $str, 3 );
            }
        } else {
            $new_str [] = substr ( $str, 0, 1 );
            $str = substr ( $str, 1 );
        }
    }
    if (count ( $new_str ) > 1) {
        return implode( $new_str );
    } else {
        return $new_str [0];
    }
}
//计算文件的大小
function getRealSize($size){
    $kb = 1024; // Kilobyte
    $mb = 1024 * $kb; // Megabyte
    $gb = 1024 * $mb; // Gigabyte
    $tb = 1024 * $gb; // Terabyte
    if ($size < $kb) {
        return $size . " B";
    } else if ($size < $mb) {
        return round ( $size / $kb, 2 ) . " KB";
    } else if ($size < $gb) {
        return round ( $size / $mb, 2 ) . " MB";
    } else if ($size < $tb) {
        return round ( $size / $gb, 2 ) . " GB";
    } else {
        return round ( $size / $tb, 2 ) . " TB";
    }
}
/*
*	查询某个值是否在指定字段中出现
*	$str 要查询的字符串
*	$field 字段名
*	$array 要查询的数组
*/
function array_search_i($str,$field,$array){
    foreach($array as $key => $value) {
        if($str == $value[$field]) return $key;
    }
    return false;
}
/*
*	排序字段
*/
function orderField($field){
    if(empty($field))return '';
    $str = "orderField=\"$field\"";
    if($_REQUEST['orderField'] == $field){
        $str.=' class="'.$_REQUEST['orderDirection'].'"';
    }
    return $str;
}

/**
 * 获取二维数组某一key对应的所有值
 * @param  array $arr 数组
 * @param  string $field key
 * @param  bool $skipEmpty 是否跳过空值，默认true
 */
function get_array_value_list($arr, $field, $skipEmpty = true)
{
    $ret = array();
    foreach ($arr as $key => $val) {
        if (! $val) continue;
        if ($skipEmpty && empty($val[$field])) continue;
        $ret[] = $val[$field];
    }
    return $ret;
}

/**
 * 数组转hash map
 */
function array2hashmap($arr, $field = 'id')
{
    $ret = array();
    foreach ($arr as $val) {
        if (!isset($val[$field])) continue;
        $ret[$val[$field]] = $val;
    }
    return $ret;
}

//获取图片的相似色和相似度
function get_color_cls($path)
{
    if(!is_file($path)){
        return false;
    }
    $arr = getimagesize($path);
    $im = imagecreatefromjpeg($path);
    $r_c = 0; $g_c=0;$b_c = 0;
    for($w = 1;$w < $arr[0]; $w++){
        for($h = 1;$h < $arr[1]; $h++){
            //颜色索引 获取没一像素颜色的索引之和
            $rgb = ImageColorAt($im, $w, $h);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $r_c += $r;
            $g_c += $g;
            $b_c += $b;
        }
    }
    imagedestroy($im);
    $n = ($arr[0]) * ($arr[1]);
    $r = round($r_c / $n);//echo "<br/>";
    $g = round($g_c / $n);//echo "<br/>";
    $b = round($b_c / $n);//echo "<br/>";
    $arr = array();
    $d = (255-$r)*(255-$r)+(0-$g)*(0-$g)+(0-$b)*(0-$b);
    $arr[] = array($d,1,'红');
    $d = (255-$r)*(255-$r)+(153-$g)*(153-$g)+(51-$b)*(51-$b);
    $arr[] = array($d,2,'橙');
    $d = (255-$r)*(255-$r)+(255-$g)*(255-$g)+(0-$b)*(0-$b);
    $arr[] = array($d,3,'黄');
    $d = (51-$r)*(51-$r)+(504-$g)*(204-$g)+(51-$b)*(51-$b);
    $arr[] = array($d,4,'绿');
    $d = (51-$r)*(51-$r)+(51-$g)*(51-$g)+(204-$b)*(204-$b);
    $arr[] = array($d,5,'蓝');
    $d = (153-$r)*(153-$r)+(51-$g)*(51-$g)+(153-$b)*(153-$b);
    $arr[] = array($d,6,'紫');
    $d = (255-$r)*(255-$r)+(153-$g)*(153-$g)+(204-$b)*(204-$b);
    $arr[] = array($d,7,'粉');
    $d = (153-$r)*(153-$r)+(102-$g)*(102-$g)+(51-$b)*(51-$b);
    $arr[] = array($d,8,'棕');
    $d = (0-$r)*(0-$r)+(0-$g)*(0-$g)+(0-$b)*(0-$b);
    $arr[] = array($d,9,'黑');
    $d = ((255-$r)*(255-$r)+(255-$g)*(255-$g)+(255-$b)*(255-$b) );
    $arr[] = array($d,10,'白');
    $c = min($arr);
    return $c;
}
//统计子文章总数
function CountSubArc($id){
    $ArcSub = M("ArticleSub");
    $count = $ArcSub->where("arc_id = ".$id)->count();
    return $count;
}
function image_typethumb($image, $size, $type = 'max'){
    if (is_array($image)) {
        if(!empty($image['image_thumb'])){
            $image = $image['image_thumb'];
        }else if(isset($image['original_image'])){
            $image = $image['original_image'];
        }else{
            $image = $image['originalImage'] ? $image['originalImage'] : $image['thumb'];
        }
    }
    $image = str_replace('http://img.wallba.com/', '', $image);
    return $image ? "http://img.wallba.com/ImagesCache/{$size}{$type}/" . ltrim($image, '/') : "";
}

