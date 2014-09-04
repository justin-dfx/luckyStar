<?php
$config	= array(
    'URL_MODEL'=>3, // 如果你的环境不支持PATHINFO 请设置为3
	'DB_TYPE'=>'mysql',


	'DB_HOST'=>'gomenuhub3.db.10698022.hostedresource.com',
	'DB_NAME'=>'gomenuhub3',
	'DB_USER'=>'gomenuhub3',
	'DB_PWD'=>'hub3@ADS0701',



	'DB_PORT'=>'3306',
	'DB_PREFIX'=>'on_',//表前缀
	'CACHE_TIME'=>3600,//缓存时间 单位是秒

	'APP_DEBUG' => false,	//调试模式开关
	'TOKEN_ON'=>false, 
	'TMPL_CACHE_ON' =>  false,	//默认开启模板编译缓存 false 的话每次都重新编译模板
	

	
	

	'PAGE_LISTROWS'=>'21', //默认分页每页显示条数

	'USER_AUTH_ON'=>true,
	'USER_AUTH_TYPE'			=>1,		// 默认认证类型 1 登录认证 2 实时认证
	'USER_AUTH_KEY'			=>'authId',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'			=>'administrator',
	'USER_AUTH_MODEL'		=>'User',	// 默认验证数据表模型
	'AUTH_PWD_ENCODER'		=>'md5',	// 用户认证密码加密方式
	'USER_AUTH_GATEWAY'	=>'/Public/login',	// 默认认证网关
	'NOT_AUTH_MODULE'		=>'Public',		// 默认无需认证模块
	'REQUIRE_AUTH_MODULE'=>'',		// 默认需要认证模块
	'NOT_AUTH_ACTION'		=>'',		// 默认无需认证操作
	'REQUIRE_AUTH_ACTION'=>'',		// 默认需要认证操作
    'GUEST_AUTH_ON'          => false,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'           =>    0,     // 游客的用户ID

    'DB_LIKE_FIELDS'=>'title|remark',
	'RBAC_ROLE_TABLE'=>'role',
	'RBAC_USER_TABLE'	=>	'role_user',
	'RBAC_ACCESS_TABLE' =>	'access',
	'RBAC_NODE_TABLE'	=> 'node',
	'MCRYPT_DES_KEY'=>'huayukej',//xml文件des加密密码
);
$siteconfig	=	require './Admin/siteconfig.inc.php';
return array_merge($config,$siteconfig);
?>
