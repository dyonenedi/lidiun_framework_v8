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

	class Render
	{
		private static $_controller;
		private static $_action;

		public static function load() {
			// Autoloads
			Autoload::includePath('plugin');

			// Run Global Render
			self::runGlobalRende();

			// Run Controller
			self::runController();

			// Database close conection
			Database::close();	

			// Delivery response
			self::deliveryResponse();
		}

		private static function runGlobalRende(){
			$path = Path::getPath();
			if (file_exists($path['controller'] . 'global_controller.php')) {
				$globalController = 'global_controller';
				$globalController = new $globalController;
				$globalcontroller = null;
			}
		}
		
		private static function runController(){
			self::$_controller = Request::getController();
			$controller = self::$_controller.'_controller';
			if (class_exists($controller)) {
				$Controler = New $controller;

				self::$_action = Request::getAction();
				$action = self::$_action;
				if (method_exists($controller, $action)) {
					$Controler->$action();
				} else if(method_exists(self::$_controller, 'index')) {
					$Controler->index();
				} else {
					exit('Action do not exists in Controller.');
				}
			} else {
				exit('Controller do not exists as a Class.');
			}
			$Controler = null;
		}

		private static function deliveryResponse(){
			Request::responseHeader();
			if (Request::isAjax()) {
				$view = App::getView();
				echo json_encode($view);
			} else {
				App::load();
				$view = App::getView();
				$path = Path::getPath();
				include_once($path['layout'].'layout.php');
			}
		}
	}