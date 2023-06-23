<?php

namespace App\Helper;

/**
 * Description of Pagination
 */
class Pagination
{
    const POSSIBLE_SIZE = [2, 3, 5, 15, 25, 50];

    protected $pageSize;
    protected $currentPage;
    protected $totalPage;

    public function __construct( protected string $url ){}


    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setPageSize($pageSize): void
    {
        $this->pageSize = $pageSize;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage): void
    {
        if (!is_numeric($currentPage))
        {
            throw new Exception('The current page must be numeric');
        }

        $this->currentPage = (int) $currentPage;
    }

    public function getTotalPage()
    {
        return $this->totalPage;
    }

    public function setTotalPage($totalPage): void
    {
        $this->totalPage = $totalPage;
    }

    public function getPreviouse()
    {
        return $this->currentPage - 1;
    }

    public function getNext()
    {
        return $this->currentPage + 1;
    }

    public function generatePagination()
    {
        $page = 0;

        $htmlResult = '<nav aria-label="page navigation"><ul class="pagination">';

        $prevDisable = $this->currentPage <= 1 ? 'disabled' : '';
        $htmlResult .= '<li class="page-item ' . $prevDisable . '"><a class="page-link" href="' . $this->url . '/' . $this->getPreviouse() . '?size=' . $this->getPageSize() . '">Previous</a></li>';

        for ($i = 0; $i < $this->totalPage; $i += $this->getPageSize())
        {
            $page++;
            $active = $this->currentPage === $page ? 'active' : '';
            $htmlResult .= '<li class="page-item ' . $active . '"><a class="page-link" href="' . $this->url . '/' . $page . '?size=' . $this->getPageSize() . '">' . $page . '</a></li>';
        }

        $nextDisable = $this->currentPage >= $page ? 'disabled' : '';
        $htmlResult .= '<li class="page-item ' . $nextDisable . '"><a class="page-link" href="' . $this->url . '/' . $this->getNext() . '?size=' . $this->getPageSize() . '">Next</a></li>';

        $htmlResult .= '</ul></nav>';

        return $htmlResult;
    }

    /**/
    public function generatePageSizer()
    {
        $htmlResult = '<form><div class="form-group">
            <label for="size">Lista Méret:</label>
            <select id="size" name="size">';

        foreach (self::POSSIBLE_SIZE as $size)
        {
            $selected = $size === $this->getPageSize() ? 'selected' : '';
            $htmlResult .= '<option ' . $selected . ' value="' . $size . '" >' . $size . '</option>';
        }

        $htmlResult .= '</select>
            <button type="submit" class="btn btn-outline-primary">Listáz</button>
            </div></form>';

        return $htmlResult;
    }

}
