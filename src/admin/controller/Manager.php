<?php
	namespace Admin;

	use System\Controller\Controller;
	use System\Template\Template;

	class Manager extends Controller {
		public function actionDefault() {
			return (new Template('manager/default', 'admin-manager-default'))
				->assign('title', 'Managers')
				->assign('filAriane', ['Managers'])
				->assign('managers', \Orm\Entity\Manager::find()->fetch())
				->show();
		}

		public function actionNew(\Orm\Entity\Manager $enigma) {
		}

		public function actionNewSave(\Orm\Entity\Manager $enigma) {
		}

		public function actionEdit($id, \Orm\Entity\Manager $enigma) {
		}

		public function actionEditSave($id, \Orm\Entity\Manager $enigma) {
		}

		public function actionDelete($id) {
		}
	}