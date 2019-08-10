// Shows the input and populates the attendance status based on the selected cadet and event
function populate()
{
    if($('#cadet').val() !== "" && $('#event').val() !== "")
    {
        $.ajax({
            url: '/index.php/attendance/status',
            method: 'post',
            data: {
                cadet: $('#cadet').val(),
                event: $('#event').val(),
            },
            dataType: 'json',
            success: function (response) {
                if(response.status === null)
                {
                    $('#record').val('a');
                    $('#comment').css('display', 'none');
                }
                else if(response.status.excused_absence === "0")
                {
                    $('#record').val('p');
                    $('#comment').css('display', 'block');
                    $('#comments').val(response.status.comments);
                }
                else if(response.status.excused_absence === "1")
                {
                    $('#record').val('e');
                    $('#comment').css('display', 'block');
                    $('#comments').val(response.status.comments);
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

/*
 * Display's or hides the comments section.
 * 
 * @param value - present absent or excused value
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
