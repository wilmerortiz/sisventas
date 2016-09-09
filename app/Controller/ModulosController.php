<?php
App::uses('AppController', 'Controller');

class ModulosController extends AppController {

	public function index() {

	}

	public function data_server()
	{
		if($this->request->is('ajax')):
			$requestData= $_REQUEST;

			$columns = array(
				0 => 'id',
				1 => 'modulos',
				2 => 'url'
			);

			$sql = $this->Modulo->query("SELECT * FROM modulos WHERE estado = 'A'");

			$totalData = $this->Modulo->find('count',['conditions'=>['Modulo.estado'=>'A']]);
			$totalFiltered = $totalData;  

			$sql = "SELECT * FROM modulos WHERE estado = 'A' " ;

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

			$totalFiltered = $this->Modulo->find('count',['conditions'=>['Modulo.estado'=>'A']]);

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."  ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['length']." OFFSET ".$requestData['start']." ";

			$query=$this->Modulo->query($sql);

			$data = array();
			foreach ($query as $row):
				$nestedData=array(); 
				$nestedData[] = $row[0]["id"];
				$nestedData[] = $row[0]["modulos"];
				$nestedData[] = $row[0]["url"];
				
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

			$id = $this->Modulo->find('all',['fields'=>['MAX(Modulo.id) as id'],'conditions'=>['Modulo.estado'=>'A']]);
			$id = (int) $id[0][0]['id'];
			$id = str_pad($id +1,3,'0',STR_PAD_LEFT);
			$this->Modulo->create();
			$this->request->data['Modulo']['id'] = $id;
			if(empty($this->request->data['Modulo']['id_padre'])):
				$this->request->data['Modulo']['id_padre'] = 0;
			endif;
			if ($this->Modulo->save($this->request->data)) {
				$this->Flash->msg_success('Modulo guardado correctamente.','msg_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->msg_error('A ocurrido un error, intentelo mas tarde','msg_error');
			}
		}

		$modulos = $this->Modulo->find('list',['conditions'=>['Modulo.estado'=>'A','Modulo.id_padre'=>0]]);
		$this->set(compact('modulos'));
	}

	public function return_data()
	{
		$id = $this->data['id'];
		//debug($id);
		$data = $this->Modulo->find('all',['conditions'=>['Modulo.id'=>$id]]);
		//debug($data);exit();
		echo json_encode($data);
		$this->autoRender = false;
	}

	public function edit($id = null) {
		$id = $this->request->data['Modulo']['id'];
		if (!$this->Modulo->exists($id)) {
			throw new NotFoundException(__('Modulo invalido o no existe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Modulo->save($this->request->data)) {
				$this->Flash->msg_success('Modulo guardado correctamente.','msg_success');
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
		$this->Modulo->create();

		if($this->Modulo->save($datanew))
		{
            $result="Registro anulado";
		}else{
			$result="A ocurrido un error";
		}
		echo json_encode($result);
		$this->autoRender = false;
	}

	public function getModulosPadres()
	{
		$data = $this->Modulo->find('all',['conditions'=>['Modulo.estado'=>'A','Modulo.id_padre'=>0]]);
		echo json_encode($data);
		$this->autoRender = false;
	}
}
