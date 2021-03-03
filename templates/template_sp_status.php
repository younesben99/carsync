<?php

switch ($sp_koopstatus) {
    case 'tekoop':
        echo('<div class="sp_sticky_status sp_beschikbaar">Beschikbaar</div>');
        break;
    case 'gereserveerd':
        echo('<div class="sp_sticky_status sp_gereserveerd">Gereserveerd</div>');
        break;
    case 'verkocht':
        echo('<div class="sp_sticky_status sp_verkocht">Verkocht</div>');
        break;
    default:
        break;
}


?>