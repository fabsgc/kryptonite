<?php
	namespace Kryptonite;

	use System\Controller\Controller;

	class User extends Controller{
		public function actionDefault(){
			return $this->showDefault();
		}
	}