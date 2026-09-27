<?php
require_once 'config.php';
header('Content-Type: text/html; charset=utf-8');

$rows = [
['Metro View Student PG','Delhi','Laxmi Nagar',8500,'Boys',4.2,'Furnished student PG close to metro stations, coaching centres and daily essentials.','https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=1000&q=80'],
['South Delhi Comfort Homes','Delhi','Greater Kailash',12500,'Co-living',4.6,'Bright furnished rooms with Wi-Fi, housekeeping and convenient access to colleges and offices.','https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1000&q=80'],
['North Campus Girls PG','Delhi','Kamla Nagar',10000,'Girls',4.5,'Student-friendly girls accommodation near North Campus with food and laundry options.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'],
['Noida Link Residency','Delhi','Mayur Vihar',9000,'Co-living',4.3,'Comfortable shared rooms with security, power backup and quick transport links.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'],
['Andheri Student Nest','Mumbai','Andheri West',13500,'Girls',4.4,'Furnished rooms near metro connectivity, colleges, cafes and shopping areas.','https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80'],
['Powai Lake PG','Mumbai','Powai',16000,'Boys',4.5,'Modern PG with Wi-Fi, housekeeping and convenient access to technology offices.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'],
['Bandra Co Living','Mumbai','Bandra East',17500,'Co-living',4.7,'Premium shared accommodation with furnished rooms and easy public transport access.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'],
['Thane Budget Stay','Mumbai','Thane West',11000,'Boys',4.1,'Value-focused furnished PG with food, laundry and power backup.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'],
['Electronic City Living','Bengaluru','Electronic City',8500,'Boys',4.3,'Affordable furnished rooms close to technology campuses and public transport.','https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1000&q=80'],
['Indiranagar Student Homes','Bengaluru','Indiranagar',13500,'Co-living',4.6,'Well-connected co-living rooms near cafes, metro and offices.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'],
['HSR Girls Residence','Bengaluru','HSR Layout',10000,'Girls',4.4,'Safe furnished accommodation with housekeeping, Wi-Fi and power backup.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'],
['Marathahalli PG Homes','Bengaluru','Marathahalli',9500,'Co-living',4.2,'Practical rooms for students and professionals near major tech corridors.','https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1000&q=80'],
['Banjara Hills Living','Hyderabad','Banjara Hills',12500,'Co-living',4.6,'Furnished co-living rooms close to restaurants, offices and city transport.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'],
['Gachibowli Student Stay','Hyderabad','Gachibowli',11000,'Boys',4.4,'Comfortable PG near universities, technology offices and everyday services.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'],
['Kondapur Girls Home','Hyderabad','Kondapur',9500,'Girls',4.5,'Clean furnished rooms with Wi-Fi, security and housekeeping support.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'],
['Secunderabad Comfort PG','Hyderabad','Secunderabad',8500,'Co-living',4.2,'Budget-friendly accommodation with transport links, food and power backup.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80']
];

$pdo->exec("INSERT IGNORE INTO amenities(name) VALUES ('Wi-Fi'),('AC'),('Food'),('Laundry'),('Power Backup'),('Parking'),('CCTV'),('Housekeeping')");
$stmt=$pdo->prepare("INSERT IGNORE INTO properties(name,city,area,price,gender,rating,description,image_url) VALUES (?,?,?,?,?,?,?,?)");
foreach($rows as $r){$stmt->execute($r);}
$pdo->exec("INSERT INTO property_amenities(property_id,amenity_id) SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','Power Backup','CCTV','Housekeeping') WHERE p.city IN ('Delhi','Mumbai','Bengaluru','Hyderabad') ON DUPLICATE KEY UPDATE property_id=VALUES(property_id)");
$pdo->exec("INSERT INTO property_images(property_id,image_url) SELECT p.id,p.image_url FROM properties p WHERE p.city IN ('Delhi','Mumbai','Bengaluru','Hyderabad') AND NOT EXISTS (SELECT 1 FROM property_images pi WHERE pi.property_id=p.id)");

$counts=$pdo->query("SELECT city,COUNT(*) c FROM properties GROUP BY city ORDER BY city")->fetchAll();
echo '<!doctype html><html><head><meta charset="utf-8"><title>VizagPG Finder Setup</title><style>body{font-family:Arial;padding:40px;background:#f5f7fb}main{max-width:700px;margin:auto;background:#fff;padding:30px;border-radius:16px;box-shadow:0 8px 30px #0001}li{margin:8px 0}.ok{color:#087f23}</style></head><body><main><h1>Database updated ✓</h1><p class="ok">Properties for all major cities have been added/updated.</p><ul>';
foreach($counts as $c){echo '<li><strong>'.htmlspecialchars($c['city']).'</strong>: '.(int)$c['c'].' properties</li>'; }
echo '</ul><p><a href="index.php">Go to home page</a></p></main></body></html>';
?>