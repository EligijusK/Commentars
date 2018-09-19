<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <script src="js/jquery-3.3.1.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script>
            var first = 0;
            var second = 0;

            $.ajax({
            type: "GET",
            url: "CountDatabase.php",
            dataType: "json",   //expect html to be returned
            success: function(response){

                first = response.first;
                second = response.second;

            }
            });

            function newest()
            {
            setTimeout( function()
            {
             $.ajax({    //create an ajax request to getFromDatabase.php
            type: "GET",
            url: "getFromDatabase.php",
            dataType: "html",   //expect html to be returned
            success: function(response){
            $("#refresh").html(response);
            }
            });
            }, 500)
            }

        </script>
    </head>
    <body>
    <?php
    $count = -1;
        echo('
    <div class="container">
        <div class="row">
            <div class="col-2">
            <lable class="float-md-right">Email*</lable>
            </div>
            <div class="col-5">
            <input type="email" id="email" required="required" style="width:100%"/>
            </div>
            <div class="col-1 ">
            <lable>Name*</lable>
            </div>
            <div class="col-4">
            <input type="text" id="name" required="required" style="width:100%" />
            </div>
            <div class="col-2">
            <lable class="float-md-right">Comment*</lable>
            </div>
            <div class="col-10">
            <input type="text" id="comment" required="required" style="width:100%">
            </div>
            <input type="hidden" id="tab" value="first_level" >
            <div class="col-3">
            <input class="float-md-right" type="submit" name="submitButton" onclick="sendData('.$count.'), newest()" class="btn-default" value="submit" >
            </div>
            <div class="col-7">
            </div>
        </div>

    ');

    ?>
    <div>comments:</div>
    <div class="comments" id="refresh">
    </div>
    </body>
            <script type="text/javascript">

            function sendData(count)
            {
            if(count == -1)
            {
            if($('#email').val().length > 0 && $('#name').val().length > 0 && $('#comment').val().length > 0 && $('#tab').val().length > 0)
            {
            $.ajax({
            type:'POST',
            url:'./addToDatabase',
            data:{email: $('#email').val(), nam: $('#name').val(), comment: $('#comment').val(), tab: $('#tab').val() },
            dataType:'JSON'
            });
            }
            else
            {
                alert('pleas fill all fields');
            }
            }
            else if(count != -1)
            {
            if($('#email'+count).val().length > 0 && $('#name'+count).val().length > 0 && $('#comment'+count).val().length > 0 && $('#tab'+count).val().length > 0)
            {
            $.ajax({
            type:'POST',
            url:'./addToDatabase',
            data:{email: $('#email'+count).val(), nam: $('#name'+count).val(), comment: $('#comment'+count).val(), tab: $('#tab'+count).val(), id: $('#id'+count).val() },
            dataType:'JSON'
            });
            }
            else
            {
                alert('pleas fill all fields');
            }
            }
            }

             $.ajax({    //create an ajax request to getFromDatabase.php
            type: "GET",
            url: "getFromDatabase.php",
            dataType: "html",   //expect html to be returned
            success: function(response){
            $("#refresh").html(response);
                }
            });

            function refresh()
            {
                                $.ajax({
                type: "GET",
                url: "CountDatabase.php",
                dataType: "json",   //expect html to be returned
                success: function(response){
                    if(response.first > first || response.second > second)
                    {
                    first = response.first;
                    second = response.second;
                    $.ajax({    //create an ajax request to getFromDatabase.php
                    type: "GET",
                    url: "getFromDatabase.php",
                    dataType: "html",   //expect html to be returned
                    success: function(response){
                         $("#refresh").html(response);
                    }
                    });
                    }
                }
            });
            }

            var timer = setInterval(refresh, 1000);

        </script>
</html>
