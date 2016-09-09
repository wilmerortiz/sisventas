<?php
App::uses('AppController', 'Controller');

class RolsController extends AppController {

	public function index() {

	}

	public function data_server()
	{
		if($this->request->is('ajax')):
			$requestData= $_REQUEST;

			$columns = array(
				0 => 'id',
				1 => 'descripcion'
			);

			$sql = $this->Rol->query("SELECT * FROM rols WHERE estado = 'A'");

			$totalData = $this->Rol->find('count',['conditions'=>['Rol.estado'=>'A']]);
			$totalFiltered = $totalData;  

			$sql = "SELECT * FROM rols WHERE estado = 'A' " ;

			if( !empty($requestData['search']['value']) ) {
				$cant_array = count($columns);
				
				foreach ($columns as $k => $v) {
					if ($k==0) // ES LA PRIMERA VUELTA DEL ARRAY
						$sql.=" AND ( cast({$v} as character varying) ILIKE '%".$requestData['search']['value']."%' "; 
					else
						if ( ($cant_array-1)== $k) // YA ES LA ULTIMA VUELTA DEL ARRAY
							$sql.=" OR ( cast({$v} as character varying) ILIKE '%".$requestData['search']['value']."%' ))";
						else
							$sql.=" OR ( cast({$v} as character varying) ILIKE '%".$requestData['search']['value']."%' )";	
				}
			}

			$totalFiltered = $this->Rol->find('count',['conditions'=>['Rol.estado'=>'A']]);

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['length']." OFFSET ".$requestData['start']." ";

			$query=$this->Rol->query($sql);

			$data = array();
			foreach ($query as $row):
				$nestedData=array(); 
				$nestedData[] = $row[0]["id"];
				$nestedData[] = $row[0]["descripcion"];
				
				$data[] = $nestedData;
			endforeach;

			$json_data = array(
						"draw"            => intval( $requestData['draw'] ),   
						"recordsTotal"    => intval( $totalData ),
						"recordsFiltered" => intval( $totalFiltered ),
						"data"            => $data
						);

			echo json_encode($json_data);

		endif;
		$this->autoRender=false;
	}

	public function add() {
		if ($this->request->is('post')) {

			$id = $this->Rol->find('all',['fields'=>['MAX(Rol.id) as id'],'conditions'=>['Rol.estado'=>'A']]);
			$id = (int) $id[0][0]['id'];
			$id = str_pad($id +1,2,'0',STR_PAD_LEFT);
			$this->Rol->create();
			$this->request->data['Rol']['id'] = $id;
			if ($this->Rol->save($this->request->data)) {
				$this->Flash->msg_success('Rol guardado correctamente.','msg_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->msg_error('A ocurrido un error, intentelo mas tarde','msg_error');
			}
		}
	}

	public function return_data()
	{
		$id = $this->data['id'];
		//debug($id);
		$data = $this->Rol->find('all',['conditions'=>['Rol.id'=>$id]]);
		//debug($data);exit();
		echo json_encode($data);
		$this->autoRender = false;
	}

	public function edit($id = null) {
		$id = $this->request->data['Rol']['id'];
		if (!$this->Rol->exists($id)) {
			throw new NotFoundException(__('Rol invalido o no existe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rol->save($this->request->data)) {
				$this->Flash->msg_success('Perfil guardado correctamente.','msg_success');
				return $this->redirect(array('action' => 'index'));
				
			} else {
				$this->Flash->msg_error('Ha ocurrido un error.','msg_error');
				return $this->redirect(array('action' => 'index'));
			}
		}
		
	}

	function eliminar($id = null)
	{
		$id = $this->data['id'];
		$estado = 'I';

		$datanew = array('estado' => $estado, 'id' => $id);
		$this->Rol->create();

		if($this->Rol->save($datanew))
		{
            $result="Registro anulado";
		}else{
			$result="A ocurrido un error";
		}
		echo json_encode($result);
		$this->autoRender = false;
	}
}
