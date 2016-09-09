<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
/*
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	public function login()
	{
		if ($this->request->is('post')) 
		{
			if ($this->Auth->login()) 
			{
				return $this->redirect($this->Auth->redirectUrl());
			}
			
			$this->Flash->msg_error('usuario y/o controseña son incorrectos','msg_error');
		}
	}

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
*/	
	public function index() {
		
	}

	public function add() {

		if ($this->request->is('post')) {
			//debug($this->request->data);exit();
			$id = $this->User->find('all',['fields'=>['MAX(User.id) as id']]);
			$id = (int)  $id[0][0]['id'];
			$id = str_pad($id+1,3,"0",STR_PAD_LEFT);

			$this->User->create();
			$this->request->data['User']['id'] = $id;
			if ($this->User->save($this->request->data)) {
				$this->Flash->msg_success(__('The user has been saved.'),'msg_success');
				return $this->redirect(array('action' => '?sistema_id='.$_GET['sistema_id'].'&sistema='.$_GET['sistema']));
			} else {
				$this->Flash->msg_error(__('A ocurrido un error'),'msg_error');
			}
		}
		$rols = $this->User->Perfil->find('list');
		$this->set(compact('rols'));
	}

	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => '?sistema_id='.$_GET['sistema_id'].'&sistema='.$_GET['sistema']));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		
	}
		
	function eliminar($id = null)
	{
		$estado = 'I';

		$datanew = array('estado' => $estado, 'id' => $id);
		$this->User->create();

		if($this->User->save($datanew))
		{
            $result="Registro anulado";
		}else{
			$result="A ocurrido un error";
		}
		echo json_encode($result);
		$this->autoRender = false;
	}
}
