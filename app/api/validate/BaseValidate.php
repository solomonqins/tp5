<?php
namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck(){
        //获取http传入的参数
        //对这些参数做验效
        $request = Request::instance();
        $params = $request->param();

        //批量效验参数
        $result = $this->batch()->check($params);
        if(!$result){
            $e = new ParameterException(
                [
                    'msg' => $this->error,
                ]
            );
            throw $e;
        }else{
            return true;
        }
    }
    //判断是否是正整数
    protected function isPositiveInteger(
        $value,$rule='',
        $data='',$field='')
    {
       if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0)
       {
           return true;
       }
       else{
           return false;
       }

    }
    //判断是否是手机号
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|6|7|8|9)[0-9]\d{8}$^';
        $result = preg_match($rule,$value);//匹配
        if($result){
            return true;
        } else {
            return false;
        }
    }
    //自定义判断值不为空
    protected function isNotEmpty($value,$rule='',$data='',$field='')
    {
        if(empty($value)){
            return false;
        }
        else
        {
            return true;
        }
    }
    //过滤验证器外其他参数
    //$arrays-客户端传递过来的所有参数
    public function getDataByRule($arrays)
    {
        //判断是否包含user_id或者uid
        if(array_key_exists('user_id',$arrays) | array_key_exists('uid',$arrays))
        {
            //不允许包含user_id或者uid,防止恶意覆盖user_id外键
            throw new ParameterException(
                [
                    'msg' => '参数中包含有非法的参数名user_id或者uid'
                ]
            );//抛出异常
        }
        $newArray = [];
        //规则遍历
        foreach ($this->rule as $key => $value)
        {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;//返回数据
    }

    
}
