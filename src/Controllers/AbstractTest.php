<?php


namespace Basic\Controllers;


abstract class AbstractTest
{
	public function firstName() {
		return 'Oke1';
	}

	public abstract function  hello();
}

class Kethua extends AbstractTest{
	public function hello()
	{
		return 1;
	}
}
class Kethua1 extends AbstractTest{
	public function hello()
	{
		return 3;
	}
}

$oKethua = new Kethua();

echo $oKethua->firstName() . ' ' . $oKethua->hello();

$Kethua1 = new Kethua1();

echo $Kethua1->firstName() . ' ' . $Kethua1->hello();

