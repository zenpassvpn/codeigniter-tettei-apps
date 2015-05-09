<?php

class Cart_model_test extends PHPUnit_Framework_TestCase
{
	public static function setUpBeforeClass()
	{
		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('ProductSeeder');
	}

	public function setUp()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('shop/Cart_model');
		$this->obj = $this->CI->Cart_model;
	}

	public function test_add()
	{
		$this->obj->add(1, 1);
		$this->obj->add(2, 2);
		$actual = $this->obj->count();
		$this->assertEquals(2, $actual);
	}

		public function test_delete()
	{
		$this->obj->add(2, 2);
		$this->obj->add(2, 0);
		$actual = $this->obj->count();
		$this->assertEquals(0, $actual);
	}

	public function test_get_all()
	{
		$this->obj->add(1, 1);
		$this->obj->add(1, 1);
		$this->obj->add(2, 2);
		
		$actual = $this->obj->get_all();
		$expected = [
			'items' => [
				1 =>[
					'id' => 1,
					'qty' => 1,
					'name' => 'CodeIgniter徹底入門',
					'price' => '3800',
					'amount' => 3800,
				],
				2 => [
					'id' => 2,
					'qty' => 2,
					'name' => 'CodeIgniter徹底入門 CD',
					'price' => '3800',
					'amount' => 7600,
				],
			],
			'line' => 2,
			'total' => 11400,
		];
		$this->assertEquals($expected, $actual);
	}
}
