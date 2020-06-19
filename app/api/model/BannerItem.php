<?php
namespace app\api\model;

use think\Model;

class BannerItem extends BaseModel
{
    protected $hidden  = ['id','img_id','banner_id','update_time','delete_time'];//隐藏并且返回指定的字段
    
    public function img()
    {
        //一对一关联模型
        return $this->belongsTo('Image','img_id','id');
    }
    
}