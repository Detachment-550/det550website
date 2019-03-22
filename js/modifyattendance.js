// Shows the input and populates the attendance status based on the selected cadet and event
function populate(siteurl)
{
    var cadet = document.getElementById('cadet');
    var event = document.getElementById('event');
    var record = document.getElementById('record');

    if(cadet.value !== "" && event.value !== "")
    {
        $.ajax({
            url: siteurl + '/attendance/status',
            method: 'post',
            data: {
                cadet: cadet.value,
                event: event.value,
            },
            dataType: 'json',
            success: function (response) {
                if(response.status === null)
                {
                    record.value = 'a';
                }
                else if(response.status.excused_absence === "0")
                {
                    record.value = 'p';
                }
                else if(response.status.excused_absence === "1")
                {
                    record.value = 'e';
                }

                document.getElementById('hiderecord').style.display = 'block';
                document.getElementById('save').style.display = 'block';
            },
            error: function (response)
            {
                // Something went wrong
                console.log("Error: Something went wrong with getting the attendance records");
                alert("Error: Something went wrong with getting the attendance records");
            }
        });
    }
    else
    {
        document.getElementById('hiderecord').style.display = 'none';
        document.getElementById('save').style.display = 'none';
    }
}
