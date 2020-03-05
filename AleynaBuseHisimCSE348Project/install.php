<?php


	$servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "aleyna_buse_hisim";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	} 

	//Create database

	$sql = "CREATE DATABASE aleyna_buse_hisim";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);
	
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

mysqli_set_charset( $conn, 'utf8' );


$sql = "CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT,
    productname VARCHAR(255) NOT NULL,
    product_cost VARCHAR(255) NOT NULL,
    PRIMARY KEY (product_id)
) CHARACTER SET latin5 COLLATE latin5_turkish_ci   ENGINE=INNODB;";
$result = mysqli_query($conn,$sql) or die("11");


	$row = 2;	///DENESENE BUNU SONRA BI NEDEN 2
	$filename = "csv/products.csv";


	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		//echo '<table border=1>';
		//echo '<tr><td>Name</td><td>Val</td><tr/>';
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			if(!$header)
				$header = $row;
			else{
				$sql = "INSERT INTO products (productname,product_cost) VALUES ('$row[0]','$row[1]') ;";
				$result = mysqli_query($conn,$sql) or die("11*");
			}
		}
		
		//echo '</table>';
		fclose($handle);
	}

//-------------------------------------------------------------------------------------------------------


$sql2 = "CREATE TABLE IF NOT EXISTS citys (
    city_id INT AUTO_INCREMENT,
    cityname VARCHAR(255) NOT NULL,
    district_id INT NOT NULL,
    PRIMARY KEY (city_id)
) CHARACTER SET latin5 COLLATE latin5_turkish_ci   ENGINE=INNODB;";
$result2 = mysqli_query($conn,$sql2) or die("12");


	$row = 0;
	$filename = "csv/cities.csv";


	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		//echo '<table border=1>';
		//echo '<tr><td>Name</td><td>Val</td><tr/>';
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{
			if(!$header)
				$header = $row;
			else{
				$sql2 = "INSERT INTO citys (cityname,district_id) VALUES ('$row[1]', '$row[2]') ;";
				$result2 = mysqli_query($conn,$sql2) or die("12");
			}
		}
		
		//echo '</table>';
		fclose($handle);
	}

//-----------------------------------------------------------------------------------------------------
	$sql3 = "CREATE TABLE IF NOT EXISTS districts (
	district_id INT AUTO_INCREMENT,
    district_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (district_id)
) CHARACTER SET latin5 COLLATE latin5_turkish_ci   ENGINE=INNODB;";
$result3 = mysqli_query($conn,$sql3) or die("13");


	$row = 0;
	$filename = "csv/district.csv";


	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		//echo '<table border=1>';
		//echo '<tr><td>Name</td><td>Val</td><tr/>';
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{

			if(!$header)
				$header = $row;
			else{

				$sql3 = "INSERT INTO districts (district_name) VALUES ('$row[1]')";
				mysqli_query($conn,$sql3) or die("13");
			}
		}
		
		//echo '</table>';
		fclose($handle);
	}

//------------------------------------------------------------------------------------------------------
	
	$sql4 = "CREATE TABLE IF NOT EXISTS markets (
	market_id INT AUTO_INCREMENT,
    market_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (market_id)
) CHARACTER SET latin5 COLLATE latin5_turkish_ci   ENGINE=INNODB;";
$result4 = mysqli_query($conn,$sql4) or die("14");


	$row = 0;
	$filename = "csv/Market.csv";


	if(!file_exists($filename) || !is_readable($filename))
		return FALSE;
	
	$header = NULL;
	if (($handle = fopen($filename, 'r')) !== FALSE)
	{
		//echo '<table border=1>';
		//echo '<tr><td>Name</td><td>Val</td><tr/>';
		while (($row = fgetcsv($handle, 1000, ';')) !== FALSE)
		{

			if(!$header)
				$header = $row;
			else{

				$sql4 = "INSERT INTO markets (market_name) VALUES ('$row[1]') ;";
				$result4 = mysqli_query($conn,$sql4) or die("14");
			}
		}
		
		//echo '</table>';
		fclose($handle);
	}



//--------------------------------------------------------------------------------------------------

	$namearray=array();
	if (($handle = fopen("csv/name.csv", 'r')) !== FALSE) { // Check the resource is valid
    while (($row = fgetcsv($handle, 1000, ";")) !== FALSE)  // Check opening the file is OK!
    {
			if(!$header)
				$header = $row;
			else{
				 	$namearray[]=$row[0];

			}
	}
		
		//echo '</table>';
		fclose($handle);
	}

	$surnamearray=array();
	if (($handle = fopen("csv/surname.csv", 'r')) !== FALSE) { // Check the resource is valid
    while (($row = fgetcsv($handle, 1000, ";")) !== FALSE)  // Check opening the file is OK!
    {
			if(!$header)
				$header = $row;
			else{
				 	$surnamearray[]=$row[0];
			}
	}
		
		//echo '</table>';
		fclose($handle);
	}
