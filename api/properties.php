<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../config.php';

// Automatically seed demo properties for every major city. This makes the site work
// even if the user did not manually import the latest SQL/setup file.
$seedRows = [
['Delhi','Metro View Student PG','Laxmi Nagar',8500,'Boys',4.2,'Furnished student PG close to metro stations, coaching centres and daily essentials.','https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=1000&q=80'],
['Delhi','South Delhi Comfort Homes','Greater Kailash',12500,'Co-living',4.6,'Bright furnished rooms with Wi-Fi, housekeeping and convenient access to colleges and offices.','https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1000&q=80'],
['Delhi','North Campus Girls PG','Kamla Nagar',10000,'Girls',4.5,'Student-friendly girls accommodation near North Campus with food and laundry options.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'],
['Delhi','Noida Link Residency','Mayur Vihar',9000,'Co-living',4.3,'Comfortable shared rooms with security, power backup and quick transport links.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'],
['Delhi','Dwarka Student Nest','Dwarka Sector 21',9500,'Boys',4.4,'Convenient furnished rooms close to metro, markets and student facilities.','https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80'],
['Delhi','Saket Comfort Living','Saket',12000,'Girls',4.5,'Clean furnished accommodation with Wi-Fi, housekeeping and security.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'],
['Mumbai','Andheri Student Nest','Andheri West',13500,'Girls',4.4,'Furnished rooms near metro connectivity, colleges, cafes and shopping areas.','https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80'],
['Mumbai','Powai Lake PG','Powai',16000,'Boys',4.5,'Modern PG with Wi-Fi, housekeeping and convenient access to technology offices.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'],
['Mumbai','Bandra Co Living','Bandra East',17500,'Co-living',4.7,'Premium shared accommodation with furnished rooms and easy public transport access.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'],
['Mumbai','Thane Budget Stay','Thane West',11000,'Boys',4.1,'Value-focused furnished PG with food, laundry and power backup.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'],
['Mumbai','Mumbai Central Living','Andheri East',14000,'Co-living',4.3,'Well-connected furnished PG with practical amenities for students and young professionals.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'],
['Mumbai','Harbour View PG','Vikhroli',15000,'Boys',4.5,'Modern rooms with transport access, Wi-Fi and housekeeping.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'],
['Bengaluru','Electronic City Living','Electronic City',8500,'Boys',4.3,'Affordable furnished rooms close to technology campuses and public transport.','https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1000&q=80'],
['Bengaluru','Indiranagar Student Homes','Indiranagar',13500,'Co-living',4.6,'Well-connected co-living rooms near cafes, metro and offices.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'],
['Bengaluru','HSR Girls Residence','HSR Layout',10000,'Girls',4.4,'Safe furnished accommodation with housekeeping, Wi-Fi and power backup.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'],
['Bengaluru','Marathahalli PG Homes','Marathahalli',9500,'Co-living',4.2,'Practical rooms for students and professionals near major tech corridors.','https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1000&q=80'],
['Bengaluru','Koramangala Tech Stay','Koramangala',11000,'Co-living',4.7,'Student-friendly stay near cafes, colleges and technology offices.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'],
['Bengaluru','Whitefield Comfort PG','Whitefield',9000,'Boys',4.2,'Affordable furnished accommodation with Wi-Fi, food and housekeeping options.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'],
['Hyderabad','Banjara Hills Living','Banjara Hills',12500,'Co-living',4.6,'Furnished co-living rooms close to restaurants, offices and city transport.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'],
['Hyderabad','Gachibowli Student Stay','Gachibowli',11000,'Boys',4.4,'Comfortable PG near universities, technology offices and everyday services.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'],
['Hyderabad','Kondapur Girls Home','Kondapur',9500,'Girls',4.5,'Clean furnished rooms with Wi-Fi, security and housekeeping support.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'],
['Hyderabad','Secunderabad Comfort PG','Secunderabad',8500,'Co-living',4.2,'Budget-friendly accommodation with transport links, food and power backup.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'],
['Hyderabad','Hitech City Homes','Madhapur',10500,'Co-living',4.5,'Comfortable rooms with easy access to metro, offices, restaurants and shopping.','https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1000&q=80'],
['Hyderabad','Charminar Girls Residence','Mehdipatnam',8000,'Girls',4.3,'Clean furnished rooms with security, power backup and everyday amenities.','https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80'],
['Visakhapatnam','MVP Comfort Stay','MVP Colony',7500,'Boys',4.4,'Clean furnished PG near colleges and daily-use stores.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'],
['Visakhapatnam','Siripuram Student Homes','Siripuram',9000,'Co-living',4.6,'Modern rooms with Wi-Fi, food and housekeeping options.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'],
['Visakhapatnam','Gajuwaka Nest','Gajuwaka',6500,'Girls',4.2,'Budget-friendly accommodation with security and power backup.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'],
['Visakhapatnam','Rushikonda Living','Rushikonda',12000,'Co-living',4.7,'Comfortable furnished rooms suited to students and working professionals.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'],
['Visakhapatnam','Dwaraka Nagar PG','Dwaraka Nagar',8500,'Boys',4.3,'Central-location PG with convenient access to transport and shops.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'],
['Visakhapatnam','NAD Junction Stay','NAD Junction',7000,'Girls',4.1,'Affordable furnished rooms with essential amenities.','https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80']
];
$seedStmt=$pdo->prepare("INSERT INTO properties(name,city,area,price,gender,rating,description,image_url) SELECT ?,?,?,?,?,?,?,? WHERE NOT EXISTS (SELECT 1 FROM properties WHERE name=? AND city=? LIMIT 1)");
foreach($seedRows as $r){$seedStmt->execute([$r[1],$r[0],$r[2],$r[3],$r[4],$r[5],$r[6],$r[7],$r[1],$r[0]]);}

$city = trim($_GET['city'] ?? '');
$aliases=['Vizag'=>'Visakhapatnam','VIZAG'=>'Visakhapatnam','visakhapatnam'=>'Visakhapatnam'];
if(isset($aliases[$city])) $city=$aliases[$city];
$gender = trim($_GET['gender'] ?? '');
$min = is_numeric($_GET['min_price'] ?? '') ? (int)$_GET['min_price'] : 0;
$max = is_numeric($_GET['max_price'] ?? '') ? (int)$_GET['max_price'] : 999999;

$sql = "SELECT p.id,p.name,p.city,p.area,p.price,p.gender,p.rating,p.description,p.image_url
        FROM properties p WHERE p.price BETWEEN :min AND :max";
$params = [':min'=>$min, ':max'=>$max];

if ($city !== '') { $sql .= " AND p.city = :city"; $params[':city']=$city; }
if ($gender !== '') { $sql .= " AND p.gender = :gender"; $params[':gender']=$gender; }
$sql .= " ORDER BY p.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
echo json_encode($stmt->fetchAll());
?>