CREATE TABLE users(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 email VARCHAR(150) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 phone VARCHAR(20),
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE properties(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(150) NOT NULL,
 city VARCHAR(100) NOT NULL,
 area VARCHAR(100) NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 gender ENUM('Boys','Girls','Co-living') NOT NULL,
 rating DECIMAL(2,1) DEFAULT 0,
 description TEXT,
 image_url VARCHAR(500),
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_property_name_city(name,city)
);

CREATE TABLE amenities(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE property_amenities(
 property_id INT NOT NULL,
 amenity_id INT NOT NULL,
 PRIMARY KEY(property_id,amenity_id),
 FOREIGN KEY(property_id) REFERENCES properties(id) ON DELETE CASCADE,
 FOREIGN KEY(amenity_id) REFERENCES amenities(id) ON DELETE CASCADE
);

CREATE TABLE interested_users(
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 property_id INT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_interest(user_id,property_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(property_id) REFERENCES properties(id) ON DELETE CASCADE
);

CREATE TABLE property_images(
 id INT AUTO_INCREMENT PRIMARY KEY,
 property_id INT NOT NULL,
 image_url VARCHAR(500) NOT NULL,
 FOREIGN KEY(property_id) REFERENCES properties(id) ON DELETE CASCADE
);

INSERT INTO amenities(name) VALUES
('Wi-Fi'),('AC'),('Food'),('Laundry'),('Power Backup'),('Parking'),('CCTV'),('Housekeeping');

INSERT INTO properties(name,city,area,price,gender,rating,description,image_url) VALUES
('MVP Comfort Stay','Visakhapatnam','MVP Colony',7500,'Boys',4.4,'Clean furnished PG near colleges and daily-use stores.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'),
('Siripuram Student Homes','Visakhapatnam','Siripuram',9000,'Co-living',4.6,'Modern rooms with Wi-Fi, food and housekeeping options.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'),
('Gajuwaka Nest','Visakhapatnam','Gajuwaka',6500,'Girls',4.2,'Budget-friendly accommodation with security and power backup.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'),
('Rushikonda Living','Visakhapatnam','Rushikonda',12000,'Co-living',4.7,'Comfortable furnished rooms suited to students and working professionals.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'),
('Dwaraka Nagar PG','Visakhapatnam','Dwaraka Nagar',8500,'Boys',4.3,'Central-location PG with convenient access to transport and shops.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'),
('NAD Junction Stay','Visakhapatnam','NAD Junction',7000,'Girls',4.1,'Affordable furnished rooms with essential amenities.','https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80');


INSERT IGNORE INTO properties(name,city,area,price,gender,rating,description,image_url) VALUES
('Green Park Student Stay','Delhi','Dwarka Sector 21',9500,'Co-living',4.4,'Furnished student accommodation close to metro connectivity, markets and everyday essentials.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'),
('Capital Comfort PG','Delhi','Saket',11500,'Girls',4.5,'Comfortable furnished rooms with housekeeping, Wi-Fi and easy access to colleges and offices.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'),
('Mumbai Central Living','Mumbai','Andheri East',14000,'Boys',4.3,'Well-connected furnished PG with practical amenities for students and young professionals.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'),
('Harbour View PG','Mumbai','Powai',15500,'Co-living',4.6,'Modern rooms near offices, public transport and daily-use stores.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'),
('Bengaluru Tech Stay','Bengaluru','Koramangala',11000,'Co-living',4.7,'Student-friendly stay near cafes, colleges and technology offices with furnished rooms.','https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1000&q=80'),
('Whitefield Comfort PG','Bengaluru','Whitefield',9000,'Boys',4.2,'Affordable furnished accommodation with Wi-Fi, food and housekeeping options.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'),
('Hitech City Homes','Hyderabad','Madhapur',10500,'Co-living',4.5,'Comfortable rooms with easy access to metro, offices, restaurants and shopping.','https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1000&q=80'),
('Charminar Girls Residence','Hyderabad','Mehdipatnam',8000,'Girls',4.3,'Clean furnished rooms with security, power backup and everyday amenities.','https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80');

INSERT INTO property_amenities VALUES
(1,1),(1,2),(1,5),(1,7),(2,1),(2,3),(2,4),(2,8),(3,1),(3,5),(3,7),(4,1),(4,2),(4,3),(4,6),(4,8),(5,1),(5,5),(5,7),(6,1),(6,4),(6,7);



INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','Food','Housekeeping')
WHERE p.city='Delhi' AND p.name='Green Park Student Stay';
INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','Laundry','CCTV')
WHERE p.city='Delhi' AND p.name='Capital Comfort PG';
INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','AC','CCTV')
WHERE p.city='Mumbai' AND p.name='Mumbai Central Living';
INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','AC','Housekeeping')
WHERE p.city='Mumbai' AND p.name='Harbour View PG';
INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','Food','Laundry','Housekeeping')
WHERE p.city='Bengaluru' AND p.name='Bengaluru Tech Stay';
INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','Food','Power Backup')
WHERE p.city='Bengaluru' AND p.name='Whitefield Comfort PG';
INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','AC','Food','Housekeeping')
WHERE p.city='Hyderabad' AND p.name='Hitech City Homes';
INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','Power Backup','CCTV')
WHERE p.city='Hyderabad' AND p.name='Charminar Girls Residence';

INSERT INTO property_images(property_id,image_url) VALUES
(1,'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'),(1,'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'),
(2,'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'),(2,'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'),
(3,'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'),(3,'https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80'),
(4,'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'),(4,'https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'),
(5,'https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'),(5,'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'),
(6,'https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80'),(6,'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80');


INSERT INTO property_images(property_id,image_url)
SELECT id, image_url FROM properties WHERE city IN ('Delhi','Mumbai','Bengaluru','Hyderabad')
AND name IN ('Green Park Student Stay','Capital Comfort PG','Mumbai Central Living','Harbour View PG','Bengaluru Tech Stay','Whitefield Comfort PG','Hitech City Homes','Charminar Girls Residence')
AND NOT EXISTS (SELECT 1 FROM property_images pi WHERE pi.property_id=properties.id);


-- Additional city inventory: 4 more properties per city (6 total in each city)
INSERT IGNORE INTO properties(name,city,area,price,gender,rating,description,image_url) VALUES
('Metro View Student PG','Delhi','Laxmi Nagar',8500,'Boys',4.2,'Furnished student PG close to metro stations, coaching centres and daily essentials.','https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=1000&q=80'),
('South Delhi Comfort Homes','Delhi','Greater Kailash',12500,'Co-living',4.6,'Bright furnished rooms with Wi-Fi, housekeeping and convenient access to colleges and offices.','https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1000&q=80'),
('North Campus Girls PG','Delhi','Kamla Nagar',10000,'Girls',4.5,'Student-friendly girls accommodation near North Campus with food and laundry options.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'),
('Noida Link Residency','Delhi','Mayur Vihar',9000,'Co-living',4.3,'Comfortable shared rooms with security, power backup and quick transport links.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80'),
('Andheri Student Nest','Mumbai','Andheri West',13500,'Girls',4.4,'Furnished rooms near metro connectivity, colleges, cafes and shopping areas.','https://images.unsplash.com/photo-1560185008-b033106af5c3?auto=format&fit=crop&w=1000&q=80'),
('Powai Lake PG','Mumbai','Powai',16000,'Boys',4.5,'Modern PG with Wi-Fi, housekeeping and convenient access to technology offices.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'),
('Bandra Co Living','Mumbai','Bandra East',17500,'Co-living',4.7,'Premium shared accommodation with furnished rooms and easy public transport access.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'),
('Thane Budget Stay','Mumbai','Thane West',11000,'Boys',4.1,'Value-focused furnished PG with food, laundry and power backup.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'),
('Electronic City Living','Bengaluru','Electronic City',8500,'Boys',4.3,'Affordable furnished rooms close to technology campuses and public transport.','https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=1000&q=80'),
('Indiranagar Student Homes','Bengaluru','Indiranagar',13500,'Co-living',4.6,'Well-connected co-living rooms near cafes, metro and offices.','https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=1000&q=80'),
('HSR Girls Residence','Bengaluru','HSR Layout',10000,'Girls',4.4,'Safe furnished accommodation with housekeeping, Wi-Fi and power backup.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'),
('Marathahalli PG Homes','Bengaluru','Marathahalli',9500,'Co-living',4.2,'Practical rooms for students and professionals near major tech corridors.','https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=1000&q=80'),
('Banjara Hills Living','Hyderabad','Banjara Hills',12500,'Co-living',4.6,'Furnished co-living rooms close to restaurants, offices and city transport.','https://images.unsplash.com/photo-1493809842364-78817add7ffb?auto=format&fit=crop&w=1000&q=80'),
('Gachibowli Student Stay','Hyderabad','Gachibowli',11000,'Boys',4.4,'Comfortable PG near universities, technology offices and everyday services.','https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&w=1000&q=80'),
('Kondapur Girls Home','Hyderabad','Kondapur',9500,'Girls',4.5,'Clean furnished rooms with Wi-Fi, security and housekeeping support.','https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1000&q=80'),
('Secunderabad Comfort PG','Hyderabad','Secunderabad',8500,'Co-living',4.2,'Budget-friendly accommodation with transport links, food and power backup.','https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1000&q=80');

-- Add useful amenities to the additional properties without relying on fixed IDs.
INSERT INTO property_amenities(property_id,amenity_id)
SELECT p.id,a.id FROM properties p JOIN amenities a ON a.name IN ('Wi-Fi','Power Backup','CCTV','Housekeeping')
WHERE p.city IN ('Delhi','Mumbai','Bengaluru','Hyderabad')
AND p.name IN ('Metro View Student PG','South Delhi Comfort Homes','North Campus Girls PG','Noida Link Residency','Andheri Student Nest','Powai Lake PG','Bandra Co Living','Thane Budget Stay','Electronic City Living','Indiranagar Student Homes','HSR Girls Residence','Marathahalli PG Homes','Banjara Hills Living','Gachibowli Student Stay','Kondapur Girls Home','Secunderabad Comfort PG')
ON DUPLICATE KEY UPDATE property_id=VALUES(property_id);

-- Give every property at least two gallery images.
INSERT INTO property_images(property_id,image_url)
SELECT p.id,p.image_url FROM properties p
WHERE p.city IN ('Delhi','Mumbai','Bengaluru','Hyderabad')
AND NOT EXISTS (SELECT 1 FROM property_images pi WHERE pi.property_id=p.id);
