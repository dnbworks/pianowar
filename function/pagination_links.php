<?php


function generate_page_links($current_page, $num_pages){
    $page_links = "";

    if($current_page > 1){
        $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($current_page - 1) . '"><-</a>';
    } else {
        $page_links .= ' <-';
    }

    for ($i=1; $i <= $num_pages ; $i++) { 
        if($current_page == $i){
            $page_links .= ' ' . $i;
        } else {
            $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '">' . $i .'</a>';
        }

    }

    // if this page is not the last page, generate the next link

    if($current_page < $num_pages){
        $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($current_page + 1) . '">-></a>';
    } else {
        $page_links .= ' ->';
    }

    return $page_links;
}