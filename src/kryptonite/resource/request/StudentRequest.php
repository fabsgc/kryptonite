<?php
	namespace Controller\Request\Kryptonite;

	use \System\Request\Form;

	class StudentRequest extends Form{

		public function init(){
			$this->form = 'form-student';
		}

		public function post(){
			$this->validation->text('username', 'Nom d\'utilisateur')
				->sql([
					'query' => 'SELECT COUNT(*) FROM user WHERE username = :value',
					'constraint' => '==',
					'value' => 0,
					'vars' => []
				], 'Ce nom d\'utilisateur est déjà pris')
				->lengthMin(6, 'le nom d\'utilisateur doit faire 6 caractères minimum');;

			$this->validation->text('email', 'Email')
				->mail('Cet email n\'est pas valide')
				->sql([
					'query' => 'SELECT COUNT(*) FROM user WHERE email = :value',
					'constraint' => '==',
					'value' => 0,
					'vars' => []
				], 'cet email est déjà associé à un autre compte');
		}

		public function put(){
			$this->validation->text('username', 'Nom d\'utilisateur')
				->sql([
					'query' => 'SELECT COUNT(*) FROM user WHERE username = :value AND id != :id',
					'constraint' => '==',
					'value' => 0,
					'vars' => ['id' => $_GET['id']]
				], 'Ce nom d\'utilisateur est déjà pris')
				->lengthMin(6, 'le nom d\'utilisateur doit faire 6 caractères minimum');;

			$this->validation->text('email', 'Email')
				->mail('Cet email n\'est pas valide')
				->sql([
					'query' => 'SELECT COUNT(*) FROM user WHERE email = :value AND id != :id',
					'constraint' => '==',
					'value' => 0,
					'vars' => ['id' => $_GET['id']]
				], 'cet email est déjà associé à un autre compte');
		}
	}