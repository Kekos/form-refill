<?php declare(strict_types=1);

namespace Kekos\FormRefill\Tests;

use Kekos\FormRefill\FormRefill;
use PHPUnit\Framework\TestCase;

final class FormRefillTest extends TestCase {

	/**
	 * @covers FormRefill::getDataAtPath
	 */
	public function testGetDataAtPathLevel1(): void {
		$expected = 'baz';

		$refill = new FormRefill();
		$refill->setPostData([
			'foo' => 'nope',
			'bar' => $expected,
		]);

		$this->assertEquals($expected, $refill->getDataAtPath('bar', ''));
	}

	/**
	 * @covers FormRefill::getDataAtPath
	 */
	public function testGetDataAtPathLevelDeep(): void {
		$expected = 'baz';

		$refill = new FormRefill();
		$refill->setPostData([
			'foo' => 'nope',
			'bar' => [
				'boo' => [
					'faz' => $expected,
				],
			],
		]);

		$this->assertEquals($expected, $refill->getDataAtPath('bar.boo.faz', ''));
	}

	/**
	 * @covers FormRefill::getDataAtPath
	 */
	public function testGetDataNoneExisting(): void {
		$expected = 'baz';

		$refill = new FormRefill();

		$this->assertEquals($expected, $refill->getDataAtPath('bar', $expected));
	}

	/**
	 * @covers FormRefill::refillText
	 */
	public function testRefillText(): void {
		$refill = new FormRefill();
		$refill->setPostData([
			'bar' => 'fo<o',
		]);

		$result = $refill->refillText('bar');

		$this->assertEquals(' value="fo&lt;o"', $result);
	}

	/**
	 * @covers FormRefill::refillRadio
	 */
	public function testRefillRadioOn(): void {
		$refill = new FormRefill();
		$refill->setPostData([
			'bar' => 'yes',
		]);

		$result = $refill->refillRadio('bar', 'yes');

		$this->assertEquals(' checked', $result);
	}

	/**
	 * @covers FormRefill::refillRadio
	 */
	public function testRefillRadioOff(): void {
		$refill = new FormRefill();
		$refill->setPostData([
			'bar' => 'no',
		]);

		$result = $refill->refillRadio('bar', 'yes');

		$this->assertEquals('', $result);
	}

	/**
	 * @covers FormRefill::refillTextarea
	 */
	public function testRefillTextarea(): void {
		$refill = new FormRefill();
		$refill->setPostData([
			'bar' => 'fo<o',
		]);

		$result = $refill->refillTextarea('bar');

		$this->assertEquals('fo&lt;o', $result);
	}

	/**
	 * @covers FormRefill::refillOption
	 */
	public function testRefillOptionMatch(): void {
		$refill = new FormRefill();
		$refill->setPostData([
			'bar' => '2',
		]);

		$result = $refill->refillOption('bar', '2');

		$this->assertEquals(' selected', $result);
	}

	/**
	 * @covers FormRefill::refillOption
	 */
	public function testRefillOptionNoMatch(): void {
		$refill = new FormRefill();
		$refill->setPostData([
			'bar' => '1',
		]);

		$result = $refill->refillOption('bar', '2');

		$this->assertEquals('', $result);
	}
}
