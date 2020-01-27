var table;
var week_table;
var rows = Array();
var start_date = '';
var end_date = '';

// Gets the start and end dates for the master table based on which semester we're in
if(parseInt(moment().format('M'), 10) <= 6)
{
    start_date = moment().format('Y') + '-01-01';
    end_date = moment().format('Y') + '-07-01';
}
else
{
    start_date = moment().format('Y') + '-07-01';
    end_date = moment().format('Y') + '-12-31';
}

// Gets attendance for the week
$.ajax({
    url: '/index.php/attendance/get_attendance_records/' + moment().day(0).format('Y-M-D') + '/' +  moment().day(7).format('Y-M-D'),
    method: 'post',
    dataType: 'json',
    success: function (response) {
        console.log(response);

        week_table = new Tabulator("#weekattendance", {
            data: response.user_records,
            placeholder:"No attendance records to show",
            pagination:"local",
            groupBy:"class",
            groupHeader:function(value, count, data, group){
                return "<span style='color:black; margin-left:10px;'>Class: " + data[0].class + "</span>";
            },
            paginationSize: 50,
            paginationSizeSelector:[10, 25, 50, 100],
            movableColumns:true,
            downloadDataFormatter:function(data)
            {
                // Changes data to export to a nicely formatted csv
                for(var x = 0; x < data.data.length; x++)
                {
                    for(var key in data.data[x])
                    {
                        if(key !== "name" && key !== "llab" && key !== "pt")
                        {
                            if(data.data[x][key] === "green")
                            {
                                data.data[x][key] = "P";
                            }
                            else if(data.data[x][key] === "yellow")
                            {
                                data.data[x][key] = "E";
                            }
                            else
                            {
                                data.data[x][key] = "A";
                            }
                        }
                    }
                }

                return data;
            },
            downloadConfig:{
                rowGroups:false,
            },
            initialSort:[
                {column:"class", dir:"asc"}
            ],
            columns: response.columns,
        });
    },
    error: function (response)
    {
        // Something went wrong
        alert('Error: Something went wrong getting the master attendance');
        console.log(response);
    }
});


$.ajax({
    url: '/index.php/attendance/get_attendance_records/' + start_date + '/' + end_date,
    method: 'post',
    dataType: 'json',
    success: function (response) {
        console.log(response);

        table = new Tabulator("#attendance", {
            data: response.user_records,
            placeholder:"No attendance records to show",
            pagination:"local",
            groupBy:"class",
            groupHeader:function(value, count, data, group){
                return "<span style='color:black; margin-left:10px;'>Class: " + data[0].class + "</span>";
            },
            paginationSize: 50,
            paginationSizeSelector:[10, 25, 50, 100],
            movableColumns:true,
            downloadDataFormatter:function(data)
            {
                // Changes data to export to a nicely formatted csv
                for(var x = 0; x < data.data.length; x++)
                {
                    for(var key in data.data[x])
                    {
                        if(key !== "name" && key !== "llab" && key !== "pt")
                        {
                            if(data.data[x][key] === "green")
                            {
                                data.data[x][key] = "P";
                            }
                            else if(data.data[x][key] === "yellow")
                            {
                                data.data[x][key] = "E";
                            }
                            else
                            {
                                data.data[x][key] = "A";
                            }
                        }
                    }
                }

                return data;
            },
            downloadConfig:{
                rowGroups:false,
            },
            initialSort:[
                {column:"class", dir:"asc"}
            ],
            columns: response.columns,
        });
    },
    error: function (response)
    {
        // Something went wrong
        alert('Error: Something went wrong getting the master attendance');
        console.log(response);
    }
});

/**
 * Downloads the job table to a pdf format.
 */
function download()
{
    table.download("csv", "master_attendance.csv");
}

/**
 * Downloads the job table to a pdf format
 */
function download_week()
{
    week_table.download("csv", "week_attendance.csv");
}