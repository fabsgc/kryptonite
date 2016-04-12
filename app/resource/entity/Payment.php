<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	class Payment extends Entity{
		public function tableDefinition(){
			$this->name('payment');
			$this->form('form-payment');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('reference')
				->unique(true)
				->type(Field::STRING)
				->size(128)
				->beNull(false);
			$this->field('time')
				->type(Field::INT)
				->beNull(false);
			$this->field('value')
				->type(Field::FLOAT)
				->precision(array('float'))
				->beNull(false);
			$this->field('user')
				->type(Field::INT)
				->beNull(false)
				->foreign([
					'type' => ForeignKey::MANY_TO_ONE,
					'reference' => ['User', 'id']
				]);
		}
	}