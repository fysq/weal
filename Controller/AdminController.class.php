<?php 
namespace Weal\Controller;
use Think\Controller;
use Think\Model;

Header("Content-type: text/html; charset=UTF-8"); 
class AdminController extends Controller
{
	public function _initialize(){
		$this->assign("PROOT",__ROOT__.'/'.APP_NAME.'/Weal/public/');
		$this->checklogin();
		$menu[CONTROLLER_NAME][0]='active';
		$menu[CONTROLLER_NAME][1]='style="display:block"';
		$menu[CONTROLLER_NAME][ACTION_NAME]='active';
		$this->assign("menu",$menu);
		// MODULE_NAME,CONTROLLER_NAME,ACTION_NAME
	}

	private function checklogin(){
		if(in_array(ACTION_NAME,array("log"))){
			if(session('?adminlog')){
				if(IS_POST){
					$this->ajaxReturn("请先登录");
				}else{
					redirect(U('index/index'));
				}
			}
		}else{
			if(!session('?adminlog')){
				if(IS_POST){
					$this->ajaxReturn("请先登录");
				}else{
					redirect(U('index/log'));
				}
			}
		}
	}
}

 ?>