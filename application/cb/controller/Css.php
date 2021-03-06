<?php
namespace app\cb\controller;
use think\Controller;
use think\Request;
use think\Db;
use app\cb\model\Cs;

class Css extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $this->cs = new Cs;
    }

    // 页面 - 水表列表
    public function cssList(){
        // 模板输出
        return  $this->fetch();
    }

    // 页面 - 添加水表
    public function cssAdd(){
        // 模板输出
        return  $this->fetch();
    }


    // 页面 - 编辑水表
    public function cssEdit(){
        $id = $_GET['id'];
        // 判断是否查询软删除数据
        if(isset($_GET['arg']) && $_GET['arg'] == 'restore') {
            $data = Cs::onlyTrashed()->where('id', $id)->find();
        } else {
            $data = Cs::get($id);
        }
        $this->assign('data', $data);
        // 模板输出
        return  $this->fetch();
    }
    // 水表回收站
    public function cssRestore(){
        // 模板输出
        return  $this->fetch();
    }
    

    // 接口 - 水表列表数据表格
    public function tableData()
    {   
        // $data: ['limit'=>10, 'page'=>1]
        $data = input();
        // $data['search_str'] = $search_str;
        return $this->cs->tableData($data);
    }

    // 接口 - 水表列表数据表格
    public function tableDataRestore(string $search_str = null)
    {   
        // $data: ['limit'=>10, 'page'=>1]
        $data = input();
        // $data['search_str'] = $search_str;
        return $this->cs->tableDataRestore($data);
    }

    // 删除水表
    public function delCs()
    {   
        $data = $_POST['id'];
        $res = Cs::destroy($data);
        return $res;
    }

    // 还原水表
    public function restoreCs()
    {   
        // 软删除的恢复 用模型的restore方法，传递的是一个where数组
        $data = $this->cs->restore(['id' => $_POST['id']]);
        return $data;
    }

    // 水表详情页
    public function cssDetail(){
        // 模板输出
        return  $this->fetch();
    }

    

    // 添加水表
    public function addItem()
    {
        $res = $this->cs->allowField(true)->save($_POST);
        return $res;
    }
    // 修改水表
    public function editItem()
    {
        $res = $this->cs->allowField(true)->save($_POST,['id' => $_POST['id']]);
        return $res;
    }



    // 水表图片上传
    public function uploadImg(Request $request){
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploadImg');
        $res = array();  //定义一个返回的数组
        if($info){
            $res['code']= 1;
            $res['msg'] = 'Upload picture success!';
            $res['savename'] = "uploadImg/".$info->getSaveName(); 
        }else{
            // 上传失败获取错误信息
            $res['code']= 0;
            $res['msg'] = 'Failed to upload!';
            $res['savename'] = ""; 
            $res['err'] = $file->getError();
        }
        return $res;
    }
    

   


}