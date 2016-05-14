<?php
	namespace Controller\Request\Kryptonite;

	use System\Request\Data;
	use \System\Request\Form;

	class RegisterRequest extends Form{

		public function init(){
			$this->form = 'form-register';
		}

		public function post(){
			$this->validation->text('username', 'Nom d\'utilisateur')
				->sql([
					'query' => 'SELECT COUNT(*) FROM user WHERE username = :value',
					'constraint' => '==',
					'value' => 0,
					'vars' => []
				], 'Ce nom d\'utilisateur est déjà pris')
				->lengthMin(6, 'Votre nom d\'utilisateur doit faire 6 caractères minimum');;

			$this->validation->text('email', 'Email')
				->mail('Cet email n\'est pas valide')
				->sql([
					'query' => 'SELECT COUNT(*) FROM user WHERE email = :value',
					'constraint' => '==',
					'value' => 0,
					'vars' => []
				], 'Cet email est déjà associé à un compte');

			$this->validation->text('password', 'Mot de passe')
				->lengthMin(6, 'Votre mot de passe doit faire 6 caractères minimum');
			
			$this->validation->select('role', 'Je suis')
				->in(['STUDENT', 'TEACHER', 'INDIVIDUAL'], 'Cette option n\'est pas disponible');
		}
	}