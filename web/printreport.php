



    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Dashboard Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>


<br>

        <!-- serachbox -->

        <div class="jumbotron " style="border-width: 0 px; padding:30px 50px 20px 50px;" align="left">

            <form class="form-signin" name="form0" method="post" action="report.php"  target="_blank">

                <input type="hidden" id="aaa" name="username" value=<?php echo $objResult[ "Username"] ?>>

                <div align="center">

                    <input type="radio" name="type" value="days" checked> 1 วันที่ผ่านมา &nbsp&nbsp&nbsp
                    <input type="radio" name="type" value="weeks" > 1 สัปดาห์ที่ผ่านมา&nbsp&nbsp&nbsp
                    <input type="radio" name="type" value="months"> 1 เดือนที่ผ่านมา&nbsp&nbsp&nbsp
                    <input type="radio" name="type" value="years"> 1 ปีที่ผ่านมา &nbsp&nbsp
                    <input type="radio" name="type" value="years2"> 2 ปีที่ผ่านมา &nbsp&nbsp
          

                       <input type="radio" name="type" value="custom2">
                       <input type="text"  style="width: 50px;" name="num" >
                       <select   name="unit">
                            <option value="days">วัน</option>
                            <option value="months">เดือน</option>
                            <option value="years">ปี</option>
                       </select>

     
ที่ผ่านมา &nbsp&nbsp  <br>หรือ &nbsp&nbsp         <br>

                    <input type="radio" name="type" value="custom" > 
                    <label for="time">ระหว่างวันที่ </label>

                    <input type="date" name="date1">

                    <label for="time"> ถึง </label>

                    <input type="date" name="date2">


              


                </div>

                <div align="right">
                    <button class="btn btn-primary" role="button" type="submit"><span class="glyphicon glyphicon-print" aria-hidden="true"> Print</button>
        </div>
      </form>
        
      </div> 
      <!-- finish searchbox -->  

</body></html>