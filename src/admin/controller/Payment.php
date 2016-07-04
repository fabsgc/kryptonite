<?php
	namespace Admin;

	use System\Controller\Controller;
	use System\Template\Template;

	class Payment extends Controller {
		public function actionDefault() {
			return (new Template('payment/default', 'admin-payment-default'))
				->assign('title', 'Paiement')
				->assign('filAriane', ['Paiement'])
				->show();
		}

		public function refund($id) {
		}
	}