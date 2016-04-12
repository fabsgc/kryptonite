<?php
	namespace Admin;

	use Orm\Entity\Category;
	use System\Controller\Controller;
	use System\Response\Response;
	use System\Template\Template;

	class Enigma extends Controller{
		public function actionNew($id){
			$category = Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch();

			if($category->count() == 1){
				return (new Template('enigma/new', 'admin-enigma-new'))
					->assign('title', 'Nouvelle énigme')
					->assign('filAriane', ['Enigmes', $category->first()->title, 'Nouvelle énigme'])
					->assign('request', $category->first())
					->show();
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionNewSave($category, \Orm\Entity\Enigma $enigma){

		}

		public function actionEdit($id){

		}

		public function actionEditSave($id, \Orm\Entity\Enigma $enigma){

		}

		public function actionDelete($id){

		}
	}