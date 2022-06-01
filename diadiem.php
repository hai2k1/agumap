<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
		<title>Địa điểm - Bản đồ AGU</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Địa điểm</div>
				<div class="card-body">
					<a href="diadiem_them.php" class="btn btn-success mb-2">Thêm mới</a>
					<table class="table table-bordered table-hover table-sm mb-0">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th width="15%">Loại</th>
								<th width="55%">Thông tin địa điểm</th>
								<th width="15%">Tọa độ</th>
								<th width="5%">Sửa</th>
								<th width="5%">Xóa</th>
							</tr>
						</thead>
						<tbody id="HienThi">
							
						</tbody>
					</table>
				</div>
			</div>
			
			<!-- Footer: tự code -->
			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
		<script type="module">
			import { getFirestore, collection, getDocs, getDoc } from 'https://www.gstatic.com/firebasejs/9.6.8/firebase-firestore.js';
			const db = getFirestore();

			async function getDanhSachDiaDiem() {
				const querySnapshot = await getDocs(collection(db, 'diadiem'));
				const promises = querySnapshot.docs.map(doc => getRefData(doc));
				return Promise.all(promises)
			}
			
			async function getRefData(doc) {
				var diaDiem = doc.data();
				diaDiem.id = doc.id;
				return diaDiem;
			}
			
			await getDanhSachDiaDiem().then(results => {
				var output = '';
				results.forEach((d) => {

					output += '<tr>';
						output += '<td class="align-middle">' + d.id + '</td>';
						output += '<td class="align-middle">' + d.MaLoai + '</td>';
						output += '<td class="align-middle"><b>' + d.TenDiaDiem + '</b><br>Địa chỉ: ' + d.DiaChi + '</td>';
						output += '<td class="align-middle font-monospace">[' + d.KinhDo + ']<br>[' + d.ViDo + ']</td>';
						output += '<td class="align-middle text-center"><a href="diadiem_sua.php?id=' + d.id + '">Sửa</a></td>';
						output += '<td class="align-middle text-center"><a onclick="return confirm(\'Bạn có muốn xóa địa điểm ' + d.TenDiaDiem + ' không?\')" href="diadiem_xoa.php?id=' + d.id + '">Xóa</a></td>';
					output += '</tr>';
				});
				$('#HienThi').html(output);
			});
		</script>
	</body>
</html>