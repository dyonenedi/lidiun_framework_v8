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
	
	class Path
	{
		private static $_path;
		
		public static function load() {
			// Set paths to your application
			self::$_path['app'] = PUBLIC_DIRECTORY . SEPARATOR . '..' . SEPARATOR;

			self::$_path['class']       = self::$_path['app'] . 'class' . SEPARATOR;
			self::$_path['conf']        = self::$_path['app'] . 'conf' . SEPARATOR;
			self::$_path['controller']  = self::$_path['app'] . 'controller' . SEPARATOR;
			self::$_path['layout']      = self::$_path['app'] . 'layout' . SEPARATOR;
			self::$_path['model']       = self::$_path['app'] . 'model'  . SEPARATOR;
			self::$_path['plugin']      = self::$_path['app'] . 'plugin'  . SEPARATOR;
			self::$_path['translation'] = self::$_path['app'] . 'translation' . SEPARATOR;
			self::$_path['public']      = PUBLIC_DIRECTORY . SEPARATOR;

			foreach (Conf::$_conf['public_path'] as $key => $value) {
				$value = str_replace(SEPARATOR, ' ', $value);
				$value = trim($value);
				$value = str_replace(' ', SEPARATOR, $value);
				
				self::$_path[$key] = self::$_path['public'] . $value . SEPARATOR;
			}			
		}

		public static function getPath(){
			return self::$_path;
		}
	}