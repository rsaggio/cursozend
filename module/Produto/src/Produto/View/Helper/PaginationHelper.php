<?php
namespace Produto\View\Helper;

use Zend\View\Helper\AbstractHelper;

class PaginationHelper extends AbstractHelper
{
    private $resultsPerPage;
    private $totalResults;
    private $results;
    private $baseUrl;
    private $paging;
    private $page;

    public function __invoke($pagedResults, $page, $baseUrl, $resultsPerPage=10)
    {
        $this->resultsPerPage = $resultsPerPage;
        $this->totalResults = $pagedResults->count();
        $this->results = $pagedResults;
        $this->baseUrl = $baseUrl;
        $this->page = $page;

        return $this->generatePaging();
    }

    private function generatePaging()
    {

    	$this->paging = "<ul class=\"nav nav-pills\">";
        $pages = ceil($this->totalResults / $this->resultsPerPage);

        if($pages == 1)
        {
            return;
        }

        if($this->page != 1)
        {
            $this->paging .= "<li><a href=\"{$this->baseUrl}/1\"><<</a></li>";
        }

        $pageCount = 1;

        while($pageCount <= $pages)
        {
        	if($pageCount == $this->page) {
        		$this->paging .= "<li class=\"active\"><a href=\"{$this->baseUrl}/{$pageCount }\">{$pageCount}</a></li>";	
        	}else {
            	$this->paging .= "<li><a href=\"{$this->baseUrl}/{$pageCount }\">{$pageCount}</a></li>";
            }
            $pageCount++;
        }

        if($this->page != $pages)
        {
            $this->paging .= "<li><a href=\"{$this->baseUrl}/{$pages}\">>></a></li>";
        }

        return $this->paging;
    }
}
