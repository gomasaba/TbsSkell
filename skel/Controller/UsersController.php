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
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$cond =array();
		$this->User->recursive = 0;
		$this->set('users', $this->paginate(null,$cond));
	}
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if(isset($this->request->data['User']['password'])){
				$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('追加しました','alert',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('エラーがあります','alert',array('class'=>'error'));
			}
		}
	}
/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('保存しました','alert',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('保存に失敗しました','alert',array('class'=>'error'));
			}
		}else{
			$this->request->data = $this->User->read(null, $id);
		}
	}
/**
 * profile method
 *
 * @param string $id
 * @return void
 */
	public function profile($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('保存しました','alert',array('class'=>'success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('保存に失敗しました','alert',array('class'=>'error'));
			}
		}else{
			$this->request->data = $this->User->read(null, $id);
		}
	}
/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
