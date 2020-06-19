<?php
namespace app\api\model;
use think\Model;

class BaseModel extends Model{
    //项目部署前
    //生成数据库表的缓存信息
    //runtime->schema
    //命令行下执行:php think optimize:schema

    //拼接本地url
    protected function prefixImgUrl($value,$data){
        $finalUrl = $value;
        //from=1,是本地图片
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;//读取配置,拼接图片URL
        }
        return $finalUrl;//返回完整的图片url
    }
}