<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;

	/**
	 * Class Offer
	 * @property integer id
	 * @property string  title
	 * @property integer price
	 * @property integer duration
	 * @package Orm\Entity
	 */
	class Offer extends Entity {
		public function tableDefinition() {
			$this->name('offer');
			$this->form('form-offer');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('title')
				->type(Field::STRING)
				->size(64)
				->beNull(false);
			$this->field('price')
				->type(Field::FLOAT)
				->beNull(false);
			$this->field('duration')
				->type(Field::INT)
				->beNull(false);
		}

		public function beforeInsert() {
		}

		public function beforeUpdate() {
		}

		public function beforeDelete() {
		}
	}