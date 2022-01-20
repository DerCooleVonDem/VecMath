<?php

namespace DerCooleVonDem\VecMath;

use JetBrains\PhpStorm\Pure;

class Color{

	public int $r;
	public int $g;
	public int $b;

	public function __construct(int $r, int $g, int $b)
	{
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	public function getR(): int
	{
		return $this->r;
	}

	public function getG(): int
	{
		return $this->g;
	}

	public function getB(): int
	{
		return $this->b;
	}

	#[Pure] public function lerp(Color $color, float $t): Color
	{
		$r = $this->r + ($color->r - $this->r) * $t;
		$g = $this->g + ($color->g - $this->g) * $t;
		$b = $this->b + ($color->b - $this->b) * $t;

		return new Color($r, $g, $b);
	}

	#[Pure] public function splineLerp(Color $color, float $t): Color
	{
		$r = $this->r + ($color->r - $this->r) * $t * $t * (3 - 2 * $t);
		$g = $this->g + ($color->g - $this->g) * $t * $t * (3 - 2 * $t);
		$b = $this->b + ($color->b - $this->b) * $t * $t * (3 - 2 * $t);

		return new Color($r, $g, $b);
	}

	public function __toString()
	{
		return "r: $this->r, g: $this->g, b: $this->b";
	}
}