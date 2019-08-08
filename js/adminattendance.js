var approve_button = function(cell, formatterParams){ //plain text value
    return "<button class='btn-sm btn-success' type='button' onclick='approve_memo(" + cell.getRow().getData().memo_id +
        ")'>Approve</button>";
};

var deny_button = function(cell, formatterParams){ //plain text value
    return "<button class='btn-sm btn-danger' type='button' onclick='deny_memo(" + cell.getRow().getData().memo_id +
        ")'>Deny</button>";
};

var memo_table = new Tabulator("#memo_table", {
    placeholder:"There are no new memos at this time",
    layout:"fitColumns",
    ajaxURL:"/index.php/attendance/get_new_memos",
    ajaxContentType:"json",
    height: "400px",
    index:'excuse_id',
    ajaxResponse:function(url, params, response){
        //url - the URL of the request
        //params - the parameters passed with the request
        //response - the JSON object returned in the body of the response.
        console.log(response);
        for(var x = 0; x < response.length; x++)
        {
            response[x].full_name = response[x].first_name + ' ' + response[x].last_name;
        }
        return response; //return the tableData property of a response json object
    },
    columns:[ //Define Table Columns
        {title:"Memo ID", field:"memo_id", visible: false},
        {title:"Event ID", field:"event", visible: false},
        {title:"Event", field:"name"},
        {title:"User", field:"full_name"},
        {title:"Date", field:"date_created", align:"center", formatter:"datetime", formatterParams:{
                inputFormat:"YYYY-MM-DD hh:mm:ss",
                outputFormat:"M/D/YY h:mm A",
                invalidPlaceholder:"No Date",
            }},
        {title:"Approved", field:"approved", visible: false},
        {title:"Comments", field:"comments", formatter:"textarea"},
        {title:"Approve", formatter:approve_button, width:100, align:"center", headerSort:false },
        {title:"Deny", formatter:deny_button, width:100, align:"center", headerSort:false },

    ]
});

/*
 * Approves a memo.
 */
function approve_memo(memo_id) {
    $.ajax({
        url: '/index.php/attendance/approve_memo/' + memo_id,
        method: 'post',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            memo_table.setData();
        },
        error: function (response)
        {
            console.log(response);
            console.log("Error: Something went wrong with approving the memo");
            alert("Error: Something went wrong with approving the memo");
        }
    });
}

/*
 * Denies a memo.
 */
function deny_memo(memo_id) {
    $.ajax({
        url: '/index.php/attendance/deny_memo/' + memo_id,
        method: 'post',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            memo_table.setData();
        },
        error: function (response)
        {
            console.log(response);
            console.log("Error: Something went wrong with denying the memo");
            alert("Error: Something went wrong with denying the memo");
        }
    });
}