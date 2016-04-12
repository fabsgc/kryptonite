<?php
	namespace Admin;

	use System\Controller\Controller;
	use System\Template\Template;

	class User extends Controller{
		public function actionDefault(){
			return (new Template('user/default', 'admin-user-default'))
				->assign('title', 'Utilisateur')
				->assign('filAriane', ['Utilisateurs'])
				->show();
		}

		public function actionNew(){

		}

		public function actionNewSave(\Orm\Entity\User $user){

		}

		public function actionEdit(){

		}

		public function actionEditSave($id, \Orm\Entity\User $user){

		}

		public function actionDelete($id){

		}
	}