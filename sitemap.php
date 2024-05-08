<?php
header('Content-type: application/xml');

$hostname = "prod-rds.c1fv9w4nvgoi.us-east-2.rds.amazonaws.com";
$username = "admin";
$password = "BBDsf4#(SSfafW2%2";
$database = "afrebay";
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

$protocol = "https://" . $_SERVER['HTTP_HOST'];
$get_result = mysqli_query($conn, "select * from sitemap");
echo "<?xml version='1.0' encoding='UTF-8'?>"."\n";
echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>"."\n";

while($row = mysqli_fetch_array($get_result)) {
    echo "<url>";
    echo "<loc>".$protocol."".$row['link']."</loc>";
    echo "<lastmod>".$row['lastmod']."</lastmod>";
    echo "<changefreq>".$row['changefreq']."</changefreq>";
    echo "<priority>".$row['priority']."</priority>";
    echo "</url>";
}
echo "</urlset>";
?>