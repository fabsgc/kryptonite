<?php
	namespace Orm\Entity;

	use System\Orm\Builder;
	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	/**
	 * Class Enigma
	 * @package Orm\Entity
	 * @property integer              id
	 * @property string               title
	 * @property string               description
	 * @property string               answer
	 * @property integer              points
	 * @property string               logo
	 * @property \Orm\Entity\Category category
	 * @property \Orm\Entity\Enigma   child
	 */
	class Enigma extends Entity {
		public function tableDefinition() {
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
				->defaultValue('web/app/img/category/default.png');
			$this->field('first')
				->type(Field::INT)
				->beNull(false)
				->defaultValue('0');
			$this->field('category')
				->type(Field::INT)
				->beNull(false)
				->foreign([
					'type'      => ForeignKey::MANY_TO_ONE,
					'reference' => ['Category', 'id']
				]);
			$this->field('child')
				->type(Field::INT)
				->foreign([
					'type'      => ForeignKey::MANY_TO_ONE,
					'reference' => ['Enigma', 'id'],
					'join'      => Builder::JOIN_LEFT
				]);
		}

		public function beforeInsert() {
			$this->validation->text('title', 'titre')
				->different('', 'Vous devez donner un titre à cette énigme');

			$this->validation->text('description', 'description')
				->different('', 'Vous devez donner une description à cette énigme');

			$this->validation->text('answer', 'réponse')
				->different('', 'Vous devez donner une réponse à cette énigme');

			$this->validation->text('points', 'nombre de points')
				->between([1, 100], 'Le nombre de points doit être compris entre 1 et 100');
		}

		public function beforeUpdate() {
			$this->validation->text('title', 'titre')
				->different('', 'Vous devez donner un titre à cette énigme');

			$this->validation->text('description', 'description')
				->different('', 'Vous devez donner une description à cette énigme');

			$this->validation->text('answer', 'réponse')
				->different('', 'Vous devez donner une réponse à cette énigme');

			$this->validation->text('points', 'nombre de points')
				->between([1, 100], 'Le nombre de points doit être compris entre 1 et 100');
		}
	}