/**
 * Shows the input and populates the attendance status based on the selected cadet and event.
 */
function populate()
{
    if($('#cadet').val() !== "" && $('#event').val() !== "")
    {
        $.ajax({
            url: '/index.php/attendance/status/' + $('#cadet').val() + '/' + $('#event').val(),
            method: 'post',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if(response === null)
                {
                    $('#record').val('a');
                    $('#comment').css('display', 'none');
                }
                else if(response.excused_absence === "0")
                {
                    $('#record').val('p');
                    $('#comment').css('display', 'block');
                    $('#comments').val(response.comments);
                }
                else if(response.excused_absence === "1")
                {
                    $('#record').val('e');
                    $('#comment').css('display', 'block');
                    $('#comments').val(response.comments);
                }

                $('#hiderecord').css('display','block');
                $('#save').css('display','block');
            },
            error: function (response)
            {
                console.log(response);
                console.log("Error: Something went wrong with getting the attendance records");
                alert("Error: Something went wrong with getting the attendance records");
            }
        });
    }
    else
    {
        $('#hiderecord').css('display','none');
        $('#save').css('display','none');
    }
}

/**
 * Display's or hides the comments section.
 * 
 * @param value Present absent or excused value (p, a, or e)
 */
function newattendance(value)
{
    if(value === 'p' || value === 'e')
    {
        $('#comment').css('display', 'block');
    }
    else
    {
        $('#comment').css('display', 'none');
    }
}
