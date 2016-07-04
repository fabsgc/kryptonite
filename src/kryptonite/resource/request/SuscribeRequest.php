<?php
	namespace Controller\Request\Kryptonite;

	use System\Request\Form;

	class SuscribeRequest extends Form {
		public function init() {
			$this->form = 'form-suscribe';
		}

		public function post() {
			$this->validation->text('bank', 'Numéro de carte')
				->regex('#^[0-9]{16}$#', 'vous devez donner un numéro de carte valide');

			$this->validation->text('expiration', 'Date d\'expiration')
				->regex('#^[0-9]{2}\\/[0-9]{4}$#', 'la date ne possède pas un format valide');

			$this->validation->text('cvc', 'Cryptogramme')
				->regex('#^[0-9]{2}\\/[0-9]{4}$#', 'le cryptogramme n\'est pas valide');

			$this->validation->text('offer', 'Offre')
				->sql([
					'query'      => 'SELECT COUNT(*) FROM offer WHERE id = :value',
					'constraint' => '==',
					'value'      => 1,
					'vars'       => []
				], 'cette offre n\'est pas disponible');
		}
	}