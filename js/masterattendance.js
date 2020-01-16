var table;
var weektable;
var rows = Array();

//TODO: Move this work to the server
$.ajax({
    url: '/index.php/attendance/get_master',
    method: 'post',
    dataType: 'json',
    success: function (response) {
        console.log(response);
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
                field: response.events[y].id,
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
        for(var z = 0; z < response.users.length; z++)
        {
            var cadetrecord = {};

            // Sets the cadets name
            cadetrecord['name'] = response.users[z].first_name + " " + response.users[z].last_name;
            cadetrecord['class'] = response.users[z].class;

            var id = response.users[z].id;
            var ptSum = 0;
            var llabSum = 0;
            var pt = 0;
            var llab = 0;

            // Compares each event to the db and checks to see if cadet was present or absent or excused
            for(y = 0; y < response.events.length; y++)
            {
                var event_id = response.events[y].id;
                if(response.events[y].pt == 1)
                {
                    ptSum += 1;
                }
                else if(response.events[y].llab == 1)
                {
                    llabSum += 1;
                }

                for(var x = 0; x < response.events[y].attendees.length; x++)
                {
                    var attendee = response.events[y].attendees[x];
                    if( attendee.user.id === id && attendee.event.id === event_id && (attendee.event.excused_absence === null || parseInt(attendee.event.excused_absence,10) === 0))
                    {
                        if(response.events[y].pt == 1)
                        {
                            pt += 1;
                        }
                        else if(response.events[y].llab == 1)
                        {
                            llab += 1;
                        }

                        cadetrecord[response.record[x].id] = "green";
                    }
                    else if( attendee.user.id === id && attendee.user.id === event_id && parseInt(attendee.event.excused_absence, 10) === 1)
                    {
                        if(response.events[y].pt == 1)
                        {
                            pt += 1;
                        }
                        else if(response.events[y].llab == 1)
                        {
                            llab += 1;
                        }

                        cadetrecord[response.record[x].id] = "yellow";
                    }
                }
            }

            cadetrecord['pt'] = pt + " of " + ptSum;
            cadetrecord['llab'] = llab + " of " + llabSum;

            tabledata.push(cadetrecord);
        }

        table = new Tabulator("#attendance", {
            data:tabledata,
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
            columns:columns
        });


        // // Populates the weekly attendance
        // tabledata = [];
        // columns = [];
        //
        // // Adds a column for the name of the cadet
        // columns.push({
        //     title:"Cadet",
        //     field:"name",
        //     download: true,
        //     headerVertical:true
        // });
        //
        // columns.push({
        //     title:"AS Class",
        //     field:"class",
        //     download: false,
        //     visible: false
        // });
        //
        // // Adds columns for each event
        // for(var y = 0; y < response.weekevents.length; y++)
        // {
        //     columns.push({
        //         title: response.weekevents[y].name,
        //         field: response.weekevents[y].eventID,
        //         visible: true,
        //         download: true,
        //         formatter: "color",
        //     });
        // }
        //
        // columns.push({
        //     title:"PT Total",
        //     field:"pt",
        //     download: true,
        // });
        //
        // columns.push({
        //     title:"LLAB Total",
        //     field:"llab",
        //     download: true,
        // });
        //
        // // Loops through each cadet
        // for(z = 0; z < response.users.length; z++)
        // {
        //     cadetrecord = {};
        //
        //     // Sets the cadets name
        //     cadetrecord['name'] = response.users[z].first_name + " " + response.users[z].last_name;
        //     cadetrecord['class'] = response.users[z].class;
        //
        //     id = response.users[z].id;
        //     ptSum = 0;
        //     llabSum = 0;
        //     pt = 0;
        //     llab = 0;
        //
        //     // Compares each event to the db and checks to see if cadet was present or absent or excused
        //     for(y = 0; y < response.weekevents.length; y++)
        //     {
        //         event = response.weekevents[y].eventID;
        //         if(response.weekevents[y].pt == 1)
        //         {
        //             ptSum += 1;
        //         }
        //         else if(response.weekevents[y].llab == 1)
        //         {
        //             llabSum += 1;
        //         }
        //
        //         for(var x = 0; x < response.record.length; x++)
        //         {
        //             if( response.record[x].id === id && response.record[x].eventid === event && (response.record[x].excused_absence === null || parseInt(response.record[x].excused_absence,10) === 0))
        //             {
        //                 if(response.weekevents[y].pt == 1)
        //                 {
        //                     pt += 1;
        //                 }
        //                 else if(response.weekevents[y].llab == 1)
        //                 {
        //                     llab += 1;
        //                 }
        //
        //                 cadetrecord[response.record[x].eventid] = "green";
        //             }
        //             else if( response.record[x].id === id && response.record[x].eventid === event && parseInt(response.record[x].excused_absence, 10) === 1)
        //             {
        //                 if(response.weekevents[y].pt == 1)
        //                 {
        //                     pt += 1;
        //                 }
        //                 else if(response.weekevents[y].llab == 1)
        //                 {
        //                     llab += 1;
        //                 }
        //
        //                 cadetrecord[response.record[x].eventid] = "yellow";
        //             }
        //         }
        //     }
        //
        //     cadetrecord['pt'] = pt + " of " + ptSum;
        //     cadetrecord['llab'] = llab + " of " + llabSum;
        //
        //     tabledata.push(cadetrecord);
        // }
        //
        // //create Tabulator on DOM element with id "example-table"
        // weektable = new Tabulator("#weekattendance", {
        //     data:tabledata, //assign data to table
        //     placeholder:"No attendance records to show", //display message to user on empty table
        //     // layout:"fitColumns", //fit columns to width of table (optional)
        //     pagination:"local",
        //     groupBy:"class",
        //     groupHeader:function(value, count, data, group){
        //         //data - the data object for the row being grouped
        //         return "<span style='color:black; margin-left:10px;'>Class: " + data[0].class + "</span>";
        //     },
        //     paginationSize: 50,
        //     paginationSizeSelector:[10, 25, 50, 100],
        //     movableColumns:true,
        //     downloadDataFormatter:function(data)
        //     {
        //         // Changes data to export to a nicely formatted csv
        //         for(var x = 0; x < data.data.length; x++)
        //         {
        //             for(var key in data.data[x])
        //             {
        //                 if(key !== "name" && key !== "llab" && key !== "pt")
        //                 {
        //                     if(data.data[x][key] === "green")
        //                     {
        //                         data.data[x][key] = "P";
        //                     }
        //                     else if(data.data[x][key] === "yellow")
        //                     {
        //                         data.data[x][key] = "E";
        //                     }
        //                     else
        //                     {
        //                         data.data[x][key] = "A";
        //                     }
        //                 }
        //             }
        //         }
        //
        //         //return data for download
        //         return data;
        //     },
        //     downloadConfig:{
        //         rowGroups:false, //do not include row groups in download
        //     },
        //     initialSort:[
        //         {column:"class", dir:"asc"} // Sorts data by the most recent to the oldest
        //     ],
        //     columns:columns
        // });
    },
    error: function (response)
    {
        // Something went wrong
        alert('Error: Something went wrong getting the master attendance');
        console.log(response);
    }
});

// Downloads the job table to a pdf format
function download()
{
    table.download("csv", "master_attendance.csv");
}

// Downloads the job table to a pdf format
function download_week()
{
    weektable.download("csv", "week_attendance.csv");
}