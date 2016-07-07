<?php
	namespace Gcs;

	use System\Config\Config;
	use System\Controller\Controller;
	use System\Response\Response;

	class Lang extends Controller {
		public function init() {
			if (Config::config()['user']['debug']['environment'] != 'development') {
				Response::instance()->status(404);
			}
		}

		public function actionDefault() {
			return $this->showDefault();
		}
	}