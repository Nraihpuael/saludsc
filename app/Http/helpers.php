<?php

use App\Models\PageView;

function getPageViews($page)
{
    $pageView = PageView::firstOrCreate(['page' => $page]);
    $pageView->increment('views');
    return $pageView ? $pageView->views : 0;
}
