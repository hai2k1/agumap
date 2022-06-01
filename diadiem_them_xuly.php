<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
		<title>Xử lý thêm địa điểm - Bản đồ AGU</title>
	</head>
	<body>
		<div class="container">
			<!-- Menu: sử dụng navbar -->
			<?php include 'navbar.php'; ?>
			
			<!-- Nội dung: sử dụng card -->
			<div class="card mt-3">
				<div class="card-header">Xử lý thêm địa điểm</div>
				<div class="card-body">
				</div>
			</div>

			<?php include 'footer.php'; ?>
		</div>
		
		<?php include 'javascript.php'; ?>
        <?php  ?>
        <script type="module">
            import { getFirestore, doc, setDoc } from 'https://www.gstatic.com/firebasejs/9.6.8/firebase-firestore.js';
            const db = getFirestore();
            await setDoc(doc(db, 'diadiem', '<?php echo str_pad($_POST['MaDiaDiem'], 10, '0', STR_PAD_LEFT); ?>'), {
                MaDiaDiem: <?php echo $_POST['MaDiaDiem']; ?>,
                MaLoai: '<?php echo $_POST['MaLoai']; ?>',
                TenDiaDiem: '<?php echo $_POST['TenDiaDiem']; ?>',
                ViDo: '<?php echo $_POST['ViDo']; ?>',
                KinhDo: '<?php echo $_POST['KinhDo']; ?>',
                DiaChi: '<?php echo $_POST['DiaChi']; ?>',
                GhiChu: '<?php echo $_POST['GhiChu']; ?>',
            });
            location.href = 'diadiem.php';
        </script>
	</body>
</html>
