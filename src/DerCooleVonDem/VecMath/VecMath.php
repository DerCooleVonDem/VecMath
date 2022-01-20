<?php

namespace DerCooleVonDem\VecMath;

use pocketmine\plugin\PluginBase;

// ISN`T COMPLETE
class VecMath extends PluginBase{

	private static self $instance;

	private API $api;

	public static function getInstance(): self
	{
		return self::$instance;
	}

	protected function onLoad(): void
	{
		self::$instance = $this;
		$this->api = new API($this);
	}
}