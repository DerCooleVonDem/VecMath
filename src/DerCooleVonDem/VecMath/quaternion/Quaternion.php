<?php

namespace DerCooleVonDem\VecMath;

use JetBrains\PhpStorm\Pure;
use pocketmine\math\Vector3;

// WARNING: This class is not yet completed.
class Quaternion{
	
	public float $w;
	public float $x;
	public float $y;
	public float $z;
	
	public function __construct(float $w, float $x, float $y, float $z){
		$this->w = $w;
		$this->x = $x;
		$this->y = $y;
		$this->z = $z;
	}
	
	public function __toString(){
		return "Quaternion(w: $this->w, x: $this->x, y: $this->y, z: $this->z)";
	}
	
	public function getW(): float{
		return $this->w;
	}
	
	public function getX(): float{
		return $this->x;
	}
	
	public function getY(): float{
		return $this->y;
	}
	
	public function getZ(): float{
		return $this->z;
	}

	#[Pure] public function add(Quaternion $q): Quaternion
	{
		return new Quaternion($this->w + $q->w, $this->x + $q->x, $this->y + $q->y, $this->z + $q->z);
	}

	#[Pure] public function addF(float $f): Quaternion
	{
		return new Quaternion($this->w + $f, $this->x + $f, $this->y + $f, $this->z + $f);
	}

	#[Pure] public function sub(Quaternion $q): Quaternion
	{
		return new Quaternion($this->w - $q->w, $this->x - $q->x, $this->y - $q->y, $this->z - $q->z);
	}

	#[Pure] public function subF(float $f): Quaternion
	{
		return new Quaternion($this->w - $f, $this->x - $f, $this->y - $f, $this->z - $f);
	}

	#[Pure] public function multiply(Quaternion $quaternion): Quaternion
	{
		return new Quaternion(
			$this->w * $quaternion->w - $this->x * $quaternion->x - $this->y * $quaternion->y - $this->z * $quaternion->z,
			$this->w * $quaternion->x + $this->x * $quaternion->w + $this->y * $quaternion->z - $this->z * $quaternion->y,
			$this->w * $quaternion->y + $this->y * $quaternion->w + $this->z * $quaternion->x - $this->x * $quaternion->z,
			$this->w * $quaternion->z + $this->z * $quaternion->w + $this->x * $quaternion->y - $this->y * $quaternion->x
		);
	}

	#[Pure] public function multiplyF(float $f): Quaternion
	{
		return new Quaternion($this->w * $f, $this->x * $f, $this->y * $f, $this->z * $f);
	}

	#[Pure] public function divide(Quaternion $quaternion): Quaternion
	{
		return $this->multiply($quaternion->getInverted());
	}

	#[Pure] public function divideF(float $f): Quaternion
	{
		return $this->multiplyF(1 / $f);
	}

	#[Pure] public function getVector(): Vector3
	{
		return new Vector3($this->x, $this->y, $this->z);
	}
	
	public function getLength(): float
	{
		return sqrt($this->w * $this->w + $this->x * $this->x + $this->y * $this->y + $this->z * $this->z);
	}
	
	#[Pure] public function getNormalized(): Quaternion
	{
		$length = $this->getLength();
		return new Quaternion($this->w / $length, $this->x / $length, $this->y / $length, $this->z / $length);
	}
	
	#[Pure] public function getConjugated(): Quaternion
	{
		return new Quaternion($this->w, -$this->x, -$this->y, -$this->z);
	}
	
	#[Pure] public function getInverted(): Quaternion
	{
		return $this->getConjugated()->getNormalized();
	}
	
	#[Pure] public function getRotated(Quaternion $q): Quaternion
	{
		$q1 = $this->getConjugated();
		$q2 = $q->getConjugated();
		$q3 = $q1->multiply($q);
		$q4 = $q2->multiply($q3);
		return $q4->getNormalized();
	}
	
	#[Pure] public function getRotatedByVector(Vector3 $v): Quaternion
	{
		$q = new Quaternion(0, $v->x, $v->y, $v->z);
		return $this->getRotated($q);
	}
	
	#[Pure] public function getRotatedByAngle(float $angle, Vector3 $axis): Quaternion
	{
		$q = new Quaternion(cos($angle / 2), sin($angle / 2) * $axis->x, sin($angle / 2) * $axis->y, sin($angle / 2) * $axis->z);
		return $this->getRotated($q);
	}
	
	#[Pure] public function getRotatedByEulerAngles(float $pitch, float $yaw, float $roll): Quaternion
	{
		$q1vec = new Vector3(0, sin($pitch / 2), 0);
		$q1 = new Quaternion(cos($pitch / 2), $q1vec->x, $q1vec->y, $q1vec->z);
		$q2vec = new Vector3(0, 0, sin($yaw / 2));
		$q2 = new Quaternion(cos($yaw / 2), $q2vec->x, $q2vec->y, $q2vec->z);
		$q3 = new Quaternion(cos($roll / 2), 0, 0, 0);
		$q4 = $q1->multiply($q2);
		$q5 = $q4->multiply($q3);
		return $q5->getNormalized();
	}
	
	#[Pure] public function getRotatedByEulerAnglesInDegrees(float $pitch, float $yaw, float $roll): Quaternion
	{
		return $this->getRotatedByEulerAngles(deg2rad($pitch), deg2rad($yaw), deg2rad($roll));
	}

	#[Pure] public function lerp(Quaternion $quaternion, float $alpha): Quaternion
	{
		$q = $quaternion->getNormalized();
		$q1 = $this->getNormalized();
		$q2 = $q->sub($q1);
		$q3 = $q2->multiplyF($alpha);
		$q4 = $q1->add($q3);
		return $q4->getNormalized();
	}

	public function angleAxis(Vector3 $axis, float $angle): Quaternion
	{
		$s = sin($angle / 2);
		$u = $axis->normalize();
		return new Quaternion(cos($angle / 2), $u->getX() * $s, $u->getY() * $s, $u->getZ() * $s);
	}

	public function lookAt(Vector3 $pos): Quaternion
	{
		$toVec = $this->getVector()->subtractVector($pos)->normalize();
		$front = $this->getVector()->add(1, 0, 0);
		$rotAxis = $front->cross($toVec)->normalize();
		$dot = $front->dot($toVec);
		$angle = acos($dot);
		return $this->angleAxis($rotAxis, $angle);
	}
}