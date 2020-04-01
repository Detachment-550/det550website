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
                var count = document.getElementById('acknowledge_count_' + announcement_id).value; 
                count = parseInt(count, 10); //it defaults to 10 
                count++;
                document.getElementById('acknowledge_count_' + announcement_id).value = count;
                document.getElementById('acknowledge_post_' + announcement_id).style.backgroundColor = 'green';
                console.log(response);
                notie.alert({
                    type: 'success',
                    text: 'Post is acknowledged',
                });
                // TODO: Change the front end to a green color
                // TODO: Increment the count of acknowledgements by 1
            },
            error: function (response) {
                console.log(response);
                // TODO: Change this alert to a notie alert but use the error class instead of the success class
                alert("Error: There was a problem checking to see if there is an announcement");
            }
        });
        
    }


}

