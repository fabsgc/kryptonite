<?php
	namespace Gcs;

	use System\Cache\Cache;
	use System\Controller\Controller;
	use System\Response\Response;

	class AssetManager extends Controller {
		public function actionDefault() {
			if ($_GET['type'] == 'js' || $_GET['type'] == 'css') {
				Response::getInstance()->contentType("text/" . $_GET['type']);
				Response::getInstance()->header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));

				$cache = new Cache(html_entity_decode($_GET['id'] . '.' . $_GET['type']), ASSET_MANAGER_CACHE);

				return $cache->getCache();
			}
			else {
				Response::getInstance()->status(404);
			}
		}
	}