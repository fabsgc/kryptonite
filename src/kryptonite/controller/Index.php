<?php
	namespace Kryptonite;

	use System\Controller\Controller;

	class Index extends Controller{
		public function actionDefault(){
			return $this->showDefault();
		}
	}