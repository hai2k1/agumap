<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Liên kết và cấu hình Firebase -->
<script type="module">
	// Import the functions you need from the SDKs you need
	import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-app.js";
	import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.8/firebase-analytics.js";
	
	// TODO: Add SDKs for Firebase products that you want to use
	// https://firebase.google.com/docs/web/setup#available-libraries
	
	// Your web app's Firebase configuration
	// For Firebase JS SDK v7.20.0 and later, measurementId is optional
	// For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyBaAAZCdwpyGi45630jew4yuooFa0IG5r8",
        authDomain: "dark-pipe-351516.firebaseapp.com",
        projectId: "dark-pipe-351516",
        storageBucket: "dark-pipe-351516.appspot.com",
        messagingSenderId: "473586826757",
        appId: "1:473586826757:web:491ec7b042a22c2974e66c",
        measurementId: "G-E0CCP6KN9W"
    };
	
	// Initialize Firebase
	const app = initializeApp(firebaseConfig);
	const analytics = getAnalytics(app);
</script>