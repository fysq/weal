<?php 
namespace Weal\Controller;
use Weal\Controller\AdminController;

Header("Content-type: text/html; charset=UTF-8"); 
class IndexController extends AdminController
{
	public function index(){
		$this->display();
	}
	public function log(){
		$this->display();
	}
}

 ?>