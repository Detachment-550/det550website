/**
 * This function acknowledges the post and sends an AJAX request
 *
 * @param announcement_id
 */
function acknowledge_post(announcement_id) {
    if(announcement_id !== '')
    {
        $.ajax({
            url: '/index.php/acknowledge_post/add/' + announcement_id,
            method: 'post',
            success: function (response) {
                console.log(response);
                notie.alert({
                    type: 'success',
                    text: 'Post is acknowledged',
                });
            },
            error: function (response) {
                console.log(response);
                console.log("Error: There was a problem checking to see if there is an announcement");
                alert("Error: There was a problem checking to see if there is an announcement");
            }
        });
        $color = 'green';

    }


}

