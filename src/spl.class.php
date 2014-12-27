<?php
namespace LANarea;

/**
 * Studio Playlist Request Class
 *
 * @author Ken Verhaegen <contact@kenverhaegen.be>
 * @copyright 2014 LANarea
 * @license BSD-3-Clause
 */
class SPLRequest
{
	public $config = [];

	public function __construct($config_file_path)
	{
		$this->loadConfigFromFile($config_file_path);
		// die(var_dump($this-config));
	}

	public function buildLibrary($save_to_path)
	{
		if(!isset($save_to_path)) {
			return "No path given";
		}
		elseif(!is_dir($save_to_path))
		{
			return "Given path isn't a valid directory, please create the following directory: " . $save_to_path;
		}
		elseif(!is_writable($save_to_path))
		{
			return "Given path isn't a writable directory, please chmod the directory to 775 or 777";
		}
		else
		{
			return "Lib built";
		}
	}
	
	public function search($)
	{
	}

	public function getConfig($key=null)
	{
		if(NULL !== $key && array_key_exists($key,$this->config))
		{
			return $this->config[$key];
		}
		return $this->config;
	}
	
	
	/**
	 * Load the config file
	 * 
	 * var config_file_path 	should be a file returning an array.
	 */
	private function loadConfigFromFile($config_file_path)
	{
		if($config_content = include(config_file_path))
		{
			if(is_array($config_content))
			{
				$this->config = $config_content;
			}
			else
			{
				throw new TwitterException('Config file didn\'t return a valid array (' . $config_path . ')');
			}
		}
		else
		{
			throw new TwitterException('Config couldn\'t be loaded from : ' . $config_path);
		}
	}

}

/**
 * An exception generated by SPLRequest.
 */
class TwitterException extends \Exception {}