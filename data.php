<?php

echo '<body style="background-color:#DDDDDD">';
$con = mysqli_connect("localhost","root","","Project") or die ("Failed to connect to MySQL: " . mysqli_connect_error());
$id = $_GET['link'];

$q1 = "select * from bacteria
left join id_relation on bacteria.ID = id_relation.ID
left join categories on bacteria.C_ID = categories.C_ID

WHERE bacteria.Bacteria LIKE '%$id%' OR categories.Name LIKE '%$id%'";

$q2 = "select * from id_relation
left join bacteria on id_relation.ID = bacteria.ID
left join links on id_relation.R_ID = links.R_ID

WHERE bacteria.Bacteria LIKE '%$id%' OR links.PUBMED_ID LIKE '%$id%'";

$results = $con->query($q1);
echo "<table border='1'>
<tr>

<th>Name</th>

<th>Type</th>

<th>Category</th>
<th>Category Description</th>

</tr>";


if($row = $results->fetch_array()){

  echo "<tr>";

  echo "<td>"."<b>" . $row['Bacteria'] ."</b>". "</td>";
  echo "<td>" . $row['Type'] . "</td>";

  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Description'] . "</td>";

  echo "</tr>";

}


$refresults = $con->query($q2);
echo "<br>";
echo "<br>";
echo "<table border='1'>

<tr>

<th>PUBMED_ID</th>

<th>Research Article (Title)</th>
<th>Research Article (links)</th>
<th>Research Article (Abstract)</th>

</tr>";
while($row1 = $refresults->fetch_array()){
  echo "<tr>";
echo "<br>";
  echo "<td>" . $row1['PUBMED_ID'] . "</td>";

  echo "<td>" . $row1['Title'] . "</td>";

  echo "<td>" . $row1['Link'] . "</td>";
  echo "<td>" . $row1['Abstract'] . "</td>";

  echo "</tr>";
}


?>