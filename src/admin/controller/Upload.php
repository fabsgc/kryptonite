<?php
	namespace Admin;

	use Controller\Request\Admin\UploadRequest;
	use System\Controller\Controller;
	use System\Template\Template;

	class Upload extends Controller {
		public function actionDefault() {
			return (new Template('upload/default', 'admin-upload-default'))
				->assign('title', 'Upload')
				->assign('filAriane', ['Upload'])
				->show();
		}

		public function upload(UploadRequest $request) {
		}

		public function get($id) {
		}
	}