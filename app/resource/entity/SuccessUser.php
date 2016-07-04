<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	/**
	 * Class SuccessUser
	 * @property integer id
	 * @property integer user
	 * @property integer success
	 * @package Orm\Entity
	 */
	class SuccessUser extends Entity {
		public function tableDefinition() {
			$this->name('success_user');
			$this->form('form-success_user');
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
			$this->field('success')
				->type(Field::INT)
				->beNull(false)
				->foreign([
					'type'      => ForeignKey::MANY_TO_ONE,
					'reference' => ['Success', 'id']
				]);
		}

		public function beforeInsert() {
		}

		public function beforeUpdate() {
		}

		public function beforeDelete() {
		}
	}