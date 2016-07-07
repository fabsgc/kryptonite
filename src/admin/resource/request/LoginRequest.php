<?php
	namespace Controller\Request\Admin;

	use System\Request\Data;
	use System\Request\Form;

	class LoginRequest extends Form {
		public function init() {
			$this->form = 'form-login';
		}

		public function post() {
			$this->validation->text('username', 'Nom d\'utilisateur')
				->sql([
					'query'      => 'SELECT COUNT(id) FROM manager WHERE username = :username AND password = :password',
					'constraint' => '==',
					'value'      => 1,
					'vars'       => [
						'username' => Data::instance()->post['username'],
						'password' => sha1(Data::instance()->post['password'])
					]
				],
					'Identifiants incorrects');
		}
	}