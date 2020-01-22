<?php
	/**********************************************************
	* Lidiun PHP Framework 7.0 - (http://www.lidiun.com)
	*
	* @Created in 26/08/2013
	* @Updated in 01/10/2019
	* @Author  Dyon Enedi <dyonenedi@hotmail.com>
	* @By Dyon Enedi <dyonenedi@hotmail.com>
	* @Contributor Gabriela A. Ayres Garcia <gabriela.ayres.garcia@gmail.com>
	* @License: free
	*
	**********************************************************/
	
	namespace Lidiun_Framework_v7;
	
	class Request
	{
		private static $_parameter;
		private static $_post;
		private static $_get;
		private static $_files;
		private static $_controller;
		private static $_action;
		private static $_ajax;
		private static $_webHeader;
		private static $_ajaxHeader;
		
		public static function load() {
			// Set Path
			Path::load();

			// Set Link
			Link::load();

			// Set URL
			Url::load();

			// Set Language
			Language::load();	

			// Set parameters
			self::_setParameters();

			// Set Controller
			self::_setController();
			
			// Set Action
			self::_setAction();

			// Set Headers
			self::_setDefaultHeader();
		}

		#########################################################################
		############################ PRIVATE METHODS ############################
		#########################################################################
		
		private static function _setParameters(){
			// Treat parameters
			if (!empty(Url::$_url['uri']) && is_array(Url::$_url['uri'])) {
				foreach (Url::$_url['uri'] as $value) {
					self::$_parameter[] = $value;
				}
			}

			if (!empty($_POST) && is_array($_POST)) {
				foreach ($_POST as $key => $value) {
					self::$_post[$key] = $value;
				}
			}

			if (!empty($_GET) && is_array($_GET)) {
				foreach ($_GET as $key => $value) {
					self::$_get[$key] = $value;
				}
			}

			if (!empty($_FILES) && is_array($_FILES)) {
				foreach ($_FILES as $key => $value) {
					self::$_files[$key] = self::organizeArray($value);
				}
			}

			if (empty(self::$_parameter)) {
				self::$_parameter[0] = Conf::$_conf['preset']['controller_default'];
			}
		}

		private static function _setController(){
			if (empty(self::$_controller)) {
				$controller = strtolower(self::$_parameter[0]);
				$path = Path::getPath();
				$controllerPath = $path['controller'];
				if (file_exists($controllerPath . $controller . SEPARATOR . self::$_parameter[0] . '_controller.php')) {
					self::$_controller = $controller;
					self::unsetParameter(0);
				} else {
					exit('notfound');
				}
			}

			self::orderParameter();
		}

		private static function _setAction(){
			Autoload::includePath('controller' . SEPARATOR . self::$_controller);
			Autoload::includePath('view' . SEPARATOR . self::$_controller);
			if (empty(self::$_action) && !empty(self::$_parameter[0])) {
				$method = strtolower(self::$_parameter[0]);
				$class  = self::$_controller.'_controller';
				if ((int)method_exists($class, $method)) {
					self::$_action = $method;
					self::unsetParameter(0);
				} else {
					exit('The action do not exists in this Controller');
				}
			} else if (empty(self::$_action)) {
				self::$_action = 'index';
			}

			self::orderParameter();
		}

		private static function _setDefaultHeader(){
			if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			   self::$_ajax = true;
			}
			
			self::$_webHeader = [
				'Content-Type: text/html; charset=UTF-8',
				'Access-Control-Allow-Methods: GET, POST',
				'Access-Control-Allow-Headers: *',
			];

			self::$_ajaxHeader = [
				'Content-Type: application/json; charset=UTF-8',
				'Access-Control-Allow-Methods: GET, POST',
				'Access-Control-Allow-Headers: *',
			];
		}

		#########################################################################
		########################### AUX METHODS ##############################
		#########################################################################

		private static function organizeArray($file){
			if (is_array($file['name'])) {
				foreach ($file as $key => $value) {
					foreach ($value as $k => $val) {
						$file[$k][$key] = $val;
						unset($file[$key][$k]);
					}
					unset($file[$key]);
				}
			} else {
				$file[0] = $file;
			}

			return $file;
		}

		private static function orderParameter(){
			$aux = self::$_parameter;
			self::$_parameter = [];
			foreach ($aux as $value) {
				array_push(self::$_parameter, $value);
			}
		}

		#########################################################################
		########################### PUBLIC METHODS ##############################
		#########################################################################

		public static function setController($controller){
			self::$_controller = $controller;
		}

		public static function setAction($action){
			self::$_action = $action;
		}

		public static function responseHeader() {
			$header = (self::$_ajax) ? self::$_ajaxHeader: self::$_webHeader;
			foreach ($header as $headerLine) {
				header($headerLine);
			}
		}

		/*
		* Usefull for developer
		*
		*/
		public static function isAjax(){
			return self::$_ajax;
		}

		public static function setAjaxResponseHeader($header){
			self::$_ajaxHeader = $header;
		}

		public static function setWebResponseHeader($header){
			self::$_webHeader = $header;
		}

		public static function setParameter($parameter=false){
			if ($parameter) {
				array_push($_parameter, $parameter);
			}
		}

		public static function unsetParameter($key){
			unset(self::$_parameter[$key]);
		}

		public static function getParameter(){
			return self::$_parameter;
		}

		public static function getGet(){
			return self::$_get;
		}

		public static function getPost(){
			return self::$_post;
		}

		public static function getFiles(){
			return self::$_files;
		}

		public static function getController(){
			return self::$_controller;
		}
		
		public static function getAction(){
			return self::$_action;
		}

		public static function redirectTo($url){
			header('Location: ' . Url::$_url['base'] . $url);
			exit;
		}
	}