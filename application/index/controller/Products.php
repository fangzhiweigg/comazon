<?php
namespace app\index\controller;
use think\Request;
// use think\Db;
use app\index\model\Product;
use app\index\model\Mark;
use app\index\model\Vpurchased;
use app\index\model\Purchased;
class Products extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $this->product = new Product;
        $this->mark = new Mark;
        $this->purchased = new Purchased; // 表用于写入和删除
        $this->vpurchased = new Vpurchased; // 视图
    }


    // 商品懒加载方法
    public function getList(Request $request){
        $page_size = intval($request->param('page_size'));  //每页显示条数
        $count = $this->product->count();  //总记录数
        $res['total_page'] = ceil($count/$page_size);  //总页数
        $cur_page = intval($request->param('page'))-1;  //默认前端page传过来为1 
        $res['data'] = $this->product
            ->limit(($cur_page*$page_size),$page_size)  //limit默认要从零开始
            ->select();
        // dump($this->product->getLastSql());die;
        return json($res);  //返回json
    }


    // 商品列表页
    public function productsList(){
        // 模板输出
        return  $this->fetch();
    }

    // 商品详情页
    public function productsDetail(){
        $product_id = input(); 
        // product_id是关键字段可以直接可以用model的静态方法直接get到详情
        $detail = Product::get($product_id);
        $this->assign('detail', $detail);

        // 输出当日下单列表
        $dayPurchase = $this->vpurchased->dayPurchase();
        // var_dump($dayPurchase);
        $this->assign('dayPurchase', $dayPurchase);

        // 输出当周下单列表
        $weekPurchase = $this->vpurchased->weekPurchase();
        // var_dump($weekPurchase);
        $this->assign('weekPurchase', $weekPurchase);


        // 模板输出
        return  $this->fetch();
    }

    // 订单完善页面
    public function orderComplete(){
        $data = input();
        $purchased_id = $data['purchased_id'];
        $res = Vpurchased::get(['purchased_id' => $purchased_id]);
        $this->assign('order', $res);
        // var_dump($data);
        // echo $data['purchased_id'];
        // 模板输出
        return  $this->fetch();
    }

    // 订单完善后的提交
    public function orderCompleteSubmit()
    {
        $res = $this->purchased->allowField(true)->save($_POST,['id' => $_POST['purchased_id']]);
        return $res;
    }

    // review截图 上传
    public function uploadReview(Request $request){
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'uploadReview');
        $res = array();  //定义一个返回的数组
        if($info){
            $res['code']= 1;
            $res['msg'] = 'Upload success!';
            $res['savename'] = "uploadReview/".$info->getSaveName(); 
        }else{
            // 上传失败获取错误信息
            $res['code']= 0;
            $res['msg'] = 'Failed to upload!';
            $res['savename'] = ""; 
            $res['err'] = $file->getError();
        }
        return $res;
    }
    

    // 添加收藏
    public function addMark()
    {   // $data:['username'=>xxxx, 'product_id'=>12]
        $data = input();
        if($this->mark->add($data)){
            return 1; // 存在返回 1
        } else {
            return 0; // 不存在返回 0
        }
    }

    // 移除收藏
    public function removeMark()
    {   // $data:['username'=>xxxx, 'product_id'=>12]
        $data = input();
        if($this->mark->remove($data)){
            return 1; // 存在返回 1
        } else {
            return 0; // 不存在返回 0
        }
    }


    // 添加已购
    public function addPurchased()
    {   // $data:['username'=>xxxx, 'product_id'=>12]
        $data = input();
        if($this->purchased->add($data)){
            return 1; // 存在返回 1
        } else {
            return 0; // 不存在返回 0
        }
    }

    // 移除已购
    public function removePurchased()
    {   
        // $data:['username'=>xxxx, 'purchased_id'=>12]
        $data = input();
        if($this->purchased->remove($data)){
            return 1; // 存在返回 1
        } else {
            return 0; // 不存在返回 0
        }
    }


}