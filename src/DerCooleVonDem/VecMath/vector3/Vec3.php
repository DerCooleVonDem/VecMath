<?php

namespace DerCooleVonDem\VecMath;

use pocketmine\math\Vector3;

class Vec3 extends Vector3{

	public function lerp(Vector3 $pos, float $amount): Vector3
	{
		return $this->addVector($pos->subtractVector($this)->multiply($amount));
	}

	public function slerp(Vector3 $pos, float $amount): Vector3
	{
		$dot = $this->dot($pos);
		$dot = $dot > 1 ? 1 : (max($dot, -1));
		$theta = acos($dot);
		$sintheta = sin($theta);
		if($sintheta < 0.001)
		{
			return $this->lerp($pos, $amount);
		}
		$scale = sin(($theta - $theta * $amount)) / $sintheta;
		return $this->addVector($pos->subtractVector($this)->multiply($scale));
	}

	public function getAngle(Vector3 $pos): float
	{
		return atan2($pos->getZ() - $this->getZ(), $pos->getX() - $this->getX());
	}

	public function clampMagnitude(float $max): Vector3
	{
		$len = $this->length();
		if($len > $max)
		{
			return $this->multiply($max / $len);
		}
		return $this;
	}

	public function moveTowards(Vector3 $pos, float $amount): Vector3
	{
		$delta = $pos->subtractVector($this);
		$deltaLen = $delta->length();
		if($deltaLen < $amount)
		{
			return $pos;
		}
		return $this->addVector($delta->multiply($amount / $deltaLen));
	}

	public function reflect(Vector3 $normal): Vector3
	{
		return $this->subtractVector($normal->multiply(2 * $this->dot($normal)));
	}

	public function scale(float $scale): Vector3
	{
		return $this->multiply($scale);
	}
}