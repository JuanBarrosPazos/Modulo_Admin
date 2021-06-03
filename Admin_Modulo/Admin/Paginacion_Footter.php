<?php


if (@$total_pages > 1) {

    echo "<div class='centradiv' >";

    if ($page != 1) {
        echo '<li class="pageli"><a href="'.$ruta.$pagedest.'?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
    }

    for ($i=1;$i<=@$total_pages;$i++) {
        if ($page == $i) {
            echo '<li class="pagelib"><a href="#">'.$page.'</a></li>';
        } else {
            echo '<li class="pageli"><a href="'.$ruta.$pagedest.'?page='.$i.'">'.$i.'</a></li>';
        }
    }

    if ($page != @$total_pages) {
        echo '<li class="pageli"><a href="'.$ruta.$pagedest.'?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
    }

    echo "</div>";

}

?>