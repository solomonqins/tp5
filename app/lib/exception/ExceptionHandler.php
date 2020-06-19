<?php
namespace app\lib\exception;

use think\Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

//继承改写Handle类(一些方法)
class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    //需要返回客户端当前请求的URL路径
    //*通过render方法,返回异常信息
    public function render(\Exception $e)
    {
        if($e instanceof BaseException)
        {
            //如果是自定义异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }
        else
        {
            //服务器的异常
            if(config('app_debug'))
            {
                return parent::render($e);
            }
            else
            {
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorCode = 999;
                $this->recordErrorLog($e);//记录日志
            }
        }
        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url()
        ];
        return json($result,$this->code);
    }
    //*私有方法,输出错误日志
    private function recordErrorLog(\Exception $e)
    {
        //初始化日志配置
        Log::init(
            [
                'type' => 'File',
                'path' => LOG_PATH,
                'level' => ['error']
            ]
        );
        //记录日志
        Log::record($e->getMessage(),'error');
    }
}