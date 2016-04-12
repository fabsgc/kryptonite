<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	class User extends Entity{
		public function tableDefinition(){
			$this->name('user');
			$this->form('form-user');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('token')
				->unique(true)
				->type(Field::STRING)
				->size(64)
				->beNull(false);
			$this->field('username')
				->unique(true)
				->type(Field::STRING)
				->size(32)
				->beNull(false);
			$this->field('email')
				->unique(true)
				->type(Field::STRING)
				->size(64)
				->beNull(false);
			$this->field('password')
				->type(Field::STRING)
				->size(128)
				->beNull(false);
			$this->field('coins')
				->type(Field::INT)
				->beNull(false);
			$this->field('bought')
				->type(Field::INT)
				->beNull(false);
		}
	}