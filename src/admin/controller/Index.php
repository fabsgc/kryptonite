<?php
	namespace Admin;

	use Orm\Entity\Manager;
	use System\Controller\Controller;
	use Controller\Request\Admin\LoginRequest;
	use System\Template\Template;

	class Index extends Controller{
		public function actionDefault(){
			return (new Template('index/default', 'admin-index-default'))
				->assign('title', 'Accueil')
				->assign('filAriane', [])
				->show();
		}

		public function actionLogin(){
			return (new Template('index/login', 'admin-index-login'))
				->assign('title', 'Connexion')
				->show();
		}

		public function actionLoginSave(LoginRequest $request, $username, $password){
			if($request->sent() && $request->valid()){
				$manager = Manager::find()
					->where("Manager.username = :username AND Manager.password = :password")
					->vars([
						'username' => $username,
						'password' => sha1($password)
					])
					->fetch()
					->first();

				$_SESSION['admin']['logged'] = true;
				$_SESSION['admin']['token'] = uniqid('', true);
				$_SESSION['admin']['role'] = 'MANAGER';
				$_SESSION['admin']['id'] = $manager->id;
				$_SESSION['admin']['username'] = $manager->username;
				$_SESSION['admin']['email'] = $manager->email;

				return "1";
			}

			return "0";
		}

		public function actionLogout(){
			$_SESSION['admin'] = array();
		}
	}