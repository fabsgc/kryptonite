<?php
	namespace Gcs;

	use System\Response\Response;
	use System\Controller\Controller;

	class Lang extends Controller{
		public function init(){
			if(ENVIRONMENT != 'development')
				Response::getInstance()->status(404);
		}
		
		public function actionDefault(){
			return $this->showDefault();
		}
	}