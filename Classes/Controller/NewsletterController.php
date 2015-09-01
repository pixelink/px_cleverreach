<?php
namespace PIXELINK\PxCleverreach\Controller;


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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * NewsletterController
 */
class NewsletterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * newsletterRepository
	 *
	 * @var \PIXELINK\PxCleverreach\Domain\Repository\NewsletterRepository
	 * @inject
	 */
	protected $newsletterRepository = NULL;

	/**
	 * @var integer pageId
	 */
	protected $pageId;

	/**
	 * @var null
	 */
	protected $cleverreachApi = NULL;

	/**
	 * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
	 */
	protected $contentObject;

	/**
	 * Action initializer
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->pageId = (int)GeneralUtility::_GP('id');
		$this->cleverreachApi = new \SoapClient($this->settings['wsdlUrl']);
		$this->contentObject = $this->configurationManager->getContentObject();

		// init TSFE
		\PIXELINK\PxCleverreach\Utility\GeneralUtility::initializeTsfe($_GET['id']);
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$newsletters = $this->newsletterRepository->findAll();
		$this->view->assign('newsletters', $newsletters);
	}

	/**
	 * action show
	 *
	 * @param \PIXELINK\PxCleverreach\Domain\Model\Newsletter $newsletter
	 * @return void
	 */
	public function showAction(\PIXELINK\PxCleverreach\Domain\Model\Newsletter $newsletter) {
		$this->view->assign('newsletter', $newsletter);
	}

	/**
	 * action new
	 *
	 * @param \PIXELINK\PxCleverreach\Domain\Model\Newsletter $newNewsletter
	 * @ignorevalidation $newNewsletter
	 * @return void
	 */
	public function newAction(\PIXELINK\PxCleverreach\Domain\Model\Newsletter $newNewsletter = NULL) {
		$groupsObj = $this->cleverreachApi->groupGetList($this->settings['apiKey']);
		// show error on missing api key setting
		if($groupsObj->status == 'ERROR') {
			$this->addFlashMessage(LocalizationUtility::translate('pixelinknewsletter_newsletter.api_error', $this->request->getControllerExtensionKey()) . $groups->message, '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		}

		$groups = array();
		foreach($groupsObj->data as $item) {
			$groups[$item->id] = $item->name;
		}

		$this->view->assign('groups', $groups);
		$this->view->assign('newNewsletter', $newNewsletter);

	}

	/**
	 * action create
	 *
	 * @param \PIXELINK\PxCleverreach\Domain\Model\Newsletter $newNewsletter
	 * @return void
	 */
	public function createAction(\PIXELINK\PxCleverreach\Domain\Model\Newsletter $newNewsletter) {
		$newNewsletter->setPid($this->pageId);
		$result = $this->createNewsletter($newNewsletter);

		if($result->status == 'SUCCESS') {
			$newNewsletter->setEmailId($result->data->id);
			$group = $this->cleverreachApi->groupGetDetails($this->settings['apiKey'], $newNewsletter->getGroupId());
			$newNewsletter->setGroupName($group->status === 'SUCCESS' ? $group->data->name : '');
			$this->newsletterRepository->add($newNewsletter);

			$this->addFlashMessage(LocalizationUtility::translate('pixelinknewsletter_newsletter.newsletter_created', $this->request->getControllerExtensionKey()), LocalizationUtility::translate('pixelinknewsletter_newsletter.newsletter_created_header', $this->request->getControllerExtensionKey()), \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
			$this->addFlashMessage(sprintf(LocalizationUtility::translate('pixelinknewsletter_newsletter.newsletter_detail_link', $this->request->getControllerExtensionKey()), $this->settings['emailBaseUrl'] . $result->data->id), '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
		} else {
			$this->addFlashMessage(LocalizationUtility::translate('pixelinknewsletter_newsletter.newsletter_not_created', $this->request->getControllerExtensionKey()) . $result->message, 'Error', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		}

		$this->redirect('list');
	}

	/**
	 * create newsletter in cleverreach via api
	 *
	 * @param \PIXELINK\PxCleverreach\Domain\Model\Newsletter $newsletter
	 * @return $result object
	 */
	protected function createNewsletter(\PIXELINK\PxCleverreach\Domain\Model\Newsletter $newsletter) {

		$newsletterHtml = @file_get_contents($this->getNewsletterPreviewUrl($newsletter), false);
		$newsletterPlain = $this->getNewsletterPlain($newsletter);

		$mail = array(
			"name"			=> $newsletter->getTitle(),
			"subject" 		=> $newsletter->getSubject()	,
			"sender_name" 	=> $newsletter->getSenderName(),
			"sender_email"	=> $newsletter->getSenderEmail(),
			"groupId"		=> $newsletter->getGroupId(),
			"type"			=> "html/text",
			"html"			=> $newsletterHtml,
			"text"			=> $newsletterPlain
		);

		$result = $this->cleverreachApi->mailingCreate($this->settings['apiKey'], $mail);

		return $result;
	}

	/**
	 * get newsletter text plain - render from content elements of current pid
	 *
	 * @param $newsletter
	 * @return mixed
	 */
	private function getNewsletterPlain($newsletter) {
		$templateFile = $GLOBALS['TSFE']->tmpl->setup['config.']['baseURL'] . $GLOBALS['TSFE']->tmpl->setup['module.']['tx_pxcleverreach.']['settings.']['template.']['plain'];

		// if template file not defined, return empty string
		if(file_get_contents($templateFile) === false) {
			return '';
		}

		// return all ce's of current pid
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tt_content', 'pid = ' . $newsletter->getPid() . $GLOBALS['TSFE']->sys_page->enableFields('tt_content'), '', 'sorting ASC');

		$content = '';
		foreach ($rows as $row) {
			$content .= $this->contentObject->RECORDS(array(
				'tables' => 'tt_content',
				'source' => $row['uid']
			));
		}

		return str_replace('###CONTENT###', $this->clearContent($content), file_get_contents($templateFile, false));
	}

	/**
	 * return newsletter preview url
	 *
	 * @param $newsletter
	 * @return string
	 */
	protected function getNewsletterPreviewUrl($newsletter) {

		$params = array(
			'parameter' => (String)$newsletter->getPid(),
			'returnLast' => 'url'
		);


		return $GLOBALS['TSFE']->cObj->typolink('', $params);
	}

	/**
	 * remove html tags and replace paragraph and breaks by newlines
	 *
	 *
	 * @param $content
	 * @return mixed|string
	 */
	protected function clearContent($content) {
		$content = str_replace('</p>', "\n\n", $content);
		$content = str_replace('<br>', "\n", $content);
		$content = str_replace('<br />', "\n", $content);
		$content = strip_tags($content);

		return $content;
	}

	/**
	 * overwrite original function
	 *
	 * @return string
	 */
	protected function getErrorFlashMessage(){
		return false;
	}

}