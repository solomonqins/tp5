<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: JacobQins <solomonqins@outlook.com>
// +----------------------------------------------------------------------

use think\Route;

#路由访问示例
//url http://localhost/api/public/api/v1/banner/1
//url http://localhost/admin/public/admin/v1/index
################API模块路由###################

//主页
//传入不同版本号(v1,v2),根据id获取对应的Banner
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');


################Admin模块路由#################
//测试 模块->控制器->方法 
Route::get('admin/:version/index','admin/:version.Index/index');
