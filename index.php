<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/login.css" />
  <style>
  
body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
}

h1 {
  text-align: center;
  margin-bottom: 20px;
  color: blue;
}

.first-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

#userTypeDropdown {
  width: 300px;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 20px;
}

  </style>
  
  <title>Home</title>
</head>

<body>
  <h1>Maluti Pharmacy</h1>

  <div class="first-box">
    <select id="userTypeDropdown" onchange="redirectToLogin()">
      <option value="" disabled selected>Select User Type</option>
      <option value="pharmacist">Pharmacist</option>
      <option value="admin">Admin</option>
      <option value="patient">Patient</option>
    </select>
  </div>

  <script>
    function redirectToLogin() {
      var selectedUserType = document.getElementById("userTypeDropdown").value;
      if (selectedUserType === "pharmacist") {
        window.location.href = "pharmacist/index.php";
      } else if (selectedUserType === "admin") {
        window.location.href = "admin/AdminLogin.php";
      } else if (selectedUserType === "patient") {
        window.location.href = "patient/PatientLogin.php";
      }
    }
  </script>

</body>

</html>
