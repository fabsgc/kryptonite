<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	class Enigma extends Entity{
		public function tableDefinition(){
			$this->name('enigma');
			$this->form('form-enigma');
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
				->type(Field::TEXT)
				->size(65535)
				->beNull(false);
			$this->field('answer')
				->type(Field::STRING)
				->size(64)
				->beNull(false);
			$this->field('points')
				->type(Field::INT)
				->defaultValue('0')
				->beNull(false);
			$this->field('logo')
				->type(Field::STRING)
				->size(128)
				->defaultValue('web/app/image/category/default.png');
			$this->field('category')
				->type(Field::INT)
				->beNull(false)
				->foreign([
					'type' => ForeignKey::MANY_TO_ONE,
					'reference' => ['Category', 'id']
				]);
		}

		public function beforeInsert()
		{
			$this->validation->text('title', 'titre')
				->different('', 'Vous devez donner un titre à cette énigme');

			$this->validation->text('description', 'description')
				->different('', 'Vous devez donner une description à cette énigme');

			$this->validation->text('answer', 'réponse')
				->different('', 'Vous devez donner une réponse à cette énigme');
		}

		public function beforeUpdate()
		{
			$this->validation->text('title', 'titre')
				->different('', 'Vous devez donner un titre à cette énigme');

			$this->validation->text('description', 'description')
				->different('', 'Vous devez donner une description à cette énigme');

			$this->validation->text('answer', 'réponse')
				->different('', 'Vous devez donner une réponse à cette énigme');
		}
	}