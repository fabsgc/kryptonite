<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	/**
	 * Class Success
	 * @property integer id
	 * @property string title
	 * @property string logo
	 * @package Orm\Entity
	*/

	class Success extends Entity{
		public function tableDefinition(){
			$this->name('success');
			$this->form('form-success');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('title')
				->type(Field::STRING)
				->size(32)
				->beNull(false);
			$this->field('logo')
				->type(Field::STRING)
				->size(64)
				->beNull(false);
		}

        public function beforeInsert(){

        }

        public function beforeUpdate(){

        }

        public function beforeDelete(){

        }
	}