<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>試題</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <h3>a. 查詢特定學生</h3>
            <input name="a_id" type="text" class="form-control" placeholder="id">
            <button id="a" type="button" class="btn btn-primary btn-sm" >查詢</button>
        </div>
        <div class="flex-center position-ref full-height">
            <h3>b. 依條件查詢學生</h3>
            <input name="b_id" type="text" class="form-control" placeholder="id"><br>
            <input name="b_name" type="text" class="form-control" placeholder="name" ><br>
            <input name="b_registerDate" type="date" class="form-control" placeholder="registerDate">
            <button id="b" type="button" class="btn btn-primary btn-sm" >查詢</button>
        </div>
        <div class="flex-center position-ref full-height">
            <h3>c. 查詢所有學生</h3>
            <input name="c_start" type="text" class="form-control" placeholder="startRow">
            <input name="c_limit" type="text" class="form-control" placeholder="limit" >
            <button id="c" type="button" class="btn btn-primary btn-sm" >查詢</button>
        </div>
        <div class="flex-center position-ref full-height">
            <h3>d. 新增一個學生</h3>
            *<input name="d_name" type="text" class="form-control" placeholder="name"><br>
            *<input name="d_birthday" type="date" class="form-control" placeholder="birthday"><br>
            *<input name="d_registerDate" type="date" class="form-control" placeholder="registerDate"><br>
            <input name="d_remark" type="text" class="form-control" placeholder="remark" >
            <button id="d" type="button" class="btn btn-primary btn-sm" >建立</button>
        </div>
        <div class="flex-center position-ref full-height">
            <h3>e. 查詢各科成績的學生人數</h3>
            <button id="e" type="button" class="btn btn-primary btn-sm" >查詢</button>
        </div>

        <div class="flex-center position-ref full-height">
            <h3>Result</h3>
            <textarea id="result" rows="25" cols="100" disabled="disabled">
            </textarea>
        </div>
    </body>
</html>

<script type="text/javascript">
    $("#a").click(function () {
        var id = $('input[name=a_id]').val();
        if (id == '') {
            alert('請輸入ID');
            return false;
        }
        $.ajax({
            url: "/assignments/api/v1/students/" + id,
            data: "",
            type:"GET",
            dataType:'text',

            success: function(msg){
                $("#result").val();
                $("#result").val(msg);
            },

             error:function(xhr, ajaxOptions, thrownError){ 
                $("#result").val();
                $("#result").val(JSON.stringify(xhr['responseText']));
             }
        });
    });

    $("#b").click(function () {
        var id           = $('input[name=b_id]').val();
        var name         = $('input[name=b_name]').val();
        var registerDate = $('input[name=b_registerDate]').val();

        var sendInfo = {
            id: id,
            name: name,
            registerDate: registerDate,
        };
        $.ajax({
            url: "/assignments/api/v1/students/r",
            data: sendInfo,
            type:"POST",
            dataType:'json',

            success: function(msg){
                $("#result").val();
                $("#result").val(JSON.stringify(msg));
            },

             error:function(xhr, ajaxOptions, thrownError){ 
                $("#result").val();
                $("#result").val(JSON.stringify(xhr['responseText']));
             }
        });
    });

    $("#c").click(function () {
        var start = $('input[name=c_start]').val();
        var limit = $('input[name=c_limit]').val();
        $.ajax({
            url: "/assignments/api/v1/students/?start=" + start + "&limit=" + limit,
            data: "",
            type:"GET",
            dataType:'text',

            success: function(msg){
                $("#result").val();
                $("#result").val(msg);
            },

             error:function(xhr, ajaxOptions, thrownError){ 
                $("#result").val();
                $("#result").val(JSON.stringify(xhr['responseText']));
             }
        });
    });

    $("#d").click(function () {
        var name         = $('input[name=d_name]').val();
        var birthday     = $('input[name=d_birthday]').val();
        var registerDate = $('input[name=d_registerDate]').val();
        var remark       = $('input[name=d_remark]').val();

        if (name == '' || birthday == '' || registerDate == '') {
            alert('請輸入必填欄位');
            return false;
        }

        var sendInfo = {
           name: name,
           birthday: birthday,
           registerDate: registerDate,
           remark: remark
        };

        $.ajax({
            url: "/assignments/api/v1/students/c",
            data: sendInfo,
            dataType: "json",
            type:"POST",

            success: function(msg){
                $("#result").val();
                $("#result").val(JSON.stringify(msg));
            },

             error:function(xhr, ajaxOptions, thrownError){ 
                $("#result").val();
                $("#result").val(JSON.stringify(xhr['responseText']));
             }
        });
    });

    $("#e").click(function () {
        $.ajax({
            url: "/assignments/api/v1/students/grades",
            data: "",
            type:"GET",
            dataType:'text',

            success: function(msg){
                $("#result").val();
                $("#result").val(msg);
            },

             error:function(xhr, ajaxOptions, thrownError){ 
                $("#result").val();
                $("#result").val(JSON.stringify(xhr['responseText']));
             }
        });
    });
</script>