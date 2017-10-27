<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once '../init.php';
$db = DB::getInstance();
$response = $html = '';

if (isset($user) && $user->isLoggedIn()) {
    $user_id = $user->data()->id;
    if ($dayLimitQ = $db->query('SELECT notif_daylimit FROM settings', array())) $dayLimit = $dayLimitQ->results()[0]->notif_daylimit;
    else $dayLimit = 7;
    $notifications = new Notification($user_id, false, $dayLimit);
    if ($notifications->getCount() > 0) {
        $html = '<ul>';
        $i = 1;
        foreach ($notifications->getNotifications() as $notif) {
            $html .= '<li class="notification-row" data-id="'.$i.'">';
            if ($notif->is_read == 0) $html .= '<span class="badge badge-notif">NEW</span> ';
            $html .= $notif->message;
            $html .='&nbsp;&nbsp;<span class="small">('.time2str($notif->date_created).')</span></li>';
            $i++;
        }
        $html .= '</ul>';
        $totalPages = ceil(round($notifications->getCount() / 10));
        if ($totalPages > 1) {
            $html .= '<div class="text-center"><ul class="pagination" id="notif-pagination">';
            if ($totalPages > 5) $html .= '<li class="first disabled"><a><<</a></li>';
            for ($i=1; $i<=$totalPages; $i++) {
                $active = '';
                if ($i == 1) $active = ' class="active"';
                $html .= '<li '.$active.'><a>'.$i.'</a></li>';
            }
            if ($totalPages > 5) $html .= '<li class="last"><a>>></a></li>';
            $html .= '</ul></div>';
        }
    }
    else {
        $html = '<div class="text-center">You have no notifications at this time.</div>';
    }
    $notifications->setReadAll();
    if ($notifications->getError() != '') $html = $notifications->getError();
}
else return false;

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode($html);
    exit;
}
