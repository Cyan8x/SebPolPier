-- activamos la bd
USE sebpolpier;

insert into usuarios (email, nombres, apellidos, contraseña, adminis) values 
('u19219126@utp.edu.pe','Leonardo', 'Salinas', '$2y$10$z353a9blUGwQ4ihQM05uJO5/MLsUG3PtxmBDYewX.zBwNXcjdc7Am', 1),
('leonardo-tuskater@hotmail.com','Nicolas', 'Salinas', '$2y$10$3Jgz3RtsiDmz6ZrWcN0.pOxOnJm0rOZvFISl.ju7OL4SamzjWVrYK', 0);

insert into marcas values ('M001AOR', 'AORUS'), ('M002ASR', 'ASROCK'), ('M003ASU', 'ASUS'), ('M004GIG', 'GIGABYTE'), ('M005MSI', 'MSI'), ('M006AMD', 'AMD'), ('M007INT', 'INTEL');

insert into categorias values ('C001TG', 'TARJETA GRAFICA'), ('C002PR', 'PROCESADOR'), ('C003PM', 'PLACA MADRE');

insert into proveedores values ('PROV001', 'COLAND', '975486153'), ('PROV002', 'TAMBS', '956153759'), ('PROV003', 'CHANLA', '948753159');

insert into productos VALUES
('PM2021AOR001', 'M001AOR', 'C003PM', 'PROV001', '22053GB5091', 'MB AORUS X570 ULTRA AMD RYZEN DDR4 AM4 PCIe 4.0 RGB 2.0.jpg', 'MB AORUS X570 ULTRA AMD RYZEN DDR4 AM4 PCIe 4.0 RGB 2.0', 10, 364),
('PM2021AOR002', 'M001AOR', 'C003PM', 'PROV003', '22054GB0590', 'MB AORUS Z490 PRO AX DDR4 LGA 1200 RGB 2.0.jpg', 'MB AORUS Z490 PRO AX DDR4 LGA 1200 RGB 2.0', 10, 383),
('PM2021ASR001', 'M002ASR', 'C003PM', 'PROV001', '90-MXB9Y0-A0UAYZ', 'MB ASROCK B450M STEEL LEGEND AMD RYZEN DDR4 AM4.jpg', 'MB ASROCK B450M STEEL LEGEND AMD RYZEN DDR4 AM4', 10, 112),
('PM2021ASR002', 'M002ASR', 'C003PM', 'PROV001', '90-MXBE60-A0UAYZ', 'MB ASROCK A520M-HVS AMD RYZEN DDR4 AM4.jpg', 'MB ASROCK A520M-HVS AMD RYZEN DDR4 AM4', 10, 76),
('PM2021ASU001', 'M003ASU', 'C003PM', 'PROV003', '90MB10T0-MVAAY0', 'ASUS-ROG-CROSSHAIR-VIII-HERO WIFI.jpg', 'ASUS-ROG-CROSSHAIR-VIII-HERO WIFI', 10, 485),
('PM2021ASU002', 'M003ASU', 'C003PM', 'PROV001', '90MB11Q0-M0AAY0', 'ASUS-ROG-CROSSHAIR-VIII-IMPACT.jpg', 'ASUS-ROG-CROSSHAIR-VIII-IMPACT', 10, 545),
('PM2021ASU003', 'M003ASU', 'C003PM', 'PROV002', '90MB11N0-M0AAY0', 'MB ASUS PRIME X570-P AMD RYZEN DDR4 AM4 PCIe 4.0 RGB.jpg', 'MB ASUS PRIME X570-P AMD RYZEN DDR4 AM4 PCIe 4.0 RGB', 10, 188),
('PM2021ASU004', 'M003ASU', 'C003PM', 'PROV003', '90MB15X0-M0AAY0', 'MB ASUS ROG MAXIMUS XIII HERO Z590 DDR4 LGA 1200.jpg', 'MB ASUS ROG MAXIMUS XIII HERO Z590 DDR4 LGA 1200', 10, 615),
('PM2021ASU005', 'M003ASU', 'C003PM', 'PROV001', '90MB0YS0-MVAAYO', 'MB ASUS ROG STRIX B450-F GAMING AMD RYZEN DDR4 AM4.jpg', 'MB ASUS ROG STRIX B450-F GAMING AMD RYZEN DDR4 AM4', 10, 144),
('PM2021ASU006', 'M003ASU', 'C003PM', 'PROV002', '90MB1660-M0AAYO', 'MB ASUS ROG STRIX Z590-A GAMING WIFI LGA 1200.jpg', 'MB ASUS ROG STRIX Z590-A GAMING WIFI LGA 1200', 10, 415),
('PM2021ASU007', 'M003ASU', 'C003PM', 'PROV003', '90MB16C0-M0AAY0', 'MB ASUS Z590-PLUS WIFI TUF GAMING DDR4 LGA 1200.jpg', 'MB ASUS Z590-PLUS WIFI TUF GAMING DDR4 LGA 1200', 10, 325),
('PM2021GIG001', 'M004GIG', 'C003PM', 'PROV001', '22053GB5164', 'MB GIGABYTE B550 GAMING X V2 AMD RYZEN DDR4 AM4.jpg', 'MB GIGABYTE B550 GAMING X V2 AMD RYZEN DDR4 AM4', 10, 172),
('PM2021GIG002', 'M004GIG', 'C003PM', 'PROV002', '22054GB8993', 'MB GIGABYTE B550M DS3H AMD RYZEN DDR4 AM4.jpg', 'MB GIGABYTE B550M DS3H AMD RYZEN DDR4 AM4', 10, 136),
('PM2021GIG003', 'M004GIG', 'C003PM', 'PROV002', '22053GB9009', 'MB GIGABYTE B450M H AMD RYZEN DDR4 AM4.jpg', 'MB GIGABYTE B450M H AMD RYZEN DDR4 AM4', 10, 78),
('PM2021MSI001', 'M005MSI', 'C003PM', 'PROV003', '22054MS0205', 'MB MSI B460M-A PRO DDR4 LGA 1200.jpg', 'MB MSI B460M-A PRO DDR4 LGA 1200', 10, 119),
('PM2021MSI002', 'M005MSI', 'C003PM', 'PROV001', '911-7C79-005', 'MB MSI MPG Z490 GAMING EDGE WIFI DDR4 LGA 1200 RGB.jpg', 'MB MSI MPG Z490 GAMING EDGE WIFI DDR4 LGA 1200 RGB', 10, 225),
('PR2021AMD001', 'M006AMD', 'C002PR', 'PROV001', '23097AM042', 'PROCESADOR AMD ATHLON II X4 631-2.6GHZ - FM1.jpg', 'PROCESADOR AMD ATHLON II X4 631-2.6GHZ - FM1', 10, 70),
('PR2021AMD002', 'M006AMD', 'C002PR', 'PROV002', '23097AM0741', 'PROCESADOR AMD RYZEN 3 2200G 3.50GHZ 4MB 4CORE AM4 RADEON VEGA 8.jpg', 'PROCESADOR AMD RYZEN 3 2200G 3.50GHZ 4MB 4CORE AM4 RADEON VEGA 8', 10, 120),
('PR2021AMD003', 'M006AMD', 'C002PR', 'PROV003', 'YD3400C5FHBOX', 'PROCESADOR AMD RYZEN 5 3400G 3.7GHZ 6MB 4CORE AM4 RADEON RX VEGA 11.jpg', 'PROCESADOR AMD RYZEN 5 3400G 3.7GHZ 6MB 4CORE AM4 RADEON RX VEGA 11', 10, 220),
('PR2021AMD004', 'M006AMD', 'C002PR', 'PROV001', '100-100000031BOX', 'PROCESADOR AMD RYZEN 5 3600 3.6GHZ 35MB 4CORE AM4.jpg', 'PROCESADOR AMD RYZEN 5 3600 3.6GHZ 35MB 4CORE AM4', 10, 278),
('PR2021AMD005', 'M006AMD', 'C002PR', 'PROV002', '100-100000065BOX', 'PROCESADOR AMD RYZEN 5 5600X 3.7GHZ 35MB 6CORE AM4.jpg', 'PROCESADOR AMD RYZEN 5 5600X 3.7GHZ 35MB 6CORE AM4', 10, 375),
('PR2021AMD006', 'M006AMD', 'C002PR', 'PROV003', '1100-100000063WOF', 'PROCESADOR AMD RYZEN 7 5800X 3.8GHZ 36MB 8CORE AM4.jpg', 'PROCESADOR AMD RYZEN 7 5800X 3.8GHZ 36MB 8CORE AM4', 10, 550),
('PR2021AMD007', 'M006AMD', 'C002PR', 'PROV001', '100-100000061WOF', 'PROCESADOR AMD RYZEN 9 5900X 3.7GHZ 70MB 12CORE AM4.jpg', 'PROCESADOR AMD RYZEN 9 5900X 3.7GHZ 70MB 12CORE AM4', 10, 690),
('PR2021AMD008', 'M006AMD', 'C002PR', 'PROV002', '100-100000059WOF', 'PROCESADOR AMD RYZEN 9 5950X 3.4GHZ 72MB 16CORE AM4.jpg', 'PROCESADOR AMD RYZEN 9 5950X 3.4GHZ 72MB 16CORE AM4', 10, 1030),
('PR2021INT001', 'M007INT', 'C002PR', 'PROV003', 'BX8070110100', 'PROCESADOR INTEL CORE I3 10100 3.6GHZ-6MB LGA1200.jpg', 'PROCESADOR INTEL CORE I3 10100 3.6GHZ-6MB LGA1200', 10, 160),
('PR2021INT002', 'M007INT', 'C002PR', 'PROV001', 'BX8070110400', 'PROCESADOR INTEL CORE I5 10400 2.9GHZ-12MB LGA1200.jpg', 'PROCESADOR INTEL CORE I5 10400 2.9GHZ-12MB LGA1200', 10, 280),
('PR2021INT003', 'M007INT', 'C002PR', 'PROV002', 'BX8070811700F', 'PROCESADOR INTEL CORE I7-11700F 2.50GHz-16MB LGA1200.jpg', 'PROCESADOR INTEL CORE I7-11700F 2.50GHz-16MB LGA1200', 10, 416),
('PR2021INT004', 'M007INT', 'C002PR', 'PROV003', 'BX8070110850K', 'PROCESADOR INTEL CORE I9 10850K 3.60GHZ-20MB LGA 1200 BOX.jpg', 'PROCESADOR INTEL CORE I9 10850K 3.60GHZ-20MB LGA 1200 BOX', 10, 583),
('TG2021AOR001', 'M001AOR', 'C001TG', 'PROV001', 'GV-R68XTAORUS M-16GD', 'AORUS RADEON RX 6800 XT 16GB GDDR6 256BITS MASTER.jpg', 'AORUS RADEON RX 6800 XT 16GB GDDR6 256BITS MASTER', 10, 1350),
('TG2021ASR001', 'M002ASR', 'C001TG', 'PROV002', '90-GA1XZZ-00UANF', 'ASROCK RADEON RX 5600 XT 6GB GDDR6 192 BITS CHALLENGER OC.jpg', 'ASROCK RADEON RX 5600 XT 6GB GDDR6 192 BITS CHALLENGER OC', 10, 660),
('TG2021ASR002', 'M002ASR', 'C001TG', 'PROV003', '90-GA18ZZ-00UANF', 'ASROCK RADEON RX 5700 XT 8GB GDDR6 256 BITS CHALLENGER OC.jpg', 'ASROCK RADEON RX 5700 XT 8GB GDDR6 256 BITS CHALLENGER OC', 10, 853),
('TG2021ASR003', 'M002ASR', 'C001TG', 'PROV001', '90-GA27ZZ-00UANF', 'ASROCK RADEON RX 6800 XT 16GB GDDR6 256BITS TAICHI OC.jpg', 'ASROCK RADEON RX 6800 XT 16GB GDDR6 256BITS TAICHI OC', 10, 1370),
('TG2021ASR004', 'M002ASR', 'C001TG', 'PROV002', '90-GA2DZZ-00UANF', 'ASROCK RADEON RX6900 XT 16GB GDDR6 256BITS PHANTOM GAMING OC EDITION.jpg', 'ASROCK RADEON RX6900 XT 16GB GDDR6 256BITS PHANTOM GAMING OC EDITION', 10, 1850),
('TG2021ASU001', 'M003ASU', 'C001TG', 'PROV003', '90YV0D90-M0AA00', 'ASUS RADEON ROG STRIX RX 5700 XT GAMING 8GB GDDR6 256BITS OC.jpg', 'ASUS RADEON ROG STRIX RX 5700 XT GAMING 8GB GDDR6 256BITS OC', 10, 880),
('TG2021ASU002', 'M003ASU', 'C001TG', 'PROV001', '90YV0G81-M0AA00', 'ASUS RADEON RX6700 XT 12GB GDDR6 192BITS OC ROG STRIX GAMING.jpg', 'ASUS RADEON RX6700 XT 12GB GDDR6 192BITS OC ROG STRIX GAMING', 10, 1130),
('TG2021ASU003', 'M003ASU', 'C001TG', 'PROV002', '90YV0GE0-M0AM00', 'ASUS RADEON TUF RX 6900 XT 016G GAMING 16GB GDDR6 256BITS OC.jpg', 'ASUS RADEON TUF RX 6900 XT 016G GAMING 16GB GDDR6 256BITS OC', 10, 1880),
('TG2021GIG001', 'M004GIG', 'C001TG', 'PROV003', 'GV-R67XT-12GD-B', 'GIGABYTE RADEON RX 6700 XT 12GB GDDR6 192BITS.jpg', 'GIGABYTE RADEON RX 6700 XT 12GB GDDR6 192BITS', 10, 1000),
('TG2021MSI001', 'M005MSI', 'C001TG', 'PROV001', '912-V398-007', 'MSI RADEON RX 6700 XT 12GB GDDR6 192BITS GAMING X.jpg', 'MSI RADEON RX 6700 XT 12GB GDDR6 192BITS GAMING X', 10, 1155),
('TG2021MSI002', 'M005MSI', 'C001TG', 'PROV002', '912-V398-002', 'MSI RADEON RX 6700 XT 12GB GDDR6 192BITS MECH 2X OC.jpg', 'MSI RADEON RX 6700 XT 12GB GDDR6 192BITS MECH 2X OC', 10, 1080),
('TG2021MSI003', 'M005MSI', 'C001TG', 'PROV003', '912-V396-002', 'MSI RADEON RX 6800 16GB GDDR6 256BITS GAMING X TRIO.jpg', 'MSI RADEON RX 6800 16GB GDDR6 256BITS GAMING X TRIO', 10, 1280);
