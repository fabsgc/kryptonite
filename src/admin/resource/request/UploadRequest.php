<?php
	namespace Controller\Request\Admin;

	use System\Request\Form;

	class UploadRequest extends Form {
		public function init() {
			$this->form = 'form-login';
		}

		public function post() {
		}
	}