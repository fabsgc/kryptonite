<?php
	namespace Admin;

	use System\Controller\Controller;
	use System\Exception\MissingEntityException;
	use System\Response\Response;
	use System\Template\Template;
	use System\Url\Url;

	class Category extends Controller {
		public function actionDefault() {
			return (new Template('category/default', 'admin-category-default'))
				->assign('title', 'Enigmes')
				->assign('filAriane', ['Enigmes'])
				->assign('categories', \Orm\Entity\Category::find()->fetch())
				->show();
		}

		public function actionSee($id) {
			$category = \Orm\Entity\Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch();

			if ($category->count() == 1) {
				return (new Template('category/see', 'admin-category-see'))
					->assign('title', 'Enigmes')
					->assign('filAriane', ['Enigmes', $category->first()->title])
					->assign('category', $category->first())
					->show();
			}
			else {
				Response::instance()->status(404);
			}
		}

		public function actionNew(\Orm\Entity\Category $category) {
			return (new Template('category/new', 'admin-category-see'))
				->assign('title', 'Enigmes')
				->assign('filAriane', ['Enigmes', 'Nouvelle catégorie'])
				->assign('request', $category)
				->show();
		}

		public function actionNewSave(\Orm\Entity\Category $category) {
			if ($category->sent() && $category->valid()) {
				$category->insert();
				Response::instance()->header('Location: ' . Url::get('admin.category.default'));
				$_SESSION['flash'] = 'La catégorie a bien été ajoutée';
			}
			else {
				return (new Template('category/new', 'admin-category-see'))
					->assign('title', 'Enigmes')
					->assign('filAriane', ['Enigmes', 'Nouvelle catégorie'])
					->assign('request', $category)
					->show();
			}
		}

		public function actionEdit($id) {
			$category = \Orm\Entity\Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch();

			if ($category->count() == 1) {
				return (new Template('category/edit', 'admin-category-edit'))
					->assign('title', $category->first()->title)
					->assign('filAriane', ['Enigmes', $category->first()->title])
					->assign('request', $category->first())
					->show();
			}
			else {
				Response::instance()->status(404);
			}
		}

		public function actionEditSave($id, \Orm\Entity\Category $category) {
			$cat = \Orm\Entity\Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch();

			if ($cat->count() == 1) {
				if ($category->sent() && $category->valid()) {
					try {
						$category->update();
					}
					catch (MissingEntityException $e) {
						Response::instance()->status(500);
					}

					Response::instance()->header('Location: ' . Url::get('admin.category.default'));
					$_SESSION['flash'] = 'La catégorie a bien été modifiée';
				}
				else {
					return (new Template('category/edit', 'admin-category-edit'))
						->assign('title', $cat->first()->title)
						->assign('filAriane', ['Enigmes', $cat->first()->title])
						->assign('request', $category)
						->show();
				}
			}
			else {
				Response::instance()->status(404);
			}
		}

		public function actionDelete($id) {
			$category = \Orm\Entity\Category::find()
				->where('Category.id = :id')
				->vars('id', $id)
				->fetch();

			if ($category->count() == 1) {
				$category->first()->delete();
				Response::instance()->header('Location: ' . Url::get('admin.category.default'));
				$_SESSION['flash'] = 'La catégorie a bien été supprimée';
			}
			else {
				Response::instance()->status(404);
			}
		}
	}