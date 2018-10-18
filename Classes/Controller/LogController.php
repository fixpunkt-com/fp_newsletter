<?php
namespace Fixpunkt\FpNewsletter\Controller;

/***
 *
 * This file is part of the "Newsletter managment" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Kurt Gusbeth <k.gusbeth@fixpunkt.com>, fixpunkt werbeagentur gmbh
 *
 ***/

/**
 * LogController
 */
class LogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * logRepository
     *
     * @var \Fixpunkt\FpNewsletter\Domain\Repository\LogRepository
     * @inject
     */
    protected $logRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $logs = $this->logRepository->findAll();
        $this->view->assign('logs', $logs);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
    	$genders = [
    			"0" => $this->settings['gender']['please'],
    			"1" => $this->settings['gender']['mrs'],
    			"2" => $this->settings['gender']['mr']
    	];
    	$optional = [];
    	$optionalFields = $this->settings['optionalFields'];
    	if ($optionalFields) {
    		$tmp = explode( ',', $optionalFields );
    		foreach ($tmp as $field) {
    			$optional[trim($field)] = 1;
    		}
    	}
    	$log = $this->objectManager->get('Fixpunkt\\FpNewsletter\\Domain\\Model\\Log');
    	if ($this->settings['parameters']['email']) {
    		$email = $_GET[$this->settings['parameters']['email']];
    		if (!$email) {
    			$email = $_POST[$this->settings['parameters']['email']];
    		}
    		if ($email) {
    			$log->setEmail($email);
    		}
    	}
    	$this->view->assign('genders', $genders);
    	$this->view->assign('optional', $optional);
    	$this->view->assign('log', $log);
    }

    /**
     * action create
     *
     * @param \Fixpunkt\FpNewsletter\Domain\Model\Log $log
     * @return void
     */
    public function createAction(\Fixpunkt\FpNewsletter\Domain\Model\Log $log)
    {
        //$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $hash = md5(uniqid($log->getEmail(), true));
        $log->setSecurityhash($hash);
        $log->setStatus(1);
    	$this->logRepository->add($log);
    	$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
    	$persistenceManager->persistAll();
    	$error = 0;
    	$db_uid = 0;
    	$email = $log->getEmail();
    	$dbuidext = 0;
    	
    	if ($this->settings['table'] == 'tt_address') {
    		$dbuidext = $this->logRepository->getFromTTAddress($email, $log->getPid());
    	}
    	if ($dbuidext > 0) {
    		$error = 6;
    	} else {
	    	$from = trim($log->getFirstname() . ' ' . $log->getLastname());
	    	if (!$from) $from = 'Subscriber';
	    	$dataArray = array();
	    	$dataArray['uid'] = $log->getUid();
	    	$dataArray['email'] = $email;
	    	$dataArray['hash'] = $hash;
	    	$dataArray['subscribeVerifyUid'] = $this->settings['subscribeVerifyUid'];
	    	$dataArray['settings'] = $this->settings;
	    	$this->sendTemplateEmail(
	    			array($email => $from),
	    			array($this->settings['email']['senderMail'] => $this->settings['email']['senderName']),
	    			$this->settings['email']['subscribeVerifySubject'],
	    			'SubscribeVerify',
	    			$dataArray
			);
    	}

    	if (($error == 0) && ($this->settings['subscribeMessageUid'])) {
    		$uri = $this->uriBuilder->reset()
    			->setTargetPageUid($this->settings['subscribeMessageUid'])
    			->build();
    		$this->redirectToURI($uri);
    		//$this->forward($this->settings['subscribeMessageUid']);
    	} else {
	    	$this->view->assign('error', $error);
    	}
    }

    /**
     * action edit
     *
     * @param \Fixpunkt\FpNewsletter\Domain\Model\Log $log
     * @ignorevalidation $log
     * @return void
     */
    public function editAction(\Fixpunkt\FpNewsletter\Domain\Model\Log $log)
    {
        $this->view->assign('log', $log);
    }

    /**
     * action update
     *
     * @param \Fixpunkt\FpNewsletter\Domain\Model\Log $log
     * @return void
     */
    public function updateAction(\Fixpunkt\FpNewsletter\Domain\Model\Log $log)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->logRepository->update($log);
        $this->redirect('list');
    }

    /**
     * action unsubscribe with form
     *
     * @return void
     */
    public function unsubscribeAction()
    {
    	$storagePidsArray = $this->logRepository->getStoragePids();
    	$pid = intval($storagePidsArray[0]);
    	$log = $this->objectManager->get('Fixpunkt\\FpNewsletter\\Domain\\Model\\Log');
    	$log->setPid($pid);
    	if ($this->settings['parameters']['email']) {
    		$email = $_GET[$this->settings['parameters']['email']];
    		if (!$email) {
    			$email = $_POST[$this->settings['parameters']['email']];
    		}
    		if ($email) {
    			$log->setEmail($email);
    		}
    	}
    	$this->view->assign('log', $log);
    }

    /**
     * action unsubscribe with direct_mail link
     *
     * @return void
     */
    public function unsubscribeDMAction()
    {
    	$error = 0;
    	$tables = ['t' => 'tt_address', 'f' => 'fe_users'];
    	$t = $tables[$_GET['t']];
    	$u = intval($_GET['u']);
    	$a = $_GET['a'];
    	if($t && $t==$this->settings['table'] && $u && $a){
    
    		$res=$GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->settings['table'], 'deleted=0 AND uid=' . $u,'','',1);
    		$user=$GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
    		if($user){
    			if(preg_match('/^[0-9a-f]{8}$/', $a) && ($a == \TYPO3\CMS\Core\Utility\GeneralUtility::stdAuthCode($user, 'uid'))) {
   					// unsubscribe user now
    				$this->redirect('delete', NULL, NULL, ['user' => $user]);	
    			} else {
    				$error = 10;
    			}
    		} else {
    			$error = 11;
    		}
    	} else {
    		$error = 10;
    	}
    	$this->view->assign('error', $error);
    }
    
    /**
     * action delete an user from the DB: unsubscribe him from the newsletter
     *
     * @param \Fixpunkt\FpNewsletter\Domain\Model\Log $log
     * @param array $user
     * @return void
     */
    public function deleteAction(\Fixpunkt\FpNewsletter\Domain\Model\Log $log = NULL, $user = [])
    {
    	$error = 0;
    	if (!$log) {
    		$log = $this->objectManager->get('Fixpunkt\\FpNewsletter\\Domain\\Model\\Log');
    		$log->setEmail($user['email']);
    		$log->setPid($user['pid']);
    	}
    	$email = $log->getEmail();
    	$pid = $log->getPid();
    	if (!$pid) {
    		$storagePidsArray = $this->logRepository->getStoragePids();
    		$pid = intval($storagePidsArray[0]);
    	}
    	$dbuidext = 0;

    	if ($this->settings['table'] == 'tt_address') {
    		$dbuidext = intval($this->logRepository->getFromTTAddress($email, $pid));
    	} else {
    		// TODO
    	}
    	if ($dbuidext == 0) {
    		$error = 7;
    	} else {
    		$log->setStatus(7);
    		$this->logRepository->add($log);
    		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
    		$persistenceManager->persistAll();
    		if ($this->settings['deleteMode'] == 2) {
    			if ($this->settings['table'] == 'tt_address') {
    				$result = $GLOBALS['TYPO3_DB']->exec_DELETEquery(
						'tt_address',
						'uid=' . $dbuidext
					);
    			}
    		} else {
    			if ($this->settings['table'] == 'tt_address') {
    				$update = array('deleted' => 1, 'tstamp' => time());
					$GLOBALS['TYPO3_DB']->exec_UPDATEquery('tt_address', 'uid=' . $dbuidext, $update);
    			}
    		}
    	}
    	
	    if (($error == 0) && ($this->settings['unsubscribeVerifyMessageUid'])) {
	   		$uri = $this->uriBuilder->reset()
	   			->setTargetPageUid($this->settings['unsubscribeVerifyMessageUid'])
	   			->build();
	   		$this->redirectToURI($uri);
	   		//$this->forward($this->settings['subscribeMessageUid']);
	   	} else {
	    	$this->view->assign('error', $error);
	   	}
        //$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        //$this->logRepository->remove($log);
        //$this->redirect('list');
    }

    /**
     * action verify
     *
     * @return void
     */
    public function verifyAction()
    {
    	$error = 0;
    	$dbuid = 0;
    	$html = intval($this->settings['module_sys_dmail_html']);
    	$uid = intval($this->request->hasArgument('uid')) ? $this->request->getArgument('uid') : 0;
    	$hash = ($this->request->hasArgument('hash')) ? $this->request->getArgument('hash') : '';
    	if (!$uid || !$hash) {
    		$this->view->assign('error', 1);
    	} else {
    		$address = $this->logRepository->findOneByUid($uid);
    		$dbuid = $address->getUid();
    		if (!$dbuid) {
    			$error = 2;
    		} elseif ($address->getStatus() == 2) { 
    			$error = 5;
    	    } else {
    			$dbhash = $address->getSecurityhash();
    			if ($hash != $dbhash) {
    				$error = 3;
    			} else {
    				$dbstatus = $address->getStatus();
    				$dbname = trim($address->getFirstname() . ' ' . $address->getLastname());
    				$dbemail = $address->getEmail();
    				$now = new \DateTime();
    				$diff = $now->diff($address->getTstamp())->days;
    				if ($diff > $this->settings['daysExpire']) {
    					$error = 4;
    				} else {
    					$dbuidext = 0;
    					if ($this->settings['table'] == 'tt_address') {
	    					$dbuidext = $this->logRepository->getFromTTAddress($dbemail, $address->getPid());
    					}
    					if ($dbuidext > 0) {
    						$error = 6;
    					} else {
	    					$address->setStatus(2);
	    					$this->logRepository->update($address);
	    					$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
	    					$persistenceManager->persistAll();
	    					$timestamp = time();
	    					if ($this->settings['table'] == 'tt_address') {
	    						if ($address->getGender() == 1) $gender = 'f';
	    						elseif ($address->getGender() == 2) $gender = 'm';
	    						else $gender = '';
	    						// crdate fehlt in älteren Versionen!
	    						$insert = ['pid' => intval($address->getPid()),
	    								'tstamp' => $timestamp,
	    								'crdate' => $timestamp,
	    								'title' => $address->getTitle(),
	    								'first_name' => $address->getFirstname(),
	    								'last_name' => $address->getLastname(),
	    								'name' => $dbname,
	    								'email' => $dbemail,
	    								'module_sys_dmail_html' => $html];
	    						if ($gender) {
	    							$insert['gender'] = $gender;
	    						}
	    						//var_dump($insert);
	    						$success = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_address', $insert);
	    						if (!$success) {
	    							$error = 8;
	    						}
	    					} elseif ($this->settings['table'] == 'fe_users') {
	    						// TODO
	    						//$GLOBALS['TYPO3_DB']->exec_INSERTquery('fe_users', $insert);
	    					}
    					}
    				}
    			}
    		}
    		
	    	if (($error == 0) && ($this->settings['subscribeVerifyMessageUid'])) {
	    		$uri = $this->uriBuilder->reset()
	    		->setTargetPageUid($this->settings['subscribeVerifyMessageUid'])
	    		->build();
	    		$this->redirectToURI($uri);
	    		//$this->forward($this->settings['subscribeMessageUid']);
	    	} else {
		    	$this->view->assign('error', $error);
	    	}
    	}
    }
    

    /**
     * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
     * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
     * @param string $subject subject of the email
     * @param string $templateName template name (UpperCamelCase)
     * @param array $variables variables to be passed to the Fluid view
     * @return boolean TRUE on success, otherwise false
     */
    protected function sendTemplateEmail(array $recipient, array $sender, $subject, $templateName, array $variables = array()) {
    	// Alternative: http://lbrmedia.net/codebase/Eintrag/extbase-60-standalone-template-renderer/
    	// Das hier ist von hier: http://wiki.typo3.org/How_to_use_the_Fluid_Standalone_view_to_render_template_based_emails
    	// und https://wiki.typo3.org/How_to_use_the_Fluid_Standalone_view_to_render_template_based_emails
    	$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
    	/* for ($i=10; $i>=0; $i--) {
    		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPaths'][$i]);
    		if (is_file($templateRootPath . 'Email/' . $templateName . '.html')) {
    			break;
    		}
    	} */
    	$lang = intval($GLOBALS['TSFE']->sys_language_uid);
    	if ($lang > 0) {
    		$templateName .= $lang;
    	}
    	
    	/** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
    	$emailViewHtml = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
    	//$templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.html';
    	//$emailViewHtml->setTemplatePathAndFilename($templatePathAndFilename);
    	$emailViewHtml->setTemplateRootPaths($extbaseFrameworkConfiguration['view']['templateRootPaths']);
    	$emailViewHtml->setLayoutRootPaths($extbaseFrameworkConfiguration['view']['layoutRootPaths']);
    	$emailViewHtml->setPartialRootPaths($extbaseFrameworkConfiguration['view']['layoutRootPaths']);
    	$emailViewHtml->setTemplate('Email/' . $templateName . '.html');
    	$emailViewHtml->setFormat('html');
    	$emailViewHtml->assignMultiple($variables);
    	$emailBodyHtml = $emailViewHtml->render();
    
    	/** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
    	$emailViewText = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
    	//$templatePathAndFilename = $templateRootPath . 'Email/' . $templateName . '.txt';
    	//$emailViewText->setTemplatePathAndFilename($templatePathAndFilename);
    	$emailViewText->setTemplateRootPaths($extbaseFrameworkConfiguration['view']['templateRootPaths']);
    	$emailViewText->setLayoutRootPaths($extbaseFrameworkConfiguration['view']['layoutRootPaths']);
    	$emailViewText->setPartialRootPaths($extbaseFrameworkConfiguration['view']['layoutRootPaths']);
    	$emailViewText->setTemplate('Email/' . $templateName . '.txt');
    	$emailViewText->setFormat('txt');
    	$emailViewText->assignMultiple($variables);
    	$emailBodyText = $emailViewText->render();
    
    	/** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
    	$message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
    	$message->setTo($recipient);
    	$message->setFrom($sender)
    	->setSubject($subject);
    
    	// Plain text example
    	$message->setBody($emailBodyText, 'text/plain');
    
    	// HTML Email
    	$message->setBody($emailBodyHtml, 'text/html');
    
    	$message->send();
    	return $message->isSent();
    }
}
