<?php
namespace app\index\controller;

class Index extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        
    }

    public function index(){
        // 模板输出
        return  $this->fetch();
    }


}