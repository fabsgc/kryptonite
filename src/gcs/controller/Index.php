<?php
	namespace Gcs;

	use Orm\Entity\Post;
	use System\Orm\Entity;
	use Orm\Entity\Student;
	use Orm\Entity\Article;
	use System\Response\Response;
	use System\Template\Template;
	use System\Controller\Controller;
	use Controller\Request\Gcs\FormRequest;

	class Index extends Controller{
		public function init(){
			if(ENVIRONMENT != 'development')
				Response::getInstance()->status(404);
		}
		
		public function actionDefault(){
			$students = Student::find()
				->where('Student.id = 1')
				->fetch();

			return (new Template('index/default', 'gcsDefault'))
				->assign('title', 'GCsystem V'.VERSION)
				->assign('students', $students)
				->show();
		}

		public function actionGet(){
			return (new Template('index/form', 'formDefault'))
				->assign('title', 'Injection Formulaire')
				->assign('articles', Article::find()->fetch())
				->show();
		}

		public function actionPost(FormRequest $request){
			return (new Template('index/form', 'formDefault'))
				->assign('title', 'Injection Formulaire')
				->assign('request', $request)
				->assign('articles', Article::find()->fetch())
				->show();
		}

		public function actionPut(FormRequest $request){
			return (new Template('index/form', 'formDefault'))
				->assign('title', 'Injection Formulaire')
				->assign('request', $request)
				->assign('articles', Article::find()->fetch())
				->show();
		}

		public function actionHydrate(Post $post){
			return (new Template('index/hydrate', 'formDefault'))
				->assign('title', 'Injection Formulaire - hydrate')
				->assign('post', $post)
				->show();
		}

		public static function extTemplate($content){
			return $content;
		}

		public function getFileLineDir($dir){
			$line = 0;

			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					while (($file = readdir($dh)) !== false) {
						if(is_array(pathinfo($dir . $file)))
							$extension = pathinfo($dir . $file);
						else
							$extension = '';

						if(isset($extension['extension']))
							$extension = $extension['extension'];

						if(is_dir($dir . $file)){
							if(strlen($file) > 2){
								$line += $this->getFileLineDir($dir . $file.'/');
							}
						}
						else if($extension == 'php' || $extension == 'xml' || $extension == 'tpl'){
							echo $dir . $file.'<br />';
							$line += $this->countLines($dir . $file);
						}
					}

					closedir($dh);
				}
			}

			return $line;
		}

		public function countLines($filepath){
			$handle = fopen( $filepath, "r" );
			$count = 0;

			while( fgets($handle) ){
				$count++;
			}

			fclose($handle);
			return $count;
		}
	}