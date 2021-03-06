<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;

	/**
	 * Class Upload
	 * @property integer id
	 * @property string  name
	 * @property string  path
	 * @property string  extension
	 * @package Orm\Entity
	 */
	class Upload extends Entity {
		public function tableDefinition() {
			$this->name('upload');
			$this->form('form-upload');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('name')
				->type(Field::INT)
				->beNull(false);
			$this->field('path')
				->unique(true)
				->type(Field::STRING)
				->size(128)
				->beNull(false);
			$this->field('extension')
				->type(Field::STRING)
				->size(16)
				->beNull(false);
		}
	}