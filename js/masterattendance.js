var table;
var rows = Array();

// Loads and displays all of the jobs in the database
function loadattendance(siteurl)
{
    $.ajax({
        url: siteurl + '/attendance/getmaster',
        method: 'post',
        dataType: 'json',
        success: function (response) {
            var tabledata = [];
            var columns = [];

            // Adds a column for the name of the cadet
            columns.push({
                title:"Cadet",
                field:"name",
                download: true,
                headerVertical:true
            });

            // Adds columns for each event
            for(var y = 0; y < response.events.length; y++)
            {
                columns.push({
                    title: response.events[y].name,
                    field: response.events[y].eventID,
                    visible: true,
                    download: true,
                    formatter: "color",
                    headerVertical:true
                });
            }

            // Loops through each cadet
            for(var z = 0; z < response.cadet.length; z++)
            {
                var cadetrecord = {};

                // Sets the cadets name
                cadetrecord['name'] = response.cadet[z].firstName + " " + response.cadet[z].lastName;

                // Compares each event to the db and checks to see if cadet was present or absent or excused
                for(y = 0; y < response.events.length; y++)
                {
                    for(var x = 0; x < response.record.length; x++)
                    {
                        if( response.record[x].rin === response.cadet[z].rin && response.record[x].eventid === response.events[y].eventID && response.record[x].excused_absence === null)
                        {
                            cadetrecord[response.record[x].eventid] = "green";
                        }
                        else if( response.record[x].rin === response.cadet[z].rin && response.record[x].eventid === response.events[y].eventID && response.record[x].excused_absence === "1")
                        {
                            cadetrecord[response.record[x].eventid] = "yellow";
                        }
                    }
                }
                tabledata.push(cadetrecord);
            }

            //create Tabulator on DOM element with id "example-table"
            table = new Tabulator("#attendance", {
                data:tabledata, //assign data to table
                placeholder:"No attendance records to show", //display message to user on empty table
                // layout:"fitColumns", //fit columns to width of table (optional)
                pagination:"local",
                // groupBy:function(data){
                //     //data - the data object for the row being grouped
                //     var day = new Date(data.finished);
                //     var compstr = day.getDate() + "/" + day.getMonth() + "/" + day.getFullYear();
                //     return compstr; //groups by day, month, and year
                // },
                // groupHeader:function(value, count, data, group){
                //     //data - the data object for the row being grouped
                //     var day = new Date(data[0].finished);
                //
                //     return "<span style='color:black; margin-left:10px;'>" + day.getMonth() + "/" + day.getDate() + "/" + day.getFullYear() + "</span>";
                // },
                paginationSize: 100,
                paginationSizeSelector:[10, 25, 50, 100],
                movableColumns:true,
                downloadDataFormatter:function(data)
                {
                    // Changes data to export to a nicely formatted csv
                    for(var x = 0; x < data.data.length; x++)
                    {
                        for(var key in data.data[x])
                        {
                            if(key !== "name")
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

                    //return data for download
                    return data;
                },
                // downloadConfig:{
                //     rowGroups:true, //do not include row groups in download
                // },
                // initialSort:[
                //     {column:"finished", dir:"desc"} // Sorts data by the most recent to the oldest
                // ],
                columns:columns
            });
        },
        error: function (response)
        {
            // Something went wrong
            console.log(response);
        }
    });
}

// Downloads the job table to a pdf format
function download()
{
    table.download("csv", "master_attendance.csv");
}
