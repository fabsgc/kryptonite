<?php
	namespace Kryptonite;

	use System\Controller\Controller;
	use System\Template\Template;

	class Index extends Controller{
		public function actionDefault(){
			return (new Template('index/default', 'kryptonite-index-default'))
				->assign('title', 'Accueil')
				->show();
		}
	}