<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
		<title>AGUMap - Bản đồ AGU</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Bản đồ địa điểm</div>
				<div class="card-body p-0">
					<div id="myMap" style="position:relative;width:100%;height:500px;"></div>
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script src="https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AhEhTZ7FhjvBBhTFwkgpQs2KNtwM_G4hnYuiUtxFVej2TjrrgF9wTpaN2MdOWNSb" async defer></script>
		<script type="module">
			import { getFirestore, collection, getDocs, getDoc,doc } from 'https://www.gstatic.com/firebasejs/9.6.8/firebase-firestore.js';
			const db = getFirestore();
			
			async function getDanhSachDiaDiem() {
				const querySnapshot = await getDocs(collection(db, 'diadiem'));
				const promises = querySnapshot.docs.map(doc => getRefData(doc));
				return Promise.all(promises)
			}
			
			async function getRefData(data) {
				var diaDiem = data.data();
				diaDiem.id = data.id;
                const docRef = doc(db, 'loaidiadiem', diaDiem.MaLoai);
				var loaiDiaDiem = await getDoc(docRef);
				diaDiem.Loai = { ...loaiDiaDiem.data() };
				return diaDiem;
			}
			
			// Khai báo biến toàn cục
			window.getDanhSachDiaDiem = getDanhSachDiaDiem;
		</script>
		<script>
			var map, infobox;
			
			function GetMap() {
				map = new Microsoft.Maps.Map('#myMap', {
					center: new Microsoft.Maps.Location(9.83686079255947, 105.58491554914823),
					zoom: 15
				});
				
				infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
					visible: true
				});
				
				infobox.setMap(map);
				
				getDanhSachDiaDiem().then(results => {
					results.forEach((d) => {
						var image = '';
						if(d.Loai.MaLoai == 1)
							image = 'images/hotel.png';
						else if(d.Loai.MaLoai == 2)
							image = 'images/hospital.png';
						else
							image = 'images/restaurant.png';
						var loc = new Microsoft.Maps.Location(d.ViDo, d.KinhDo)
						var pin = new Microsoft.Maps.Pushpin(loc, {
							icon: image
						});
						pin.metadata = {
							title: d.TenDiaDiem,
							description: 'Địa chỉ: ' + d.DiaChi
						};
						Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);
						map.entities.push(pin);
					});
				});
			}
			
			function pushpinClicked(e) {
				if (e.target.metadata) {
					infobox.setOptions({
						location: e.target.getLocation(),
						title: e.target.metadata.title,
						description: e.target.metadata.description,
						visible: true
					});
				}
			}
		</script>
	</body>
</html>