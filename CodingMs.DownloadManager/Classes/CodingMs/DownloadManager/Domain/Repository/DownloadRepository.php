<?php
namespace CodingMs\DownloadManager\Domain\Repository;

/*                                                                          *
 * This script belongs to the TYPO3 Flow package "CodingMs.DownloadManager".*
 *                                                                          *
 *                                                                          */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class DownloadRepository extends Repository {

    /**
     * Sucht einen User
     *
     * @param string $category Category
     * @return mixed QueryResult
     */
    public function findAllByCategoryAndNotHidden($category='') {

        /**
         * @var \TYPO3\Flow\Persistence\QueryInterface $query
         */
        $query = $this->createQuery();

        $constraints   = array();
        $constraints[] = $query->like('category', '%'.$category.'%', FALSE);
        $constraints[] = $query->equals('hidden', FALSE);

        // Query bauen und ausfuehren
        return $query
               ->matching($query->logicalAnd($constraints))
               ->execute();
    }
}
?>