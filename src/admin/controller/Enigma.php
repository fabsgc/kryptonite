<?php
	namespace Admin;

	use Orm\Entity\Category;
	use System\Controller\Controller;
	use System\Exception\MissingEntityException;
	use System\Response\Response;
	use System\Template\Template;

	class Enigma extends Controller{
		public function actionNew($id){
			/** @var \Orm\Entity\Category $category */
			$category = Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if($category != null){
				$enigmas = \Orm\Entity\Enigma::find()
					->vars('category', $id)
					->where('Enigma.category = :category')
					->fetch();

				return (new Template('enigma/new', 'admin-enigma-new'))
					->assign('title', 'Nouvelle énigme')
					->assign('filAriane', ['Enigmes', $category->title, 'Nouvelle énigme'])
					->assign('category', $category)
					->assign('enigmas', $enigmas)
					->assign('request', new \Orm\Entity\Enigma())
					->show();
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionNewSave($id, \Orm\Entity\Enigma $enigma){
			/** @var \Orm\Entity\Category $category */
			$category = Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if($category != null){
				$enigmas = \Orm\Entity\Enigma::find()
					->vars('category', $id)
					->where('Enigma.category = :category')
					->fetch();

				if($enigma->sent() && $enigma->valid()){
					$enigma->description = html_entity_decode($enigma->description);
					$enigma->insert();
					Response::getInstance()->header('Location: '. $this->getUrl('admin.category.see', [$id]));
					$_SESSION['flash'] = 'L\'énigme a bien été créée';
				}
				else{
					return (new Template('enigma/new', 'admin-enigma-new'))
						->assign('title', 'Nouvelle énigme')
						->assign('filAriane', ['Enigmes', $category->title, 'Nouvelle énigme'])
						->assign('category', $category)
						->assign('enigmas', $enigmas)
						->assign('request', $enigma)
						->show();
				}
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionEdit($id){
			/** @var \Orm\Entity\Enigma $enigma */
			$enigma = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if($enigma != null){
				$enigmas = \Orm\Entity\Enigma::find()
					->vars('id', $enigma->id)
					->vars('category', $enigma->category->id)
					->where('Enigma.category = :category AND Enigma.id != :id')
					->fetch();

				return (new Template('enigma/edit', 'admin-enigma-edit'))
					->assign('title', 'Editer une énigme')
					->assign('filAriane', ['Enigmes', $enigma->category->title, 'Editer une énigme'])
					->assign('category', $enigma->category)
					->assign('enigmas', $enigmas)
					->assign('request', $enigma)
					->show();
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionEditSave($id, \Orm\Entity\Enigma $enigma){
			/** @var \Orm\Entity\Enigma $enigma */
			$enigm = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if($enigm != null){
				$enigmas = \Orm\Entity\Enigma::find()
					->vars('id', $enigma->id)
					->vars('category', $enigma->category->id)
					->where('Enigma.category = :category AND Enigma.id != :id')
					->fetch();

				if($enigma->sent()){
					try{
						$enigma->description = htmlspecialchars_decode($enigma->description);
						$enigma->update();
					}
					catch(MissingEntityException $e){
						Response::getInstance()->status(500);
					}

					Response::getInstance()->header('Location: '. $this->getUrl('admin.category.see', [$enigm->category->id]));
					$_SESSION['flash'] = 'L\'énigme a bien été éditée';
				}
				else{
					return (new Template('enigma/edit', 'admin-enigma-edit'))
						->assign('title', 'Editer une énigme')
						->assign('filAriane', ['Enigmes', $enigm->category->title, 'Editer une énigme'])
						->assign('category', $enigm->category)
						->assign('enigmas', $enigmas)
						->assign('request', $enigma)
						->show();
				}
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionDelete($id){
			/** @var \Orm\Entity\Enigma $enigma */
			$enigma = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if($enigma != null){
				$enigma->delete();
				Response::getInstance()->header('Location: '. $this->getUrl('admin.category.see', [$enigma->category->id]));
				$_SESSION['flash'] = 'L\'énigme a bien été supprimée';
			}
			else{
				Response::getInstance()->status(404);
			}
		}
	}