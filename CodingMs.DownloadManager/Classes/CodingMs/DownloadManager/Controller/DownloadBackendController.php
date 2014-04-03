<?php
namespace CodingMs\DownloadManager\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "NeosDemoTypo3Org".      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License as published by the Free   *
 * Software Foundation, either version 3 of the License, or (at your      *
 * option) any later version.                                             *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */
use TYPO3\Flow\Annotations as Flow;
use CodingMs\DownloadManager\Domain\Model\Download;
use CodingMs\DownloadManager\Domain\Repository\DownloadRepository;

/**
 * The DownloadManager module controller
 *
 * @Flow\Scope("singleton")
 */
class DownloadBackendController extends \TYPO3\Neos\Controller\Module\AbstractModuleController {

    /**
     * @Flow\Inject
     * @var DownloadRepository
     */
    protected $downloadRepository;

    /**
     * @return void
     */
    public function indexAction() {
        $downloads = $this->downloadRepository->findAll();
        $this->view->assign('downloads', $downloads);
    }

    /**
     * Action for updating a download
     *
     * @param Download $download
     * @return void
     */
    public function updateDownloadAction(Download $download) {
        $this->downloadRepository->update($download);
        $this->persistenceManager->persistAll();
        $this->redirect("index");
    }

    /**
     * Action for deleting a download
     *
     * @param Download $download
     * @return void
     */
    public function deleteDownloadAction(Download $download) {
        $this->downloadRepository->remove($download);
        $this->persistenceManager->persistAll();
        $this->redirect("index");
    }

    /**
     * Action for editing a download
     *
     * @param Download $download
     * @return void
     */
    public function editDownloadAction(Download $download) {
        $this->view->assign('download', $download);
        $this->view->assign('settings', $this->settings);
    }

    /**
     * Action for editing a download
     *
     * @return void
     */
    public function newDownloadAction() {
        $download = new Download();
        $this->view->assign('download', $download);
        $this->view->assign('settings', $this->settings);
    }

    /**
     * Action for inserting a download
     *
     * @param Download $download
     * @return void
     */
    public function insertDownloadAction(Download $download) {
        $this->downloadRepository->add($download);
        $this->persistenceManager->persistAll();
        $this->redirect("index");
    }

    /**
     * Generates the DisplayCategories-JSON
     * @return void
     */
    public function displayCategoriesAction() {
        $displayModes = array();
        $displayModesTrimed = array();

        $downloads = $this->downloadRepository->findAll();
        if($downloads->count()>0) {
            foreach($downloads as $download) {
                $displayModes = array_merge(explode(',', $download->getCategory()), $displayModes);
            }
            foreach($displayModes as $displayMode) {
                $displayModesTrimed[trim($displayMode)] = trim($displayMode);
            }
        }

        echo json_encode($displayModesTrimed);
        exit;
    }

}
?>