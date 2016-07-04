<?php
	namespace Kryptonite;

	use Orm\Entity\EnigmaUser;
	use Orm\Entity\User;
	use System\Controller\Controller;
	use System\Response\Response;
	use System\Template\Template;
	use System\Url\Url;

	class Enigma extends Controller {
		public function init() {
			$id = $_GET['id'];

			$listEnigmasDones = $this->getListEnigmasDone($_SESSION['kryptonite']['id']);
			$available = false;
			$enigma = \Orm\Entity\Enigma::find()
				->vars('id', $id)
				->where('Enigma.id = :id')
				->fetch()->first();

			$user = User::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('User.id = :id')
				->fetch()->first();

			if ($enigma != null) {
				//Si l'énigme est déjà dans la liste des énigmes en cours, alors, c'est bon il peut passer
				foreach ($listEnigmasDones as $listEnigmasDone) {
					if ($listEnigmasDone->id == $id) {
						$available = true;
					}
				}

				//Si l'énigme n'est pas dans la liste des énigmes en cours, on regarde si dans cette liste, il y a l'égnigme parente
				//et que cette énigme parente est terminée
				if ($available == false) {
					foreach ($listEnigmasDones as $listEnigmasDone) {
						if ($listEnigmasDone->enigma->child != null && $listEnigmasDone->enigma->child == $id && $listEnigmasDone->finished == 1) {
							$available = true;
						}
					}
				}

				if ($enigma->first == 1) {
					$available = true;
				}

				if ($available == true || array_key_exists($id, $listEnigmasDones)) {
					if (!array_key_exists($id, $listEnigmasDones)) {
						$enigmaUser = new EnigmaUser();
						$enigmaUser->user = $user;;
						$enigmaUser->enigma = $enigma;
						$enigmaUser->finished = 0;
						$enigmaUser->insert();
					}
				}
				else {
					$_SESSION['flash'] = 'Vous n\'avez pas encore accès à cette énigme';
					Response::getInstance()->header('Location:' . Url::get('kryptonite.user.default'));
				}
			}
			else {
				Response::getInstance()->status(404);
			}
		}

		public function actionEnigma($id) {
			$enigma = \Orm\Entity\Enigma::find()
				->vars('id', $id)
				->where('Enigma.id = :id')
				->fetch()->first();

			$user = User::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('User.id = :id')
				->fetch()->first();

			$user->enigma = $enigma;
			$user->update();

			return (new Template('enigma/enigma', 'kryptonite-enigma-enigma'))
				->assign('title', $enigma->title)
				->assign('enigma', $enigma)
				->show();
		}

		public function actionEnigmaCheck($id, $answer) {
			$enigma = \Orm\Entity\Enigma::find()
				->vars('id', $id)
				->where('Enigma.id = :id')
				->fetch()->first();

			$user = User::find()
				->vars('id', $_SESSION['kryptonite']['id'])
				->where('User.id = :id')
				->fetch()->first();

			$user->enigma = $enigma;
			$user->update();

			if ($enigma->answer = trim(strtolower($answer))) {
				$enigmaUser = EnigmaUser::find()
					->vars('user', $_SESSION['kryptonite']['id'])
					->vars('id', $id)
					->where('EnigmaUser.user = :user AND EnigmaUser.enigma = :id')
					->fetch()
					->first();

				$enigmaUser->finished = 1;
				$enigmaUser->update();

				if ($enigma->child != null) {
					$_SESSION['flash'] = 'C\'était la bonne réponse, bravo, énigme suivante !';
					Response::getInstance()->header('Location:' . Url::get('kryptonite.enigma.enigma', [$enigma->child->id, slugify($enigma->child->title)]));
				}
				else {
					$_SESSION['flash'] = 'C\'était la bonne réponse, bravo !';
					Response::getInstance()->header('Location:' . Url::get('kryptonite.user.default'));
				}
			}
			else {
				$_SESSION['flash'] = 'Ce n\'est pas la bonne réponse !';

				return (new Template('enigma/enigma', 'kryptonite-enigma-enigma'))
					->assign('title', $enigma->title)
					->assign('enigma', $enigma)
					->show();
			}
		}

		private function getListEnigmasDone($id) {
			$enigmaUsers = EnigmaUser::find()
				->vars('id', $id)
				->where('EnigmaUser.user = :id')
				->fetch();

			$list = [];

			foreach ($enigmaUsers as $enigmaUser) {
				$list[$enigmaUser->enigma->id] = $enigmaUser;
			}

			return $list;
		}
	}