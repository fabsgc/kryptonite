<?php
	namespace Controller\Request\Kryptonite;

	use System\Request\Data;
	use \System\Request\Form;

	class LoginRequest extends Form{

		public function init(){
			$this->form = 'form-login';
		}

		public function post(){
			$this->validation->text('username', 'Nom d\'utilisateur')
				->sql([
					'query' => 'SELECT COUNT(*) FROM user WHERE username = :username AND password = :password',
					'constraint' => '==',
					'value' => 1,
					'vars' => [
						'username' => Data::getInstance()->post['username'],
						'password' => sha1(Data::getInstance()->post['password'])
					]
				],
				'Identifiants incorrects');
		}
	}