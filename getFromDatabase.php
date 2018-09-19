<?php

      include_once('DatabaseConnection.php');

    if($conn == false)
    {

    }
    else
    {
        $sql = "SELECT id, name, email, comment, date FROM `first_level` ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
        {

            $count = 0;
            while($row = mysqli_fetch_assoc($result))
            {

                echo('

                <div class="row mb-2 pb-3 ml-3 mr-0 backroun">
                        <div class="col-4">
                            <div>'.$row["name"].' '.$row["date"].'</div>
                        </div>
                        <div class="col-8">
                            <button id="reply" class="float-right" onclick="myFunction('.$count.')">reply</button>
                        </div>
                            <div class="w-100"></div>
                        <div class="col">
                        <div>'.$row["comment"].'</div>
                        </div>
                </div>

                    <div class="row row mb-2 pb-3 ml-3 mr-0" id="forma'.$count.'" style="display: none">
                            <div class="col">
                            <lable class="">Email*</lable>
                            </div>
                            <div class="col">
                            <input type="email" id="email'.$count.'" required="required" style="width:100%"/>
                            </div>
                            <div class="col">
                            <lable>Name*</lable>
                            </div>
                            <div class="col">
                            <input type="text" id="name'.$count.'" required="required" style="width:100%" />
                            </div>
                            <div class="col"></div>
                            <div class="w-100"></div>
                            <div class="col">
                            <lable class="">Comment*</lable>
                            </div>
                            <div class="col">
                            <input type="text" id="comment'.$count.'" required="required" style="width:100%">
                            </div>
                            <input type="hidden" id="tab'.$count.'" value="second_level" >
                            <input type="hidden" id="id'.$count.'" value="'.$row["id"].'" >
                            <div class="col">
                            <input class="" type="submit" name="submitButton" onclick="sendData('.$count.'), newest()" class="btn-default" value="submit" >
                            </div>
                            <div class="col">
                            </div>
                    </div>
                ');
                $id = $row['id'];
                $sql2 = "SELECT id, name, email, comment, first_level_id, date FROM `second_level` WHERE first_level_id = $id ORDER BY id DESC";
                $result2 = mysqli_query($conn, $sql2);
                if(mysqli_num_rows($result2) > 0)
                {
                    while($row2 = mysqli_fetch_assoc($result2))
                    {
                        echo('
                        <div class="row mb-2 ml-0 mr-0">
                            <div class="col-11 offset-1 backroun">
                                <div class="col-11 nopadding">
                                    <div>'.$row2["name"].' '.$row2["date"].'</div>
                                </div>
                                <div class="col-11 nopadding">
                                    <div>'.$row2["comment"].'</div>
                                </div>
                            </div>
                        </div>
                        ');
                    }
                }
                $count++;
            }
            echo('</div>');

        }
    }
?>
<script>

            function myFunction(count) {
            var x = document.getElementById("forma"+count);
            if (x.style.display === "block") {
            x.style.display = "none";
            } else {
            x.style.display = "block";
            }
            }
</script>
