<?php

namespace DerCooleVonDem\VecMath;

use JetBrains\PhpStorm\Pure;
use pocketmine\math\Vector2;

class Vec2 extends Vector2{

	public function lerp(Vector2 $vec, float $amount): Vector2
	{
		return $this->addVector($vec->subtractVector($this)->multiply($amount));
	}

	public function getAngle(Vector2 $vec): float
	{
		return atan2($vec->y - $this->y, $vec->x - $this->x);
	}

	public function clampMagnitude(float $max): Vector2
	{
		$len = $this->length();
		if($len > $max){
			return $this->multiply($max / $len);
		}
		return $this;
	}

	#[Pure] public function perpendicular(): Vector2
	{
		return new Vector2(-$this->y, $this->x);
	}

	public function reflect(Vector2 $normal): Vector2
	{
		return $this->subtractVector($normal->multiply($this->dot($normal) * 2));
	}

	public function moveTowards(Vector2 $vec, float $maxDistance): Vector2
	{
		$vec = $vec->subtractVector($this);
		$len = $vec->length();
		if($len > $maxDistance){
			return $this->addVector($vec->multiply($maxDistance / $len));
		}
		return $this->addVector($vec);
	}

	public function smoothDamp(Vector2 $vec, float $maxSpeed, float $deltaTime): Vector2
	{
		$vec = $vec->subtractVector($this);
		$len = $vec->length();
		if($len > $maxSpeed){
			return $this->addVector($vec->multiply($maxSpeed / $len));
		}
		return $this->addVector($vec);
	}

	public function scale(float $scale): Vector2
	{
		return $this->multiply($scale);
	}
}