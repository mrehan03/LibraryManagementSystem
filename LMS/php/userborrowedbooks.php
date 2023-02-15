<?php
include("connection.php");


session_start();
$uemail = $_SESSION['useremail'];

?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>return books</title>
    
    <link rel="stylesheet" href="../css/navbar-secondary-pages.css">
 
    <link rel="stylesheet" href="../css/footer-secondary.css">  
    <!-- <link rel="stylesheet" href="../css\userLogin.css"> -->
    <link rel="stylesheet" href="../css/borrowbook.css">

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="../javaScript\userPage.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>
    <div class="borrownavbar">
        <?php
        require_once('seconderyHeader.php');
        ?>
    </div>
    <div class="borrowmainbox">

<!--  -->

<div class="book-records">
    <div class="books-records-content">


</div>


           <!--  -->
<?php
include("connection.php");
error_reporting(0);
// echo $uemail;
$query = "SELECT * FROM BORROWEDBOOKS WHERE USEREMAIL = '$uemail'";
$data = mysqli_query($conn, $query);
$size = mysqli_num_rows($data);





if($size != 0){
    while($result = mysqli_fetch_assoc($data)){


        $bookname = $result['bookname'];
        $bookauthor=$result['bookauthor'];
        $borrowid = $result['borrowid'];
    
        
        echo " 
        
      
        <div class='books-records-content'>
  
        <div class='book-container'>
            <div class='book-image'>
                <img src='' alt='' srcset=''>
            </div>
            <div class='book-details'>
                <h1 class='bookname'>".$bookname."</h1>
                <h1 class='bookauthor'>By:".$bookauthor."</h1> 
                <p class='bookAbout'>Borrow ID:".$borrowid."</p>
                <a><button class='burrowButton' id = 'returnbutton' data-borrowid='{$borrowid}'>Return book</button></a>
            </div>
        </div>
    
    </div>
               
";
        echo "<br>";
       
    }
}
else{
    echo "empty Table!!";
}


?>

<!--  -->
    </div>
    </div>
    <div class="borrowfooter">
    <?php
        require_once('secondaryFooter.php');
        ?>
   
    </div>

    <script>
         
   $(document).on("click","#returnbutton",function(){
    var Bookborrowid = $(this).data("borrowid");

    // alert(bookname);
   
    $.ajax({
               url:"userbookreturn.php",
               type:"POST",
               data:{requestborrowid:Bookborrowid},
               success:function(data){ 
                // alert(data);
                    if(data = "yes"){
                        alert("Book Returned");
                        window.location = "userborrowedbooks.php";
                    }
                    else{
                        alert("Request Failed!!");
                    }
                  
            }   

            });
   });
    </script>
</body>

