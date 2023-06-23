<?php

namespace App\Service;

use App\Helper\Pagination;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;

/**
 * Description of PaginationService
 */
class PaginationService
{
    protected $totalRecord;
    protected $pageSize = 2;
    protected $currentPage = 1;
    protected $pagination;

    /**
     * @var ServiceEntityRepositoryInterface $workRepo
     * @desc - The repository, that the class will working on
     */
    public function __construct(
        protected ServiceEntityRepositoryInterface $workRepo,
        private string $baseUrl,
        int $currentPage,
        int $size
    )
    {
        $this->totalRecord = $this->workRepo->count([]);

        if ($size > 0)
        {
            $this->pageSize = $size;
        }

        $this->currentPage = $currentPage;

        $this->pagination = $this->initPagination();
    }

    /**/
    protected function initPagination()
    {
        $pagination = new Pagination($this->baseUrl);
        $pagination->setTotalPage($this->totalRecord);
        $pagination->setCurrentPage($this->currentPage);
        $pagination->setPageSize($this->pageSize);

        return $pagination;
    }

    /**/
    public function getTotalRecord()
    {
        return $this->totalRecord;
    }

    /**
     * @desc - Get the paginated content
     */
    public function getCurrentContent()
    {
        $offset = 0;
        if ($this->currentPage > 1)
        {
            $offset = ($this->currentPage - 1) * $this->pagination->getPageSize();
        }

        return $this->workRepo->findBy([], [], $this->pageSize , $offset);
    }

    /**
     * @desc - Get the rendered HTML ready pagination
     * @return string
     */
    public function renderPagination(): string
    {
        return $this->pagination->generatePagination();
    }

    /**
     *
     * @return string
     */
    public function renderPageSizer(): string
    {
        return $this->pagination->generatePageSizer();
    }

}
