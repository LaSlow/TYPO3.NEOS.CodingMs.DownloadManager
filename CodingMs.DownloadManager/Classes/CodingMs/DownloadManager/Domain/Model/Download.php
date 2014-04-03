<?php
namespace CodingMs\DownloadManager\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "CodingMs.DownloadManager".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Download {

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $category;

	/**
     * @var \TYPO3\Flow\Resource\Resource
     * @ORM\OneToOne
	 */
	protected $download;

    /**
     * @var boolean
     */
    protected $hidden;


	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * @param string $category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * @return \TYPO3\Flow\Resource\Resource
	 */
	public function getDownload() {
		return $this->download;
	}

	/**
	 * @param \TYPO3\Flow\Resource\Resource $download
	 * @return void
	 */
	public function setDownload(\TYPO3\Flow\Resource\Resource $download) {
		$this->download = $download;
	}

    /**
     * @return boolean
     */
    public function getHidden() {
        return $this->hidden;
    }

    /**
     * @param boolean $hidden
     * @return void
     */
    public function setHidden($hidden) {
        $this->hidden = $hidden;
    }

}
?>