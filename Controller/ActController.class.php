<?php 
namespace Weal\Controller;
use Weal\Controller\AdminController;

Header("Content-type: text/html; charset=UTF-8"); 
class ActController extends AdminController
{
	public function act_list(){
		$where['1']="1";
		$page = I("get.page","1").",".C("PageSize");
		if(session('admininfo.aid')!="1"){
			$where['aid']=session('admininfo.aid');
		}
		$list = D("act")->join(C('DB_PREFIX').'adminuser b ON '.C('DB_PREFIX')."act.aid = b.aid")->page($page)->where($where)->select();
		// echo "<pre>";
		// print_r($list);
		// exit;
		$this->assign('list',$list);
		$this->display();
		// echo c("DB_NAME");
	}

	public function act_add(){
		$aid = session('admininfo.aid');
		$initdata['aid'] = $aid;
		$initdata['name'] = '待配置';
		$initdata['addtime'] = time();
		D("act")->add($initdata);
		$this->ajaxReturn("success");
	}

	public function act_edit(){
		if(IS_POST){

		}else{
			$id = I("get.id");
			$ainfo = D("act")->where('id='.$id)->find();
			$this->assign('ainfo',$ainfo);
			$this->display();
		}
	}
}

 ?>