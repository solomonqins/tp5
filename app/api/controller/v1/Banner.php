<?php
namespace app\api\controller\v1;
use app\api\model\Image;
use app\api\validate\IDMustBePostiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;
use think\Exception;
use think\Log;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     * **/
    public function getBanner($id)
    {
        (new IDMustBePostiveInt())->goCheck();//效验参数
        $banner = BannerModel::getBannerByID($id);//调用模型
        if(!$banner)
        {
            throw new BannerMissException();//抛出异常
        }
        return $banner;
    }

}

