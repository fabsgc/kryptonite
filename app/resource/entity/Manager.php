<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;

	/**
	 * Class Manager
	 * @property integer id
	 * @property string  username
	 * @property string  password
	 * @property string  email
	 * @package Orm\Entity
	 */
	class Manager extends Entity {
		public function tableDefinition() {
			$this->name('manager');
			$this->form('form-manager');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('username')
				->unique(true)
				->type(Field::STRING)
				->size(32)
				->beNull(false);
			$this->field('password')
				->type(Field::STRING)
				->size(64)
				->beNull(false);
			$this->field('email')
				->unique(true)
				->type(Field::STRING)
				->size(32)
				->beNull(false);
		}
	}