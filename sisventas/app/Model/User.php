<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * @property Perfil $Perfil
 * @property Sucursal $Sucursal
 * @property TipoDocumento $TipoDocumento
 * @property Caja $Caja
 * @property Venta $Venta
 */
class User extends AppModel {
	public $useDbConfig = 'seguridad';

	public $belongsTo = array(
		'Personal' => array(
			'className' => 'Personal',
			'foreignKey' => 'personal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Perfil' => array(
			'className' => 'Perfil',
			'foreignKey' => 'perfil_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/*
		'TipoDocumento' => array(
			'className' => 'TipoDocumento',
			'foreignKey' => 'tipo_documento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Caja' => array(
			'className' => 'Caja',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Venta' => array(
			'className' => 'Venta',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Compra' => array(
			'className' => 'Compra',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'OrdenCompra' => array(
			'className' => 'OrdenCompra',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SolicitudCompra' => array(
			'className' => 'SolicitudCompra',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function beforeSave($options = array()) {

	    if (isset($this->data[$this->alias]['password'])) 
	    {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}

	public function GetData() 
	{
		//include('DataSource/ssp.class.psql.php');
		$table = "seguridad.v_users";
		$primaryKey = "id";

        $columns = array(
		    array( 'db' => 'id', 'dt' => 0 ),
		    array( 'db' => 'rol',  'dt' => 1 ),
		    array( 'db' => 'personal',  'dt' => 2 ),
		    array( 'db' => 'username',  'dt' => 3 )
		);

		$conditions = "";
         
        App::uses('ConnectionManager', 'Model');
        $dataSource = ConnectionManager::getDataSource('seguridad');
         
        /* Database connection information */
        $gaSql['user']       = $dataSource->config['login'];
        $gaSql['password']   = $dataSource->config['password'];
        $gaSql['db']         = $dataSource->config['database'];
        $gaSql['server']     = $dataSource->config['host'];

        $sql_details = array(
		    'user' => $gaSql['user'],
		    'pass' => $gaSql['password'],
		    'db'   => $gaSql['db'],
		    'host' => $gaSql['server']
		);
        require( 'ssp.class.psql.php' );
        
		$out = SSP::simple( $_REQUEST, $sql_details, $table, $primaryKey, $columns, $conditions );
		return $out;
    }

}
