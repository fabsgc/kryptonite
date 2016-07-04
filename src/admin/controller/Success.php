<?php
	namespace Admin;

	use System\Controller\Controller;
	use System\Template\Template;

	class Success extends Controller {
		public function actionDefault() {
			return (new Template('success/default', 'admin-success-default'))
				->assign('title', 'Badges')
				->assign('filAriane', ['Badges'])
				->show();
		}
	}