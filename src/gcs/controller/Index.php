<?php
	namespace Gcs;

	use System\Orm\Entity;
	use System\Response\Response;
	use System\Template\Template;
	use System\Controller\Controller;

	class Index extends Controller{
		public function init(){
			if(ENVIRONMENT != 'development')
				Response::getInstance()->status(404);
		}
		
		public function actionDefault(){
			return (new Template('index/default', 'gcsDefault'))
				->assign('title', 'GCsystem V'.VERSION)
				->show();
		}
	}