//total name 2835
	$name_surname_array=array();
	$random_name_surname;
	$random_name;
	$random_surname;
	$counter=0;
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
	while($counter<2835)
	{
		$random_name=$namearray[array_rand($namearray)];
		$random_surname=$surnamearray[array_rand($surnamearray)];
		$random_name_surname= $random_name." ".$random_surname;
		

 		if( $random_name === $random_surname)
 		{
 			while( $random_name === $random_surname)
 			{
 				$random_name=array_rand($namearray);
				$random_surname=array_rand($surnamearray);
				$random_name_surname= $random_name." ".$random_surname;
 			}
 		}
 		else
 		{
 			$name_surname_array[]=$random_name_surname;
 			//echo $name_surname_array[$counter];
 			//echo "</br></br>";
 			$counter++;
 		}
		  

	}

	$sql5 = "CREATE TABLE IF NOT EXISTS customers (
	customer_id INT AUTO_INCREMENT,
    customer_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (customer_id)
) CHARACTER SET latin5 COLLATE latin5_turkish_ci   ENGINE=INNODB;";
$result5 = mysqli_query($conn,$sql5) or die("15");


	$countercustomer=0;
	while($countercustomer<1620)
	{

		$sql5 = "INSERT INTO customers (customer_name) VALUES ('$name_surname_array[$countercustomer]') ;";
		$result5 = mysqli_query($conn,$sql5) or die("15*");
		$countercustomer++;

	}

//-----------------------------------------------------------------------------------------------------	

		$sql7 = "CREATE TABLE IF NOT EXISTS mid_table (
		
		mid_id INT AUTO_INCREMENT,
		city_id INT NOT NULL,
		market_id INT NOT NULL, 	
   		PRIMARY KEY (mid_id)
		) CHARACTER SET latin5 COLLATE latin5_turkish_ci   ENGINE=INNODB;";
		

		$result7 = mysqli_query($conn,$sql7) or die("17");
		//$random_market_id_array=array();
		$number_ofcity=1;
	

//ini_set('max_execution_time', 180); //300 seconds = 5 minutes
	while($number_ofcity<82)
	{
		$random_market_id_array=array();
		for($i = 0; $i <5; $i++)
		{
			$random_market=mt_rand(1,10);
			
				
			while(in_array($random_market, $random_market_id_array)) 
			{
				
					$random_market=mt_rand(1,10);
				
			}
			
			
			
			$random_market_id_array[]=$random_market;
			//print_r($random_market_id_array);
			//echo $number_ofcity;
			//echo "</br></br>";
			$sql7 = "INSERT INTO mid_table (city_id,market_id) VALUES ('$number_ofcity','$random_market_id_array[$i]') ;";
			$result7 = mysqli_query($conn,$sql7) or die("17*");
		}


		
		
		
		$number_ofcity++;
	
	
	}
//---------------------------------------------------------------------------------------------------------------------------------

$sql6 = "CREATE TABLE IF NOT EXISTS salesmans (
	saleman_id INT AUTO_INCREMENT,
	saleman_market_id INT NOT NULL,
    saleman_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (saleman_id)
) CHARACTER SET latin5 COLLATE latin5_turkish_ci   ENGINE=INNODB;";
$result6 = mysqli_query($conn,$sql6) or die("16");


	$countersaleman=1620;
	$marketcounter=1;
	
	while($countersaleman<2835)
	{	
		$countermarketid=1;
		while ( $countermarketid< 4) {

		$sql6 = "INSERT INTO salesmans (saleman_name,saleman_market_id) VALUES ('$name_surname_array[$countersaleman]',$marketcounter) ;";
		$result6 = mysqli_query($conn,$sql6) or die("16*");
		$countersaleman++;
		$countermarketid++;
		

		}
		$marketcounter++;

	}

//-----------------------------------------------------------------------------------------------------------------------------------------

	$sql8 = "CREATE TABLE IF NOT EXISTS sales (
	sale_id INT AUTO_INCREMENT,
	saleman_id INT NOT NULL,
	customer_id INT NOT NULL,
	sale_date VARCHAR(255) NOT NULL,
	product_id INT NOT NULL,
    
    PRIMARY KEY (sale_id)
) CHARACTER SET latin5 COLLATE latin5_turkish_ci   ENGINE=INNODB;";
$result8 = mysqli_query($conn,$sql8) or die("18");


	$countercustomer=1;
	$productscounter=0;
	
	
	while($countercustomer<=1620)
	{	
		$productscounter=0;
		$randoms_salesman_id = rand(1,1215);
			
		$randomDay = rand(1,30);//her ay 
		$randomMonth = rand(1,12);
		$Year = 2018;
		$randomDate = $randomDay. "/".$randomMonth. "/".$Year;

		while ( $productscounter< 5) {

		$random_product_id=mt_rand(1,200);

		$sql8 = "INSERT INTO sales (saleman_id,customer_id,sale_date,product_id) VALUES ('$randoms_salesman_id','$countercustomer','$randomDate','$random_product_id') ;";
		$result8 = mysqli_query($conn,$sql8) or die("18*");
		
		$productscounter++;
		

		}

		$countercustomer++;

	}


?>