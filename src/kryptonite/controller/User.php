<?php
	namespace Kryptonite;

	use Helper\Mail\Mail;
	use System\Response\Response;
	use System\Template\Template;
	use System\Controller\Controller;
	use Controller\Request\Kryptonite\LoginRequest;
	use Controller\Request\Kryptonite\RegisterRequest;

	class User extends Controller{
		public function actionDefault(){
			return (new Template('user/default', 'kryptonite-user-default'))
				->assign('title', 'Accueil')
				->show();
		}

		public function actionAccount(){
			return (new Template('user/default', 'kryptonite-user-account'))
				->assign('title', 'Mon compte')
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
				$user = \Orm\Entity\User::find()
					->where("User.username = :username AND User.password = :password")
					->vars([
						'username' => $username,
						'password' => sha1($password)
					])
					->fetch()
					->first();

				$_SESSION['kryptonite']['logged'] = true;
				$_SESSION['kryptonite']['token'] = uniqid('', true);
				$_SESSION['kryptonite']['role'] = 'USER';
				$_SESSION['kryptonite']['id'] = $user->id;
				$_SESSION['kryptonite']['username'] = $user->username;
				$_SESSION['kryptonite']['email'] = $user->email;
				$_SESSION['kryptonite']['coins'] = $user->coins;
				$_SESSION['kryptonite']['bought'] = $user->bought;
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

		public function actionRegister(RegisterRequest $request, $username, $email){
			return (new Template('user/register', 'kryptonite-user-register'))
				->assign('title', 'Inscription')
				->assign('form', $request)
				->assign('username', $username)
				->assign('email', $email)
				->show();
		}

		public function actionRegisterSave(RegisterRequest $request, $username, $email, $password){
			if($request->sent() && $request->valid()){
				$user = new \Orm\Entity\User();
				$user->token = uniqid();
				$user->username = $username;
				$user->email = $email;
				$user->password = sha1($password);
				$user->insert();

				$mail = new Mail([
					'sender' => 'contact@kryptonite.fr',
					'receiver' => $email,
					'subject' => 'Votre inscription sur Kryptonite',
				]);

				$mail->addTemplate('mail/register', [
					'user' => $user
				]);

				$mail->send();

				Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.index.default'));
				$_SESSION['flash'] = 'Votre inscription a bien été enregistrée. Veuillez suivre instructions que nous allons vous envoyer par mail';
			}
			else{
				return (new Template('user/register', 'kryptonite-user-register'))
					->assign('title', 'Inscription')
					->assign('form', $request)
					->assign('username', $username)
					->assign('email', $email)
					->show();
			}
		}

		public function actionLogout(){
			$_SESSION['kryptonite'] = array();
			Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.index.default'));
			$_SESSION['flash'] = 'Vous avez bien été déconnecté(e)';
		}

		public function actionActivate($id){
			$user = \Orm\Entity\User::find()
				->where('User.token = :token')
				->vars('token', $id)
				->fetch();

			if($user->count() == 1){
				$user->first()->activated = 1;
				$user->first()->update();
				Response::getInstance()->header('Location: '. $this->getUrl('kryptonite.index.default'));
				$_SESSION['flash'] = 'Votre compte a bien été activé';
			}
			else{
				Response::getInstance()->status(404);
			}
		}
	}