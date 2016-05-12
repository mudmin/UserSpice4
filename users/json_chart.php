<?php
require_once("../core/init.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

if(!empty($_GET))
	{
	$json_data = array();
	if(isset($_GET['chartid']))
		{
		$chartid = $_GET['chartid'];
		// if is numeric
		switch($chartid)
			{
			case 0:
			$makeArray = fetchUserjsonLG();
			$i = 0;
			foreach ($makeArray as $v1)
				{
				$name = $v1->sign_up_stamp;
				$value = $v1->sum1;
				$json_data[$i]["data"][] = array($name * 1000,$value);
				$i++;
				}
			break;


			case 1:
			$makeArray = fetchUserjsonPIE();
			$i = 0;
			foreach ($makeArray as $v1)
				{
				$name = $v1->name;
				$value = $v1->sum1;
				$json_data[$i]["label"][] = $name;
				$json_data[$i]["data"][] = array($name,$value);
				$i++;
				}
			break;

			case 2:
			$makeArray = fetchUserjsonLG2();
			$i = 0;
			foreach ($makeArray as $v1)
				{
				$name = $v1->audit_timestamp;
				$value = $v1->sum1;
				$json_data[$i]["data"][] = array($name * 1000,$value);
				$i++;
				}
			break;
			default:
			break;
			}
		}

	}
	else // no incoming so send default data
		{
		$makeArray = fetchUserjson();
		$i = 0;
		foreach ($makeArray as $v1)
			{
			$label = $v1->permission_id;
			$value = $v1->sum1;
			$name = $v1->name;
			$json_data[$i] = array("label" => $name,"data" => $value);
			$i++;
			}
		}

echo json_encode($json_data);
?>
