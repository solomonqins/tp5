<?php
namespace app\api\model;
use think\Db;
use think\Exception;
use think\Model;
class Banner extends BaseModel
{
    protected $hidden = ['update_time','delete_time'];//隐藏并且返回指定的字段
    public function items(){
        //一对多关联模型，关联BannerItem(外键)
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }
    //通过$id获取banner信息
    public static function getBannerByID($id){
        //嵌套关联关系
        $banner = self::with(['items', 'items.img'])->find($id);
        return $banner;
    }
}