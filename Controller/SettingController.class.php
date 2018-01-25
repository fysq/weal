<?php 
namespace Weal\Controller;
use Weal\Controller\AdminController;

Header("Content-type: text/html; charset=UTF-8"); 
class SettingController extends AdminController
{
	// 公众号列表
	public function gzh_list(){
		$list = D("gzh")->select();
		$this->assign("list",$list);
		$this->display();
	}
	// 新增公众号
	public function gzh_add(){
		if(IS_POST){
			$data = I("post.");
			$data['addtime'] = time();
			D("gzh")->add($data); 
			echo json_encode("新增公众号成功");
		}else{
			$this->display('gzh');
		}

	}
	// 编辑公众号
	public function gzh_edit(){
		$gid = I("get.gid");
		if(IS_POST){
			$data = I("post.");
			D("gzh")->where('gid='.$gid)->save($data); 
			echo json_encode("编辑公众号成功");
		}else{
			$gzh = D("gzh")->where('gid='.$gid)->find();
			// print_r($gzh);
			$this->assign("gzh",$gzh);
			$this->display('gzh');
		}

	}
	// 删除公众号
	public function gzh_del(){
		$gid = I("POST.gid");
		D("gzh")->where("gid=".$gid)->delete();
		$this->ajaxReturn("success");
	}
}

 ?>