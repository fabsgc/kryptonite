<?php
	namespace Admin;

	use System\Controller\Controller;
	use System\Template\Template;

	/** @Before({hello}) */
	class User extends Controller{
		public function actionDefault(){
			return (new Template('user/default', 'admin-user-default'))
				->assign('title', 'Utilisateur')
				->assign('filAriane', ['Utilisateurs'])
				->assign('users', \Orm\Entity\User::find()->fetch())
				->show();
		}

		public function actionNew(\Orm\Entity\User $user){

		}

		public function actionNewSave(\Orm\Entity\User $user){

		}

		public function actionEdit($id, \Orm\Entity\User $user){

		}

		public function actionEditSave($id, \Orm\Entity\User $user){

		}

		public function actionDelete($id){

		}
	}