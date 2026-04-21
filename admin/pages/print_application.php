<?php
require_once "../db.php";

if(!isset($_GET['id'])){
  die("Invalid request");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM admissions WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admission Form</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

<style>

@page{
  size:A4;
  margin:15mm;
}

body{
  font-family: Arial, sans-serif;
  background:#f2f2f2;
}

.container{
  max-width:900px;
  margin:auto;
}

.form-container{
  background:white;
  border:2px solid black;
  padding:30px;
  margin-top:30px;
}

h2,h3{
  text-align:center;
}

.section{
  margin-top:20px;
}

.row{
  display:flex;
  margin-bottom:10px;
}

.row label{
  width:250px;
  font-weight:bold;
}

.row span{
  flex:1;
  border-bottom:1px solid black;
  padding:3px;
}

.photo-box{
  float:right;
  width:140px;
  height:160px;
  border:1px solid black;
  overflow:hidden;
}

.photo-box img{
  width:100%;
  height:100%;
  object-fit:cover;
}

table{
  width:100%;
  border-collapse:collapse;
  margin-top:10px;
}

table,th,td{
  border:1px solid black;
}

th,td{
  padding:6px;
  text-align:center;
}

thead{
  display:table-header-group;
}

/* BUTTON AREA */

.btn-area{
  text-align:center;
  margin-top:25px;
}

.btn-area button{
  padding:10px 20px;
  margin:5px;
}

/* PRINT SETTINGS */

@media print{

  body{
    background:white;
  }

  .btn-area{
    display:none;
  }

  .form-container{
    border:none;
    margin:0;
  }

  table{
    page-break-inside:avoid;
  }

  tr{
    page-break-inside:avoid;
  }

}

</style>
</head>

<body>

<div class="container">

<div class="form-container" id="admissionForm">

<h2>PREMIER ACADEMY, MANGALDAI</h2>
<h3>Senior Secondary School (Arts, Commerce & Science)</h3>
<p style="text-align:center;">
Application for Admission in H.S. First/Second Year
</p>

<div class="photo-box">
<img src="../../uploads/admissions/<?php echo $data['photo']; ?>">
</div>

<div class="section">

<div class="row">
<label>1. Full Name</label>
<span><?php echo $data['full_name']; ?></span>
</div>

<div class="row">
<label>2. Mother's Name</label>
<span><?php echo $data['mother_name']; ?></span>
</div>

<div class="row">
<label>3. Father's Name</label>
<span><?php echo $data['father_name']; ?></span>
</div>

<div class="row">
<label>4. Full Address</label>
<span><?php echo $data['address']; ?></span>
</div>

<div class="row">
<label>5. Guardian Name</label>
<span><?php echo $data['guardian_name']; ?></span>
</div>

<div class="row">
<label>6. Nationality</label>
<span><?php echo $data['nationality']; ?></span>
</div>

<div class="row">
<label>7. Religion</label>
<span><?php echo $data['religion']; ?></span>
</div>

<div class="row">
<label>8. Category</label>
<span><?php echo $data['category']; ?></span>
</div>

<div class="row">
<label>9. Date of Birth</label>
<span><?php echo $data['dob']; ?></span>
</div>

<div class="row">
<label>10. Local Guardian</label>
<span><?php echo $data['local_guardian_name']; ?></span>
</div>

<div class="row">
<label>11. Institution Last Attended</label>
<span><?php echo $data['institution_last_attended']; ?></span>
</div>

<div class="row">
<label>12. H.S.L.C Division</label>
<span><?php echo $data['division']; ?></span>
</div>

</div>

<h3>Marks Obtained in H.S.L.C Exam</h3>

<table>

<thead>
<tr>
<th>Subjects</th>
<th>Assamese</th>
<th>English</th>
<th>G.M.</th>
<th>G.Sc.</th>
<th>S.Sc.</th>
<th>E.V.S.</th>
<th>Total</th>
<th>Division</th>
<th>%</th>
</tr>
</thead>

<tbody>
<tr>
<td>Full Marks</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td>Marks Secured</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</tbody>

</table>

<br>

<p><strong>Subjects to be Taken (1st Year)</strong></p>
<p>Compulsory: English, Assamese, Environmental Science</p>
<p>
<strong>Elective:</strong>
<span><?php echo $data['elective1']; ?></span>,
<span><?php echo $data['elective2']; ?></span>,
<span><?php echo $data['elective3']; ?></span>
</p>

<p><strong>Subjects to be Taken (2nd Year)</strong></p>
<p>Compulsory: English, Assamese</p>
<p>
<strong>Elective:</strong>
<span><?php echo $data['elective4']; ?></span>,
<span><?php echo $data['elective5']; ?></span>,
<span><?php echo $data['elective6']; ?></span>
</p>
</div>


<div class="btn-area">

<button onclick="window.print()" class="btn btn-primary">
Print
</button>

<button onclick="downloadForm()" class="btn btn-success">
Download PDF
</button>

</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>

function downloadForm(){

const element = document.getElementById("admissionForm");

const opt = {
  margin:10,
  filename:'Admission_<?php echo $data['full_name']; ?>.pdf',
  image:{ type:'jpeg', quality:1 },
  html2canvas:{ scale:2 },
  jsPDF:{ unit:'mm', format:'a4', orientation:'portrait' }
};

html2pdf().set(opt).from(element).save();

}

</script>

</body>
</html>