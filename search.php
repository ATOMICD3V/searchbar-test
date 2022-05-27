<?php
 
$button = $_GET ['submit'];
$search = $_GET ['search']; 
 
if(!$button)
echo "you didn't submit a keyword";
else
{
	if(strlen($search)<=1)
	echo "Search term too short";
	else{
		echo "You searched for <b>$search</b> <hr size='1'></br>";
		mysql_connect("localhost","root","Jaydeep@344874");
		mysql_select_db("live_search_engine");
		 
		$all_data = explode (" ", $search);
		 
		foreach($all_data as $find_data)
		{
			$x++;
			if($x==1)
			$query_str .="keywords LIKE '%$find_data%'";
			else
			$query_str .="AND keywords LIKE '%$find_data%'";
		 
		}
		 
		$query_str ="SELECT * FROM searchengine WHERE $query_str";
		$run = mysql_query($query_str);
		 
		$search_total_records = mysql_num_rows($run);
		 
		if ($search_total_records==0)
		echo "dear very Sorry, there are no matching result for <b>$search</b>.</br></br>1. 
		Try more any useful general words. for example: If you want to search 'how to create a blogspot'
		then use general keyword like 'create' 'blogspot'</br>2. Try different words with similar
		 meaning</br>3. Please check your right spelling";
		else
		{
			echo "$search_total_records results found !<p>";
		 
			while($dataRow = mysql_fetch_assoc($run))
			{
				$title = $dataRow ['title'];
				$desc = $dataRow ['description'];
				$url = $dataRow ['url'];
				 
				echo "
				<a href='$url'><b>$title</b></a><br>
				$desc<br>
				<a href='$url'>$url</a><p>
				";
			}
		}
	 
	}
}
 
?>
