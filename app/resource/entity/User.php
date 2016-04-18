<?php
	namespace Orm\Entity;

	use System\Orm\Builder;
	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	 /** @property int $id */
	 /** @property string $token */
	 /** @property string $username */
	 /** @property string $email */
	 /** @property string $password */
	 /** @property integer $coins */
	 /** @property integer $bought */
	 /** @property string $avatar */
	 /** @property integer $activated */
	 /** @property integer $parent */

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
				->beNull(false)
				->defaultValue('10');
			$this->field('bought')
				->type(Field::INT)
				->beNull(false)
				->defaultValue('0');
			$this->field('avatar')
				->type(Field::STRING)
				->size(128)
				->beNull(false)
				->defaultValue('web/app/image/avatar/default.png');
			$this->field('activated')
				->type(Field::INT)
				->defaultValue('0');
			$this->field('parent')
				->type(Field::INT)
				->foreign([
					'type' => ForeignKey::MANY_TO_ONE,
					'reference' => ['User', 'id'],
					'join' => Builder::JOIN_LEFT
				]);
			$this->field('enigma')
				->type(Field::INT)
				->foreign([
					'type' => ForeignKey::MANY_TO_ONE,
					'reference' => ['Enigma', 'id'],
					'join' => Builder::JOIN_LEFT
				]);
			$this->field('enigmas')
				->type(Field::INT)
				->foreign([
					'type' => ForeignKey::MANY_TO_MANY,
					'reference' => ['Enigma', 'id']
				]);
		}

        public function beforeInsert(){

        }

        public function beforeUpdate(){

        }

        public function beforeDelete(){

        }
	}