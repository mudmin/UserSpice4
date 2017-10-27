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
?>

<!-- Bootstrap Core JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php if (isset($user) && $user->isLoggedIn()) { ?>

<div id="notificationsModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Notifications</h4>
        </div>
        <div id="notificationsModalBody" class="modal-body"></div>
        <div class="modal-footer">
            <div class="btn-group"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
        </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $('#notificationsTrigger').on('click', function(){
        $.ajax({
            url: '<?=$us_url_root?>users/parsers/getNotifications.php',
            type: 'POST',
            success: function(response) {
                $('#notificationsModalBody').html(response);
                $('#notifCount').hide();
                displayNotifRows(1);
            },
            error: function() {
                $('#notificationsModalBody').html('<div class="text-center">There was an error retrieving your notifications.</div>');
            }
        });
        $('#notificationsModal').on('shown.bs.modal', function(e){
            $('#notificationsTrigger').on('focus', function(e){$(this).blur();});
        });
    });
    $(document).on("click", "#notif-pagination li", function(event){
        var pageId = $(this).find('a').text();
        if (pageId == '>>') pageId = $('#notif-pagination li:nth-last-child(2) a').text();
        if (pageId == '<<') pageId = 1;
        displayNotifRows(pageId);
    });
    function displayNotifRows(pageId) {
        $('#notif-pagination li.active').removeClass('active');
        $('#notif-pagination li a').filter(function(index) { return $(this).text() == pageId; }).parent().addClass('active');
        var floor = (pageId - 1) * 10;
        var ceil = pageId * 10;
        $.each($('.notification-row'), function(){
            var id = $(this).data('id');
            console.log(id);
            if (id > floor && id <= ceil) $(this).show();
            else $(this).hide();
        });
        if (pageId == 1) $('#notif-pagination .first').addClass('disabled');
        else $('#notif-pagination .first').removeClass('disabled');
        if (pageId == $('#notif-pagination li').length-2) $('#notif-pagination .last').addClass('disabled');
        else $('#notif-pagination .last').removeClass('disabled');
    }
});
</script>
<?php } ?>
