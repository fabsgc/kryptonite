<?php
	namespace Admin;

	use Orm\Entity\Category;
	use System\Controller\Controller;
	use System\Exception\MissingEntityException;
	use System\Response\Response;
	use System\Template\Template;

	class Enigma extends Controller{
		public function actionNew($id, \Orm\Entity\Enigma $enigma){
			$category = Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch();

			if($category->count() == 1){
				return (new Template('enigma/new', 'admin-enigma-new'))
					->assign('title', 'Nouvelle énigme')
					->assign('filAriane', ['Enigmes', $category->first()->title, 'Nouvelle énigme'])
					->assign('category', $category->first())
					->assign('request', $enigma)
					->show();
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionNewSave($id, \Orm\Entity\Enigma $enigma){
			$category = Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch();

			if($category->count() == 1){
				if($enigma->sent() && $enigma->valid()){
					$enigma->insert();
					Response::getInstance()->header('Location: '. $this->getUrl('admin.category.see', [$id]));
					$_SESSION['flash'] = 'L\'énigme a bien été créée';
				}
				else{
					return (new Template('enigma/new', 'admin-enigma-new'))
						->assign('title', 'Nouvelle énigme')
						->assign('filAriane', ['Enigmes', $category->first()->title, 'Nouvelle énigme'])
						->assign('category', $category->first())
						->assign('request', $enigma)
						->show();
				}
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionEdit($id, \Orm\Entity\Enigma $enigma){
			$enigm = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch();

			if($enigm->count() > 0){
				return (new Template('enigma/edit', 'admin-enigma-edit'))
					->assign('title', 'Editer une énigme')
					->assign('filAriane', ['Enigmes', $enigm->first()->category->title, 'Editer une énigme'])
					->assign('category', $enigm->first()->category)
					->assign('request', $enigm->first())
					->show();
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionEditSave($id, \Orm\Entity\Enigma $enigma){
			//print_r($enigma->category);

			$enigm = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch();

			if($enigm->count() > 0){
				if($enigma->sent()){
					try{
						$enigma->update();
					}
					catch(MissingEntityException $e){
						Response::getInstance()->status(500);
					}

					Response::getInstance()->header('Location: '. $this->getUrl('admin.category.see', [$enigm->first()->category->id]));
					$_SESSION['flash'] = 'L\'énigme a bien été éditée';
				}
				else{
					return (new Template('enigma/edit', 'admin-enigma-edit'))
						->assign('title', 'Editer une énigme')
						->assign('filAriane', ['Enigmes', $enigm->first()->category->title, 'Editer une énigme'])
						->assign('category', $enigm->first()->category)
						->assign('request', $enigma)
						->show();
				}
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionDelete($id){
			$enigma = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch();

			if($enigma->count() > 0){
				$enigma->first()->delete();
				Response::getInstance()->header('Location: '. $this->getUrl('admin.category.see', [$enigma->first()->category->id]));
				$_SESSION['flash'] = 'L\'énigme a bien été supprimée';
			}
			else{
				Response::getInstance()->status(404);
			}
		}
	}