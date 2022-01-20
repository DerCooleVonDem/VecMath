<?php

namespace DerCooleVonDem\VecMath;

class MatrixMaker{

	public function makeIdentityMatrix(int $size): Matrix{
		$matrix = new Matrix($size, $size);
		for($i = 0; $i < $size; $i++){
			$matrix->set($i, $i, 1);
		}
		return $matrix;
	}

	public function makeZeroMatrix(int $rows, int $cols): Matrix{
		$matrix = new Matrix($rows, $cols);
		return $matrix;
	}

	public function makeDiagonalMatrix(int $size, float $value): Matrix{
		$matrix = new Matrix($size, $size);
		for($i = 0; $i < $size; $i++){
			$matrix->set($i, $i, $value);
		}
		return $matrix;
	}

	public function makeMatrixFromArray(array $array): Matrix{
		$matrix = new Matrix(count($array), 1);
		for($i = 0; $i < count($array); $i++){
			$matrix->set($i, 0, $array[$i]);
		}
		return $matrix;
	}

	public function makeMatrixFromArray2D(array $array): Matrix{
		$matrix = new Matrix(count($array), count($array[0]));
		for($i = 0; $i < count($array); $i++){
			for($j = 0; $j < count($array[0]); $j++){
				$matrix->set($i, $j, $array[$i][$j]);
			}
		}
		return $matrix;
	}

	public function makeMatrixFromArray3D(array $array): Matrix{
		$matrix = new Matrix(count($array), count($array[0]), count($array[0][0]));
		for($i = 0; $i < count($array); $i++){
			for($j = 0; $j < count($array[0]); $j++){
				for($k = 0; $k < count($array[0][0]); $k++){
					$matrix->set($i, $j, $k, $array[$i][$j][$k]);
				}
			}
		}
		return $matrix;
	}

	public function makeProjectionMatrixOrtho(float $left, float $right, float $bottom, float $top, float $near, float $far): Matrix{
		$matrix = new Matrix(4, 4);
		$matrix->set(0, 0, 2 / ($right - $left));
		$matrix->set(1, 1, 2 / ($top - $bottom));
		$matrix->set(2, 2, -2 / ($far - $near));
		$matrix->set(3, 0, -($right + $left) / ($right - $left));
		$matrix->set(3, 1, -($top + $bottom) / ($top - $bottom));
		$matrix->set(3, 2, -($far + $near) / ($far - $near));
		return $matrix;
	}


	public function makeProjectionMatrixPersp(float $fov, float $aspect, float $near, float $far): Matrix{
		$matrix = new Matrix(4, 4);
		$matrix->set(0, 0, 1 / tan($fov / 2));
		$matrix->set(1, 1, $aspect / tan($fov / 2));
		$matrix->set(2, 2, -($far + $near) / ($far - $near));
		$matrix->set(2, 3, -1);
		$matrix->set(3, 2, -2 * $far * $near / ($far - $near));
		return $matrix;
	}

	public function makeRotationMatrixX(float $angle): Matrix{
		$matrix = new Matrix(4, 4);
		$matrix->set(0, 0, 1);
		$matrix->set(1, 1, cos($angle));
		$matrix->set(1, 2, sin($angle));
		$matrix->set(2, 1, -sin($angle));
		$matrix->set(2, 2, cos($angle));
		$matrix->set(3, 3, 1);
		return $matrix;
	}

	public function makeRotationMatrixY(float $angle): Matrix{
		$matrix = new Matrix(4, 4);
		$matrix->set(0, 0, cos($angle));
		$matrix->set(0, 2, -sin($angle));
		$matrix->set(1, 1, 1);
		$matrix->set(2, 0, sin($angle));
		$matrix->set(2, 2, cos($angle));
		$matrix->set(3, 3, 1);
		return $matrix;
	}

	public function makeRotationMatrixZ(float $angle): Matrix{
		$matrix = new Matrix(4, 4);
		$matrix->set(0, 0, cos($angle));
		$matrix->set(0, 1, sin($angle));
		$matrix->set(1, 0, -sin($angle));
		$matrix->set(1, 1, cos($angle));
		$matrix->set(2, 2, 1);
		$matrix->set(3, 3, 1);
		return $matrix;
	}

	public function makeScaleMatrix(float $x, float $y, float $z): Matrix{
		$matrix = new Matrix(4, 4);
		$matrix->set(0, 0, $x);
		$matrix->set(1, 1, $y);
		$matrix->set(2, 2, $z);
		$matrix->set(3, 3, 1);
		return $matrix;
	}

}