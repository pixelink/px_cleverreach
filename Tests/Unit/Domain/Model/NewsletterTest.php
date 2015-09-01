<?php

namespace PIXELINK\PxCleverreach\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Lukas Jakob <lu.jakob@googlemail.com>, Pixel Ink
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \PIXELINK\PxCleverreach\Domain\Model\Newsletter.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Lukas Jakob <lu.jakob@googlemail.com>
 */
class NewsletterTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \PIXELINK\PxCleverreach\Domain\Model\Newsletter
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \PIXELINK\PxCleverreach\Domain\Model\Newsletter();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSubjectReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSubject()
		);
	}

	/**
	 * @test
	 */
	public function setSubjectForStringSetsSubject() {
		$this->subject->setSubject('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'subject',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSenderNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSenderName()
		);
	}

	/**
	 * @test
	 */
	public function setSenderNameForStringSetsSenderName() {
		$this->subject->setSenderName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'senderName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSenderEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSenderEmail()
		);
	}

	/**
	 * @test
	 */
	public function setSenderEmailForStringSetsSenderEmail() {
		$this->subject->setSenderEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'senderEmail',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGroupIdReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getGroupId()
		);
	}

	/**
	 * @test
	 */
	public function setGroupIdForStringSetsGroupId() {
		$this->subject->setGroupId('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'groupId',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPageIdReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPageId()
		);
	}

	/**
	 * @test
	 */
	public function setPageIdForStringSetsPageId() {
		$this->subject->setPageId('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'pageId',
			$this->subject
		);
	}
}
