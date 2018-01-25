<?php 
namespace Weal\Controller;
use Think\Controller;
use Think\Model;

class AjaxController extends Controller
{
	protected function ajaxReturn($state='-1',$msg=''){
		$data = [];
		$data['code']=$state;
		$data['msg']=$msg;
		exit(json_encode($data));
	}

	public function log(){
		$where['uname']=I("post.uname");
		$admininfo = D("adminuser")->where($where)->find();
		if($admininfo){
			if(I("post.passwd")==$admininfo['passwd']){
				if($admininfo['level']=="1" || ($admininfo['stime']<time() && $admininfo['etime']>time() && $admininfo['state'])){
					session("adminlog","1");
					session("admininfo",$admininfo);
			        $this->ajaxReturn(1,'登陆成功');
				}else{
			        $this->ajaxReturn(0,'账号已过期');
				}
			}else{
		        $this->ajaxReturn(0,'密码错误');
			}
		}else{
		        $this->ajaxReturn(0,'用户名不存在');
		    }
	}

	public function uploadimg(){
		$obj = array();
		$id= $_POST["file"];
		$randname = date("YmdHis",time()).mt_rand(10,99);
		$imgtype = substr(strrchr($_FILES[$id]['name'], '.'), 1);
		$upFilePath = dirname(dirname(__FILE__))."/public/upload/".$randname.".".$imgtype;
		$ok=move_uploaded_file($_FILES[$id]['tmp_name'],$upFilePath);
		 if($ok === FALSE){
		  $obj['code']='0';
		 }else{
		  $obj['code']='1';
		  $obj['msg']='http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/Application/Weal/public/upload/".$randname.".".$imgtype;
		 }
		  echo json_encode($obj);
	}
}

 ?>