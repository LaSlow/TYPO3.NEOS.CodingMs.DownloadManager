<?php
namespace CodingMs\DownloadManager\Controller;

/*                                                                          *
 * This script belongs to the TYPO3 Flow package "CodingMs.DownloadManager".*
 *                                                                          *
 *                                                                          */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;
use CodingMs\DownloadManager\Domain\Model\Download;
use CodingMs\DownloadManager\Domain\Repository\DownloadRepository;

class DownloadController extends \TYPO3\Flow\Mvc\Controller\ActionController {

    /**
     * @Flow\Inject
     * @var DownloadRepository
     */
    protected $downloadRepository;

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Resource\ResourceManager
     */
    protected $resourceManager;

    /**
     * @var string Display-Mode
     */
    protected $displayCategory = '';

    /**
     * Initialize Action
     */
    public function initializeAction() {

        /**
         * @var $actionRequest \TYPO3\Flow\Mvc\ActionRequest
         */
        $actionRequest = $this->getControllerContext()->getRequest();
        $internalArguments = $actionRequest->getInternalArguments();
        // Load and check display category
        if(isset($internalArguments['__displayCategory'])) {
            $this->displayCategory = $internalArguments['__displayCategory'];
        }
        //var_dump($internalArguments);

    }

    /**
	 * @return void
	 */
	public function indexAction() {
        $downloads = $this->downloadRepository->findAllByCategoryAndNotHidden($this->displayCategory);
        $this->view->assign('downloads', $downloads);
        $this->view->assign('displayCategory', $this->displayCategory);
	}

}

?>