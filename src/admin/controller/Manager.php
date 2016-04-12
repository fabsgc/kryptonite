<?php
	namespace Admin;

	use System\Controller\Controller;
	use System\Template\Template;

	class Manager extends Controller{
		public function actionDefault(){
			return (new Template('manager/default', 'admin-manager-default'))
				->assign('title', 'Managers')
				->assign('filAriane', ['Managers'])
				->show();
		}

		public function actionNew(){

		}

		public function actionNewSave(\Orm\Entity\Manager $enigma){

		}

		public function actionEdit(){

		}

		public function actionEditSave($id, \Orm\Entity\Manager $enigma){

		}

		public function actionDelete($id){

		}
	}