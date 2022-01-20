<?php

namespace DerCooleVonDem\VecMath;

use JetBrains\PhpStorm\Pure;

class API{

	private VecMath $vecMath;

	public MatrixMaker $maker;

	#[Pure] public function
	__construct(VecMath $vecMath)
	{
		$this->vecMath = $vecMath;
		$this->maker = new MatrixMaker();
	}

}