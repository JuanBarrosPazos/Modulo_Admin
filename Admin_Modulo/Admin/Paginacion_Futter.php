<?php

if ($total_pages > 1) {
    if ($page != 1) {
        echo '<li class="pageli"><a href="'.$ruta.'Admin_Ver.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
    }

    for ($i=1;$i<=$total_pages;$i++) {
        if ($page == $i) {
            echo '<li class="pageli"><a href="#">'.$page.'</a></li>';
        } else {
            echo '<li class="pageli"><a href="'.$ruta.'Admin_Ver.php?page='.$i.'">'.$i.'</a></li>';
        }
    }

    if ($page != $total_pages) {
        echo '<li class="pageli"><a href="'.$ruta.'Admin_Ver.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}

?>