<?php
namespace PIXELINK\PxCleverreach\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Lukas Jakob <lu.jakob@googlemail.com>, Pixel Ink
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Newsletter
 */
class Newsletter extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * subject
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $subject = '';

	/**
	 * senderName
	 *
	 * @var string
	 */
	protected $senderName = '';

	/**
	 * senderEmail
	 *
	 * @var string
	 */
	protected $senderEmail = '';

	/**
	 * groupId
	 *
	 * @var string
	 * @validate NotEmpty
	  */
	protected $groupId = '';

	/**
	 * groupName
	 *
	 * @var string
	 */
	protected $groupName = '';

	/**
	 * crdate
	 *
	 * @var int
	 */
	protected $crdate;

	/**
	 * emailId
	 *
	 * @var int
	 */
	protected $emailId;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the subject
	 *
	 * @return string $subject
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Sets the subject
	 *
	 * @param string $subject
	 * @return void
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
	}

	/**
	 * Returns the senderName
	 *
	 * @return string $senderName
	 */
	public function getSenderName() {
		return $this->senderName;
	}

	/**
	 * Sets the senderName
	 *
	 * @param string $senderName
	 * @return void
	 */
	public function setSenderName($senderName) {
		$this->senderName = $senderName;
	}

	/**
	 * Returns the senderEmail
	 *
	 * @return string $senderEmail
	 */
	public function getSenderEmail() {
		return $this->senderEmail;
	}

	/**
	 * Sets the senderEmail
	 *
	 * @param string $senderEmail
	 * @return void
	 */
	public function setSenderEmail($senderEmail) {
		$this->senderEmail = $senderEmail;
	}

	/**
	 * Returns the groupId
	 *
	 * @return string $groupId
	 */
	public function getGroupId() {
		return $this->groupId;
	}

	/**
	 * Sets the groupId
	 *
	 * @param string $groupId
	 * @return void
	 */
	public function setGroupId($groupId) {
		$this->groupId = $groupId;
	}

	/**
	 * Returns the groupName
	 *
	 * @return string $groupName
	 */
	public function getGroupName() {
		return $this->groupName;
	}

	/**
	 * Sets the groupName
	 *
	 * @param string $groupName
	 * @return void
	 */
	public function setGroupName($groupName) {
		$this->groupName = $groupName;
	}

	/**
	 * Returns the crdate
	 *
	 * @return int $crdate
	 */
	public function getCrdate() {
		return $this->crdate;
	}

	/**
	 * Sets the crdate
	 *
	 * @param int $crdate
	 */
	public function setCrdate($crdate) {
		$this->crdate = time();
	}

	/**
	 * Returns the emailId
	 *
	 * @return int $emailId
	 */
	public function getEmailId() {
		return $this->emailId;
	}

	/**
	 * Sets the emailId
	 *
	 * @param int $emailId
	 */
	public function setEmailId($emailId) {
		$this->emailId = $emailId;
	}

}