<?php
	namespace Kryptonite;

	use Helper\Mail\Mail;
	use Orm\Entity\Enigma;
	use Orm\Entity\EnigmaUser;
	use Orm\Entity\Success;
	use Orm\Entity\SuccessUser;
	use System\Response\Response;
	use System\Template\Template;
	use System\Controller\Controller;
	use Controller\Request\Kryptonite\LoginRequest;
	use Controller\Request\Kryptonite\RegisterRequest;

	class User extends Controller{
		public function actionDefault(){
			$user = \Orm\Entity\User::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('User.id = :id')->fetch()->first();

			$enigmas = EnigmaUser::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('EnigmaUser.user = :id')->fetch();

			$enigmasTotal = Enigma::count()->fetch();

			return (new Template('user/default', 'kryptonite-user-default'))
				->assign('title', 'Accueil')
				->assign('user', $user)
				->assign('enigmas', $enigmas)
				->assign('enigmasTotal', $enigmasTotal)
				->show();
		}

		public function actionHomeFinished(){
			$user = \Orm\Entity\User::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('User.id = :id')->fetch()->first();

			$enigmas = EnigmaUser::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('EnigmaUser.user = :id')->fetch();

			$enigmasTotal = Enigma::count()->fetch();

			return (new Template('user/homeFinished', 'kryptonite-user-home-finished'))
				->assign('title', 'Mes énigmes achevées')
				->assign('user', $user)
				->assign('enigmas', $enigmas)
				->assign('enigmasTotal', $enigmasTotal)
				->show();
		}

		public function actionHomeSuccesses(){
			$user = \Orm\Entity\User::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('User.id = :id')->fetch()->first();

			$enigmas = EnigmaUser::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('EnigmaUser.user = :id')->fetch();

			$enigmasTotal = Enigma::count()->fetch();

			$successes = SuccessUser::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('SuccessUser.user = :id')->fetch();

			return (new Template('user/homeSuccesses', 'kryptonite-user-home-successes'))
				->assign('title', 'Mes badges')
				->assign('user', $user)
				->assign('enigmas', $enigmas)
				->assign('enigmasTotal', $enigmasTotal)
				->assign('successes', $successes)
				->show();
		}

		public function actionHomeStudents(){
			$user = \Orm\Entity\User::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('User.id = :id')->fetch()->first();

			$enigmas = EnigmaUser::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('EnigmaUser.user = :id')->fetch();

			$enigmasTotal = Enigma::count()->fetch();

			$students = \Orm\Entity\User::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('User.parent = :id')->fetch();

			return (new Template('user/homeStudents', 'kryptonite-user-home-students'))
				->assign('title', 'Mes élèves')
				->assign('user', $user)
				->assign('enigmas', $enigmas)
				->assign('enigmasTotal', $enigmasTotal)
				->assign('students', $students)
				->show();
		}

		public function actionAccount(){
			return (new Template('user/account', 'kryptonite-user-account'))
				->assign('title', 'Réglages')
				->show();
		}

		public function actionAccountSave(){
			return (new Template('user/account', 'kryptonite-user-account'))
				->assign('title', 'Réglages')
				->show();
		}

		public function actionSuscribe($id){
			return (new Template('user/suscribe', 'kryptonite-user-suscribe'))
				->assign('title', 'Abonnements')
				->show();
		}

		public function actionSuscribeSave($id){
			return (new Template('user/suscribe', 'kryptonite-user-suscribe'))
				->assign('title', 'Abonnements')
				->show();
		}

		public function actionLogin(LoginRequest $request, $username){
			return (new Template('user/login', 'kryptonite-user-login'))
				->assign('title', 'Connexion')
				->assign('form', $request)
				->assign('username', $username)
				->show();
		}

		public function actionLoginSave(LoginRequest $request, $username, $password){
			if($request->sent() && $request->valid()){
				/** @var \Orm\Entity\User $user */
				$user = \Orm\Entity\User::find()
					->where("User.username = :username AND User.password = :password")
					->vars([
						'username' => $username,
						'password' => sha1($password)
					])
					->fetch()->first();

				$_SESSION['kryptonite']['logged'] = true;
				$_SESSION['kryptonite']['token'] = uniqid('', true);
				$_SESSION['kryptonite']['role'] = $user->role;
				$_SESSION['kryptonite']['id'] = $user->id;
				$_SESSION['kryptonite']['username'] = $user->username;
				$_SESSION['kryptonite']['email'] = $user->email;
				$_SESSION['kryptonite']['coins'] = $user->coins;
				$_SESSION['kryptonite']['avatar'] = $user->avatar;

				Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.index.default'));
				$_SESSION['flash'] = 'Vous êtes connecté(e)';
			}
			else{
				return (new Template('user/login', 'kryptonite-user-login'))
					->assign('title', 'Connexion')
					->assign('form', $request)
					->assign('username', $username)
					->show();
			}
		}

		public function actionRegister(RegisterRequest $request, $username, $email, $role){
			return (new Template('user/register', 'kryptonite-user-register'))
				->assign('title', 'Inscription')
				->assign('form', $request)
				->assign('username', $username)
				->assign('email', $email)
				->assign('role', $role)
				->assign('roles', ['STUDENT' => 'Elève', 'TEACHER' => 'Professeur', 'INDIVIDUAL' => 'Particulier'])
				->show();
		}

		public function actionRegisterSave(RegisterRequest $request, $username, $email, $password, $role){
			if($request->sent() && $request->valid()){
				$user = new \Orm\Entity\User();
				$user->token = uniqid();
				$user->username = $username;
				$user->email = $email;
				$user->password = sha1($password);
				$user->role = $role;
				$user->insert();

				$mail = new Mail([
					'sender' => 'contact@mazemind.fr',
					'receiver' => $email,
					'subject' => 'Votre inscription sur Kryptonite',
				]);

				$mail->addTemplate('mail/register', [
					'user' => $user
				]);

				$mail->send();

				Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.index.default'));
				$_SESSION['flash'] = 'Votre inscription a bien été enregistrée. Veuillez suivre instructions que nous llons vous envoyer par mail';
			}
			else{
				return (new Template('user/register', 'kryptonite-user-register'))
					->assign('title', 'Inscription')
					->assign('form', $request)
					->assign('username', $username)
					->assign('email', $email)
					->assign('role', $role)
					->assign('roles', ['STUDENT' => 'Elève', 'TEACHER' => 'Professeur', 'INDIVIDUAL' => 'Particulier'])
					->show();
			}
		}

		public function actionLogout(){
			$_SESSION['kryptonite'] = array();
			Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.index.default'));
			$_SESSION['flash'] = 'Vous avez bien été déconnecté(e)';
		}

		public function actionActivate($id){
			/** @var \Orm\Entity\User $user */
			$user = \Orm\Entity\User::find()
				->where('User.token = :token')
				->vars('token', $id)
				->fetch()->first();

			if($user != null){
				$user->activated = 1;
				$user->update();
				Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.index.default'));
				$_SESSION['flash'] = 'Votre compte a bien été activé';
			}
			else{
				Response::getInstance()->status(404);
			}
		}
	}