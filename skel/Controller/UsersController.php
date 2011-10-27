<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public function beforeFilter() {
		$this->Auth->authenticate = array(
			'Form'=>array(
				'fields' => array(
							'username' => 'email',
							'password' => 'password'
				),
				'userModel' => 'User',
				'scope' => array('User.status' => 1),
			)
		);
		parent::beforeFilter();
	}
/**
 * login method
 *
 * @return void
 */
	public function login(){
		$this->layout = 'login';
		if($this->request->is('post')){
			if($this->Auth->login()){
				$this->Session->setFlash('ログインしました','alert',array('class'=>'info'));
				return $this->redirect('/');
			}else{
				$this->Session->setFlash('ログインに失敗しました','alert',array('class'=>'error'));
			}
		}
	}
/**
 * logout method
 *
 * @return void
 */
	public function logout(){
		$this->Auth->logout();
		$this->Session->setFlash('ログアウトしました','alert',array('class'=>'info'));
		return $this->redirect($this->Auth->redirect());
	}

}
