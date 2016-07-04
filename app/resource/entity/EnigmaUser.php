<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	/**
	 * Class EnigmaUser
	 * @property integer id
	 * @property integer user
	 * @property integer enigma
	 * @property integer finished
	 * @package Orm\Entity
	 */
	class EnigmaUser extends Entity {
		public function tableDefinition() {
			$this->name('enigma_user');
			$this->form('form-enigma_user');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('user')
				->type(Field::INT)
				->beNull(false)
				->foreign([
					'type'      => ForeignKey::MANY_TO_ONE,
					'reference' => ['User', 'id']
				]);
			$this->field('finished')
				->type(Field::INT)
				->beNull(false)
				->defaultValue('0');
			$this->field('enigma')
				->type(Field::INT)
				->beNull(false)
				->foreign([
					'type'      => ForeignKey::MANY_TO_ONE,
					'reference' => ['Enigma', 'id']
				]);
		}

		public function beforeInsert() {
		}

		public function beforeUpdate() {
		}

		public function beforeDelete() {
		}
	}