<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
 
 <script type="text/javascript">
/* <![CDATA[ */

(function($) {

$.fn.changeType = function(){

    var data = [
        {
        "department": "IT",
        "jobs": [
                {"title":"Programmer"},
                {"title":"Solutions Architect"},
                {"title":"Database Developer"}
                ]
        },
        {"department": "Accounting",
        "jobs": [
                {"title":"Accountant"},
                {"title":"Payroll Officer"},
                {"title":"Accounts Clerk"},
                {"title":"Analyst"},
                {"title":"Financial Controller"}
                ]
        },
        {
        "department": "HR",
        "jobs": [
                {"title":"Recruitment Consultant"},
                {"title":"Change Management"},
                {"title":"Industrial Relations"}
                ]
        },
        {
        "department": "Marketing",
        "jobs": [
                {"title":"Market Researcher"},
                {"title":"Marketing Manager"},
                {"title":"Marketing Co-ordinator"}
                ]
        },
        {
        "department": "Finance",
        "jobs": [
                {"title":"Market Researcher"},
                {"title":"Marketing Manager"},
                {"title":"Finance Officer"}
                ]
        },   
       
            {
           
        "department": "Finance",
        "jobs": [
                {"title":"Market Researcher"},
                {"title":"Marketing Manager"},
                {"title":"Finance Officer"}
                ]
        }
       
        ]

        var options_departments = '<option>Select<\/option>';
        $.each(data, function(i,d){
            options_departments += '<option value="' + d.department + '">' + d.department + '<\/option>';
        });
        $("select#departments", this).html(options_departments);
       
        $("select#departments", this).change(function(){
            var index = $(this).get(0).selectedIndex;
            var d = data[index-1];  // -1 because index 0 is for empty 'Select' option
            var options = '';
            if (index > 0) {
                $.each(d.jobs, function(i,j){
                            options += '<option value="'+ index + j.title + '">' + j.title + '<\/option>';
                });
            } else {
                options += '<option>Select<\/option>';
            }
            $("select#jobs").html(options);
        })
};
   
})(jQuery);


$(document).ready(function() {
    $("form#search").changeType();
});

$(document).ready(function() {
    $("form#search").changeType();
});
/* ]]> */
</script>

 <title>New Web Project</title>
 </head>
 <body>
 <form id="search" action="" name="search">
    <select name="departments" id="departments">
        <option>Select Menu</option>
    </select>
           
    <select name="jobs" id="jobs">
        <option>Select Parent</option>
    </select>
</form>
 </body>
</html>