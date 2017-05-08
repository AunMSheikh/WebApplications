<?php
	//require_once "mockup/login.php";
	//require_once "view/login.php";
	session_save_path("sess");
	session_start(); 

	ini_set('display_errors', 'On');

	$errors=array();
	$view="";

	/* controller code */
	if(!isset($_SESSION['state'])){
		$_SESSION['state']='login';
	}

	switch($_SESSION['state']){
		case "login":
			// the view we display by default
			$view="login.php";

			// check if submit or not
			if(empty($_REQUEST['submit']) || 
			($_REQUEST['submit']!="login" &&  $_REQUEST['submit']!="Create a New Account")){
				break;
			}

			if ($_REQUEST['submit']== "Create a New Account" ){
				$_SESSION['state']='cprofile';
                                $view="profile.php";
				break;
                      	} 

			if(empty($_REQUEST['user'])){
	//			echo "user error";
				$errors[]='user is required';
			}
			
			if(empty($_REQUEST['password'])){
				echo "pass error";	
				$errors[]='password is required';
			}
			
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			//type is database credentials
			$dbconn = pg_connect();
		
			if(!$dbconn){
	//			echo("Can't connect to the database");	
				exit;
			}
	
			$query="SELECT * from appuser where username=$1 and password=$2;";

			$result=pg_prepare($dbconn, "find_user", $query);

			$result=pg_execute($dbconn, "find_user", array($_REQUEST['user'], $_REQUEST['password']));

			if($result){
				if($row = pg_fetch_array($result)) { 
					if ($row['type']){		
						$_SESSION['state']=$row['type'];
                                                $view="$row[type].php"; 
					} else {
						$_SESSION['state']='eprofile';
                                		$view="profile.php";				
				
					}
				} else {
		//			echo "<script>
		//				function myFunction() {
		//				    alert('Hello! I am an alert box!');
		//				}
		//				</script>";
					echo "<center>This combination was not found. 
						Please create an account or enter password correctly.</center>";
					$errors[]="invalid login";
				}
			}
			
			break;

		case "cprofile":
			// the view we display by for creating a profile
			$view="profile.php";
			if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="Submit"){
                                $_SESSION['state']='login';
                                $view = "login.php";
                                break;
                        } 
			if(empty($_REQUEST['user'])){
        //                      echo "user error";
                                $errors[]='user is required';
                        }

                        if(empty($_REQUEST['password'])){
                                echo "pass error";
                                $errors[]='password is required';
                        }

                        if(!empty($errors))break;
			
			else if ($_REQUEST['submit']=="Submit"){
		
				$dbconn=pg_connect("host=mcsdb.utm.utoronto.ca dbname=zehrasha_309 user=zehrasha password=89870");

                        	if(!$dbconn){
        //                      	echo("Can't connect to the database");  
                                	exit;
                        	}

                        	
				$query="insert into appuser(username, password, firstname, lastname, email, type) values($1,$2,$3,$4,$5,$6);";
                        	$result=pg_prepare($dbconn, "create_user", $query);
				
				$queryhelp="select * from appuser where username= $1;";
				$result1=pg_prepare($dbconn, "uniq_user", $queryhelp);
				$result1=pg_execute($dbconn, "uniq_user",
                                                array($_REQUEST['user']));
			
				if ($row = pg_fetch_array($result1)){
					echo "$row[username] already exists. Please choose another username";	
					$errors[]='Please choose another username';
					break;
				} else {
					$result=pg_execute($dbconn, "create_user", 
						array($_REQUEST['user'], $_REQUEST['password'], 
						$_REQUEST['firstName'], $_REQUEST['lastName'],
						$_REQUEST['email'], $_REQUEST['type']));
				}
				if($result){
					echo "Please login with your new username!";
					$_SESSION['state']='login';
                                	$view = "login.php";
				} else {
					$errors[]='Your profile could not be created or modified';
				}				
			}		
			break;
		

		case "eprofile":
			$view="profile.php"; 
			
			break;
			
		case "instructor":
			// the view we display by for instructors
			$view="instructor_createclass.php";		
			if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="login"){
                                $_SESSION['state']='login';
                                $view = "login.php";
                                break;
                        }
			break;
		
		case "instructorclass":
		
			//view for instructor in an active class
			$view="instructor_currentclass.php";
			if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="login"){
                                $_SESSION['state']='login';
                                $view = "login.php";
                                break;
                        }			
			break;
			
			
		case "studentclass":
			
			//view for student in an active class
			$view="student_currentclass.php";
			if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="login"){
                                $_SESSION['state']='login';
                                $view = "login.php";
                                break;
                        }	
			break;		
			
		case "student":
			//view for student in joining potential class
			$view="student.php";
			if(empty($_REQUEST['submit']) || $_REQUEST['submit']=="Back"){
                                echo $_REQUEST['submit'];
				$_SESSION['state']='login';
                                $view = "login.php";
                                break;
                        } else {	
				$_SESSION['state']='studentclass';
				$view = "student_currentclass.php";
				break;
			}
			
			break;	
		
	}
	require_once "view/view_lib.php";
	require_once "view/$view";
?>

<link rel="stylesheet" href="view/style.css" type="text/css">
