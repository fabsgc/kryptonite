<?php
	namespace Orm\Entity;

	use System\Orm\Builder;
	use System\Orm\Entity\Entity;
	use System\Orm\Entity\Field;
	use System\Orm\Entity\ForeignKey;

	/**
	 * Class User
	 * @property int id
	 * @property integer parent
	 * @property int enigma
	 * @property int suscribe
	 * @property string token
	 * @property string username
	 * @property string email
	 * @property string password
	 * @property string role
	 * @property integer coins
	 * @property string avatar
	 * @property integer activated
	 * @property integer suscribe_end
	 * @property \Orm\Entity\Enigma[] enigmas
	 * @package Orm\Entity
	 */

	class User extends Entity{
		public function tableDefinition(){
			$this->name('user');
			$this->form('form-user');
			$this->field('id')
				->primary(true)
				->unique(true)
				->type(Field::INCREMENT)
				->beNull(false);
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
			$this->field('role')
				->type(Field::STRING)
				->size(8)
				->beNull(false);
			$this->field('coins')
				->type(Field::INT)
				->beNull(false)
				->defaultValue('10');
			$this->field('avatar')
				->type(Field::STRING)
				->size(128)
				->beNull(false)
				->defaultValue('web/app/img/avatar/default.png');
			$this->field('activated')
				->type(Field::INT)
				->defaultValue('0');
			$this->field('suscribe_end')
				->type(Field::INT)
				->defaultValue('0');
		}

        public function beforeInsert(){

        }

        public function beforeUpdate(){

        }

        public function beforeDelete(){

        }
	}