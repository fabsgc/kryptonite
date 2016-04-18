<?php
	namespace Orm\Entity;

	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	 /** @property int $id */
	 /** @property integer $user_id */
	 /** @property integer $enigma_id */
	 /** @property integer $count */

	class Enigmaiduserid extends Entity{
		public function tableDefinition(){
			$this->name('Enigmaiduserid');
			$this->form('form-enigmaiduserid');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
			$this->field('user_id')
				->type(Field::INT)
				->beNull(false)
				->foreign([
					'type' => ForeignKey::MANY_TO_ONE,
					'reference' => ['User', 'id']
				]);
			$this->field('enigma_id')
				->type(Field::INT)
				->beNull(false)
				->foreign([
					'type' => ForeignKey::MANY_TO_ONE,
					'reference' => ['Enigma', 'id']
				]);
			$this->field('count')
				->type(Field::INT)
				->beNull(false)
				->defaultValue('0');
		}

        public function beforeInsert(){

        }

        public function beforeUpdate(){

        }

        public function beforeDelete(){

        }
	}