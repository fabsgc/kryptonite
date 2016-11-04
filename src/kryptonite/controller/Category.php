<?php
	namespace Kryptonite;

	use Orm\Entity\Enigma;
	use System\Controller\Controller;
	use System\Response\Response;
	use System\Template\Template;
	use System\Url\Url;

	class Category extends Controller {
		public function actionBrowse() {
			$categories = \Orm\Entity\Category::find()->fetch();

			return (new Template('category/default', 'kryptonite-category-default'))
				->assign('title', 'Parcourir')
				->assign('categories', $categories)
				->show();
		}

		public function actionCategory($id, $slug) {
			/** @var \Orm\Entity\Category $category */
			$category = \Orm\Entity\Category::find()
				->vars('id', $id)
				->where('Category.id = :id')
				->fetch()
				->first();

			if ($category instanceof \Orm\Entity\Category) {
				if ($slug != slugify($category->title)) {
					Response::instance()->header('Location: ' . Url::get('kryptonite.category.category', [$category->id, slugify($category->title)]));
				}
				else {
					$enigmas = Enigma::find()
						->vars('id', $category->id)
						->where('Enigma.category = :id')
						->fetch();

					return (new Template('category/category', 'kryptonite-category-category'))
						->assign('title', 'Parcourir')
						->assign('category', $category)
						->assign('enigmas', $enigmas)
						->show();
				}
			}
			else {
				Response::instance()->status(404);
			}
		}
	}