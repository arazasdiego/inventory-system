<?php
ob_start();
require('../connection.php');
require('session.php');
require('../date.php');

if(isset($_POST['submit'])) {
	$footer = $_POST['footer'];
	$contact_address = $_POST['contact_address'];
	$contact_text = $_POST['contact_text'];
	$about = $_POST['about'];
	$home_title1 = $_POST['home_title1'];
	$home_text1 = $_POST['home_text1'];
	$home_title2 = $_POST['home_title2'];
	$home_text2 = $_POST['home_text2'];
	$home_title3 = $_POST['home_title3'];
	$home_text3 = $_POST['home_text3'];

	$old_slider1 = $_POST['old_slider1'];
	$old_slider2 = $_POST['old_slider2'];
	$errMSG = 0;



	//Slider 1
    $imgFile1= $_FILES['slider1']['name'];
    $tmp_dir1 = $_FILES['slider1']['tmp_name'];
    $imgSize1 = $_FILES['slider1']['size'];
    $errMSG = 0;

 if($imgFile1)
        {
            $upload_dir1 = '../slider/'; // upload directory   
            $imgExt1 = strtolower(pathinfo($imgFile1,PATHINFO_EXTENSION)); // get image extension
            $valid_extensions1 = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $slider1 = rand(1000,1000000).".".$imgExt1;
            if(in_array($imgExt1, $valid_extensions1))
            {           
                if($imgSize1 < 5000000)
                {
                    unlink($upload_dir1.$old_slider1);
                    move_uploaded_file($tmp_dir1,$upload_dir1.$slider1);
                }
                else
                {
                     $errMSG++;
                    echo '<script>
                window.alert("Sorry, your file is too large it should be less then 5MB.");
                 window.location.href="cms.php";
                </script>';

                   
                }
            }
            else
            {
                  $errMSG++;
                    echo '<script>
                window.alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                 window.location.href="cms.php";
                </script>';

                 
            }   
        }
        else
        {
            // if no image selected the old image remain as it is.
            $slider1 = $old_slider1; // old image from database
        } 


      //Slider 2
    $imgFile2= $_FILES['slider2']['name'];
    $tmp_dir2 = $_FILES['slider2']['tmp_name'];
    $imgSize2 = $_FILES['slider2']['size'];
    $errMSG = 0;

 if($imgFile2)
        {
            $upload_dir2 = '../slider/'; // upload directory   
            $imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension
            $valid_extensions2 = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $slider2 = rand(1000,1000000).".".$imgExt2;
            if(in_array($imgExt2, $valid_extensions2))
            {           
                if($imgSize2 < 5000000)
                {
                    unlink($upload_dir2.$old_slider2);
                    move_uploaded_file($tmp_dir2,$upload_dir2.$slider2);
                }
                else
                {
                     $errMSG++;
                    echo '<script>
                window.alert("Sorry, your file is too large it should be less then 5MB.");
                 window.location.href="cms.php";
                </script>';

                   
                }
            }
            else
            {
                  $errMSG++;
                    echo '<script>
                window.alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                 window.location.href="cms.php";
                </script>';

                 
            }   
        }
        else
        {
            // if no image selected the old image remain as it is.
            $slider2 = $old_slider2; // old image from database
        } 



 if ($errMSG == 0) {

        $update = "UPDATE cms SET footer='$footer', about='$about', contact_text='$contact_text', contact_address='$contact_address', home_title1='$home_title1', home_title2='$home_title2', home_title2='$home_title2', home_title3='$home_title3', slider1='$slider1', slider2='$slider2' WHERE ID=1";


     if($conn->query($update) === TRUE) {
        echo '<script>
        window.alert("Successfully updated.");
        window.location.href="cms.php";
        </script>';
    }

    else {
        echo 'Error: ' .$update. '<br />' .$conn->error;
    }
    }

}
ob_end_flush();
?>