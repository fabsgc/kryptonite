<?php
	namespace Orm\Entity;

	use System\Orm\Builder;
	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	class Category extends Entity{
		public function tableDefinition(){
			$this->name('category');
			$this->form('form-category');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('title')
				->type(Field::STRING)
				->size(32)
				->beNull(false);
			$this->field('description')
				->type(Field::STRING)
				->size(32)
				->beNull(false);
			$this->field('logo')
				->type(Field::STRING)
				->size(128)
				->defaultValue('web/app/image/category/default.png');
			$this->field('enigmas')
				->foreign([
					'type' => ForeignKey::ONE_TO_MANY,
					'reference' => ['Enigma', 'category'],
					'current' => ['Category', 'id'],
					'belong' => ForeignKey::COMPOSITION,
					'join' => Builder::JOIN_LEFT
				]);
		}

		public function beforeInsert()
		{
			$this->validation->text('title', 'titre')
				->different('', 'Vous devez donner un titre à cette catégorie');

			$this->validation->text('description', 'description')
				->different('', 'Vous devez donner une description à cette catégorie');
		}

		public function beforeUpdate()
		{
			$this->validation->text('title', 'titre')
				->different('', 'Vous devez donner un titre à cette catégorie');

			$this->validation->text('description', 'description')
				->different('', 'Vous devez donner une description à cette catégorie');
		}
	}