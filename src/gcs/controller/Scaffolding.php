<?php
	namespace Gcs;

	use System\Response\Response;

	class Scaffolding extends \Scaffolding\Scaffolding {
		public function init() {
			if (ENVIRONMENT != 'development') {
				Response::getInstance()->status(404);
			}
		}
	}