<?php
	namespace Controller\Request\Kryptonite;

	use System\Request\Form;

	class AccountRequest extends Form {
		public function init() {
			$this->form = 'form-account';
		}

		public function put() {
			$this->validation->text('username', 'Nom d\'utilisateur')
				->sql([
					'query'      => 'SELECT COUNT(*) FROM user WHERE username = :value AND username != :username',
					'constraint' => '==',
					'value'      => 0,
					'vars'       => ['username' => $_SESSION['kryptonite']['username']]
				], 'Ce nom d\'utilisateur est déjà pris')
				->lengthMin(6, 'votre nom d\'utilisateur doit faire 6 caractères minimum');;

			$this->validation->text('email', 'Email')
				->mail('Cet email n\'est pas valide')
				->sql([
					'query'      => 'SELECT COUNT(*) FROM user WHERE email = :value AND email != :email',
					'constraint' => '==',
					'value'      => 0,
					'vars'       => ['email' => $_SESSION['kryptonite']['email']]
				], 'cet email est déjà associé à un autre compte');

			$this->validation->text('password', 'Mot de passe')
				->lengthMin(6, 'votre mot de passe doit faire 6 caractères minimum');
		}
	}