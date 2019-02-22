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

            columns.push({
                title:"AS Class",
                field:"class",
                download: false,
                visible: false
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

            columns.push({
                title:"PT Total",
                field:"pt",
                download: true,
                headerVertical:true
            });

            columns.push({
                title:"LLAB Total",
                field:"llab",
                download: true,
                headerVertical:true
            });

            // Loops through each cadet
            for(var z = 0; z < response.cadet.length; z++)
            {
                var cadetrecord = {};

                // Sets the cadets name
                cadetrecord['name'] = response.cadet[z].firstName + " " + response.cadet[z].lastName;
                cadetrecord['class'] = response.cadet[z].rank;

                var rin = response.cadet[z].rin;
                var ptSum = 0;
                var llabSum = 0;
                var pt = 0;
                var llab = 0;

                // Compares each event to the db and checks to see if cadet was present or absent or excused
                for(y = 0; y < response.events.length; y++)
                {
                    var event = response.events[y].eventID;
                    if(response.events[y].pt == 1)
                    {
                        ptSum += 1;
                    }
                    else if(response.events[y].llab == 1)
                    {
                        llabSum += 1;
                    }

                    for(var x = 0; x < response.record.length; x++)
                    {
                        if( response.record[x].rin === rin && response.record[x].eventid === event && (response.record[x].excused_absence === null || parseInt(response.record[x].excused_absence,10) === 0))
                        {
                            if(response.events[y].pt == 1)
                            {
                                pt += 1;
                            }
                            else if(response.events[y].llab == 1)
                            {
                                llab += 1;
                            }

                            cadetrecord[response.record[x].eventid] = "green";
                        }
                        else if( response.record[x].rin === rin && response.record[x].eventid === event && parseInt(response.record[x].excused_absence, 10) === 1)
                        {
                            if(response.events[y].pt == 1)
                            {
                                pt += 1;
                            }
                            else if(response.events[y].llab == 1)
                            {
                                llab += 1;
                            }

                            cadetrecord[response.record[x].eventid] = "yellow";
                        }
                    }
                }

                cadetrecord['pt'] = pt + " of " + ptSum;
                cadetrecord['llab'] = llab + " of " + llabSum;

                tabledata.push(cadetrecord);
            }

            //create Tabulator on DOM element with id "example-table"
            table = new Tabulator("#attendance", {
                data:tabledata, //assign data to table
                placeholder:"No attendance records to show", //display message to user on empty table
                // layout:"fitColumns", //fit columns to width of table (optional)
                pagination:"local",
                groupBy:"class",
                groupHeader:function(value, count, data, group){
                    //data - the data object for the row being grouped
                    return "<span style='color:black; margin-left:10px;'>Class: " + data[0].class + "</span>";
                },
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

                    //return data for download
                    return data;
                },
                downloadConfig:{
                    rowGroups:false, //do not include row groups in download
                },
                initialSort:[
                    {column:"class", dir:"asc"} // Sorts data by the most recent to the oldest
                ],
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
