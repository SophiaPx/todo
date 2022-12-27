<?php
namespace app\index\controller;
use think\Exception;
use think\Db;
use think\Controller;
use think\Request;


class Index extends Controller
{
    public function index()
    {
        $task_info = Db::table('tasks')
      ->where('status',0)
      ->select();
        $this->assign("task",$task_info);
        $finish = Db::table('tasks')
      ->where('status',1)
      ->select();
        $this->assign("finish",$finish);
        return $this->fetch();

    }
    
    public function save()
    {
        $request = Request::instance();
        Db::table('tasks')
                ->insert([
                    'task' =>  $request->param("task"),
                    'status' =>  0,
                ]);
        $this->success("添加成功",'index/index');
    }
    
    public function change()
    {
        $request = Request::instance();
        $id = $request->param("task");
        Db::table('tasks')
                ->where('task',$id)
                ->update([
                    'status' =>  1,
                ]);
        $this->success("正在更新中",'index/index');
    }
    

}
