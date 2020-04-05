/**
 * This function acknowledges the post and sends an AJAX request
<<<<<<< HEAD
 *
 * @param announcement_id
=======
 * 
 * @param announcement_id 
>>>>>>> 0f91c6f9bc998e278ac774adbce1a780150523d4
 */
function acknowledge_post(announcement_id) {
    if(announcement_id !== '')
    {
        $.ajax({
            url: '/index.php/acknowledge_post/add/' + announcement_id,
            method: 'post',
            success: function (response) {
<<<<<<< HEAD
=======
                var count = document.getElementById('acknowledge_count_' + announcement_id).value; 
                count = parseInt(count, 10); //it defaults to 10 
                count++;
                document.getElementById('acknowledge_count_' + announcement_id).value = count;
                document.getElementById('acknowledge_post_' + announcement_id).style.backgroundColor = 'green';
>>>>>>> 0f91c6f9bc998e278ac774adbce1a780150523d4
                console.log(response);
                notie.alert({
                    type: 'success',
                    text: 'Post is acknowledged',
                });
            },
            error: function (response) {
                console.log(response);
<<<<<<< HEAD
                console.log("Error: There was a problem checking to see if there is an announcement");
                alert("Error: There was a problem checking to see if there is an announcement");
            }
        });
        $color = 'green';

=======
                notie.alert({
                    type: 'error',
                    text: 'There was a problem checking to see if there is an announcement',
                });
            }
        });
        
>>>>>>> 0f91c6f9bc998e278ac774adbce1a780150523d4
    }


}

