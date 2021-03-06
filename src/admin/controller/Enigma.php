<?php
	namespace Admin;

	use System\Controller\Controller;
	use System\Exception\MissingEntityException;
	use System\Response\Response;
	use System\Template\Template;
	use System\Url\Url;

	class Enigma extends Controller {
		public function actionNew($id) {
			/** @var \Orm\Entity\Category $category */
			$category = \Orm\Entity\Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if ($category instanceof \Orm\Entity\Category) {
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
			else {
				Response::instance()->status(404);
			}
		}

		public function actionNewSave($id, \Orm\Entity\Enigma $enigma) {
			/** @var \Orm\Entity\Category $category */
			$category = \Orm\Entity\Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if ($category instanceof \Orm\Entity\Category) {
				$enigmas = \Orm\Entity\Enigma::find()
					->vars('category', $id)
					->where('Enigma.category = :category')
					->fetch();

				if ($enigma->sent() && $enigma->valid()) {
					$enigma->description = html_entity_decode($enigma->description);
					$enigma->insert();
					Response::instance()->header('Location: ' . Url::get('admin.category.see', [$id]));
					$_SESSION['flash'] = 'L\'énigme a bien été créée';
				}
				else {
					return (new Template('enigma/new', 'admin-enigma-new'))
						->assign('title', 'Nouvelle énigme')
						->assign('filAriane', ['Enigmes', $category->title, 'Nouvelle énigme'])
						->assign('category', $category)
						->assign('enigmas', $enigmas)
						->assign('request', $enigma)
						->show();
				}
			}
			else {
				Response::instance()->status(404);
			}
		}

		public function actionEdit($id) {
			/** @var \Orm\Entity\Enigma $enigma */
			$enigma = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if ($enigma instanceof \Orm\Entity\Enigma) {
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
			else {
				Response::instance()->status(404);
			}
		}

		public function actionEditSave($id, \Orm\Entity\Enigma $enigma) {
			/** @var \Orm\Entity\Enigma $enigm */
			$enigm = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if ($enigm instanceof \Orm\Entity\Enigma) {
				$enigmas = \Orm\Entity\Enigma::find()
					->vars('id', $enigma->id)
					->vars('category', $enigma->category->id)
					->where('Enigma.category = :category AND Enigma.id != :id')
					->fetch();

				if ($enigma->sent()) {
					try {
						$enigma->description = htmlspecialchars_decode($enigma->description);
						$enigma->update();
					}
					catch (MissingEntityException $e) {
						Response::instance()->status(500);
					}

					Response::instance()->header('Location: ' . Url::get('admin.category.see', [$enigm->category->id]));
					$_SESSION['flash'] = 'L\'énigme a bien été éditée';
				}
				else {
					return (new Template('enigma/edit', 'admin-enigma-edit'))
						->assign('title', 'Editer une énigme')
						->assign('filAriane', ['Enigmes', $enigm->category->title, 'Editer une énigme'])
						->assign('category', $enigm->category)
						->assign('enigmas', $enigmas)
						->assign('request', $enigma)
						->show();
				}
			}
			else {
				Response::instance()->status(404);
			}
		}

		public function actionDelete($id) {
			/** @var \Orm\Entity\Enigma $enigma */
			$enigma = \Orm\Entity\Enigma::find()
				->where('Enigma.id = :id')
				->vars('id', $id)
				->fetch()->first();

			if ($enigma instanceof \Orm\Entity\Enigma) {
				$enigma->delete();
				Response::instance()->header('Location: ' . Url::get('admin.category.see', [$enigma->category->id]));
				$_SESSION['flash'] = 'L\'énigme a bien été supprimée';
			}
			else {
				Response::instance()->status(404);
			}
		}
	}