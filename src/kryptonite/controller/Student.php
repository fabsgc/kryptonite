<?php
	namespace Kryptonite;

	use Controller\Request\Kryptonite\StudentRequest;
	use Helper\Mail\Mail;
	use Orm\Entity\User;
	use System\Controller\Controller;
	use System\Response\Response;
	use System\Sql\Sql;
	use System\Template\Template;

	class Student extends Controller{
		public function init(){
			if($_SESSION['kryptonite']['role'] != 'TEACHER'){
				Response::getInstance()->status(404);
			}
		}

		public function actionCreate(StudentRequest $request, $username, $email){
			return (new Template('student/create', 'kryptonite-student-create'))
				->assign('title', 'Nouvel élève')
				->assign('request', $request)
				->assign('username', $username)
				->assign('email', $email)
				->show();
		}

		public function actionCreateSave(StudentRequest $request, $username, $email){
			if($request->sent() && $request->valid()){
				$password = uniqid();

				$parent = User::find()
					->vars('id', $_SESSION['kryptonite']['id'])
					->where('User.id = :id')->fetch()->first();

				$user = new User();
				$user->username = $username;
				$user->email = $email;
				$user->password = sha1($password);
				$user->token = uniqid();
				$user->role = 'STUDENT';
				$user->parent = $parent;
				$user->insert();

				$mail = new Mail([
					'sender' => 'contact@mazemind.fr',
					'receiver' => $email,
					'subject' => 'Votre inscription sur Kryptonite',
				]);

				$mail->addTemplate('mail/registerStudent', [
					'user' => $user,
					'password' => $password
				]);

				$mail->send();

				Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.user.home-students'));
				$_SESSION['flash'] = 'L\'inscription a bien été enregistrée. Nous avons envoyé un mail à cet étudiant';
			}
			else{
				return (new Template('student/create', 'kryptonite-student-create'))
					->assign('title', 'Nouvel élève')
					->assign('request', $request)
					->assign('username', $username)
					->assign('email', $email)
					->show();
			}
		}

		public function actionUpdate(StudentRequest $request, $id){
			/** @var \Orm\Entity\User $user */
			$user = User::find()
				->vars('id', $id)
				->vars('parent', $_SESSION['kryptonite']['id'])
				->where('User.id = :id AND User.parent = :parent')
				->fetch()->first();

			if($user != null){
				return (new Template('student/update', 'kryptonite-student-update'))
					->assign('title', 'Modifier un élève')
					->assign('id', $id)
					->assign('request', $request)
					->assign('username', $user->username)
					->assign('email', $user->email)
					->show();
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionUpdateSave(StudentRequest $request, $id, $username, $email){
			/** @var \Orm\Entity\User $user */
			$user = User::find()
				->vars('id', $id)
				->vars('parent', $_SESSION['kryptonite']['id'])
				->where('User.id = :id AND User.parent = :parent')
				->fetch()->first();

			if($user != null){
				if($request->sent() && $request->valid()){
					$user->username = $username;
					$user->email = $email;
					$user->update();

					$mail = new Mail([
						'sender' => 'contact@mazemind.fr',
						'receiver' => $email,
						'subject' => 'Votre inscription sur Kryptonite',
					]);

					$mail->addTemplate('mail/registerStudent', [
						'user' => $user,
						'password' => '*****'
					]);

					$mail->send();

					Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.user.home-students'));
					$_SESSION['flash'] = 'L\'inscription a bien été modifiée. Nous avons envoyé un mail à cet étudiant';
				}
				else{
					return (new Template('student/update', 'kryptonite-student-update'))
						->assign('title', 'Modifier un élève')
						->assign('id', $id)
						->assign('request', $request)
						->assign('username', $username)
						->assign('email', $email)
						->show();
				}
			}
			else{
				Response::getInstance()->status(404);
			}
		}

		public function actionDelete($id){
			$user = User::find()
				->vars('id', $id)
				->vars('parent', $_SESSION['kryptonite']['id'])
				->where('User.id = :id AND User.parent = :parent')
				->fetch()->first();

			if($user != null){
				$query = new Sql();
				$query->vars('user', $id);
				$query->query('delete-enigma', 'DELETE FROM enigma_user WHERE user = :user');
				$query->query('delete-success', 'DELETE FROM success_user WHERE user = :user');
				$query->fetch('delete-enigma', Sql::PARAM_FETCHDELETE);
				$query->fetch('delete-success', Sql::PARAM_FETCHDELETE);
				$user->delete();

				Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.user.home-students'));
				$_SESSION['flash'] = 'L\'étudiant a bien été supprimé';
			}
			else{
				Response::getInstance()->status(404);
			}
		}
	}