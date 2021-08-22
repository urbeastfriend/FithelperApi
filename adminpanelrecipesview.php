<?php 
session_start();
if(empty($_SESSION['login']) || $_SESSION['login'] == ''){
    echo '<script type="text/javascript"> window.location = "login.php" </script>';
    die();
}

 ?>

<html>
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Kursach_project</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="css/admin.css">

  <link href="https://fonts.googleapis.com/css?family=Merriweather:300i&display=swap" rel="stylesheet">

  


  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"> </script>



  <script> 
    $(document).ready(function() {
     $('#mydatatable').dataTable();
   });
 </script>

</head>

<header>

    <nav class="navbar navbar-expand-lg">


      <div class="collapse navbar-collapse" id="myNavbar">

        <ul class="navbar-nav mx-auto">

          <li class="nav-item">
            <a href="adminpanelchange.php" class="nav-link text-capitalize" style="justify-content: center; align-items: center;">Добавить/Изменить записи</a>
          </li>


          <li class="nav-item active">
            <a href="adminpanelrecipesview.php" class="nav-link text-capitalize " style="justify-content: center; align-items: center;">Просмотр/Удаление рецептов</a>
          </li>

          <li class="nav-item">
            <a href="adminpanelcategoriesview.php" class="nav-link text-capitalize" style="justify-content: center; align-items: center;">Просмотр/Удаление категорий</a>
          </li>
          <li class="nav-item">
            <a href="adminpanelrecomendationsview.php" class="nav-link text-capitalize" style="justify-content: center; align-items: center;">Просмотр/Удаление рекомендаций</a>
          </li>


          <li class="nav-item">
            <a href="logout.php" class="nav-link text-capitalize" style="justify-content: flex-end;">Выйти</a>
          </li>



        </div>


      </ul>
    </div>
  </nav>
</header>

<body>

  

<div class="container mb-3 mt-3 ml-5" >
  <table class="table table-striped table-bordered mydatatable " style="width:100% " id="mydatatable">
    <thead>
      <tr>
        <th>idMeal</th>
        <th>strMeal</th>
        <th>strCategory</th>
        <th>strArea</th>

        <th>strMealThumb</th>
        <th>strTags</th>
        <th>strIngredients</th>
        <th>strMeasures</th>
        <th>strMealInfo</th>
        <th>strCookTime</th>
      </tr>

    </thead>
    <tbody>

      <?php 
      require 'api/db_connect.php';



      $query = "select * from meals";
      $result = mysqli_query($bd,$query) or die(mysqli_error($bd));

      while($row = mysqli_fetch_array($result))
      {
        echo "<tr>
        <td>".$row['idMeal']."</td>
        <td>".$row['strMeal']."</td>
        <td>".$row['strCategory']."</td>
        <td>".$row['strArea']."</td>

        <td>".$row['strMealThumb']."</td>
        <td>".$row['strTags']."</td>
        <td>".$row['strIngredients']."</td>
        <td>".$row['strMeasures']."</td>
        <td>".$row['strMealInfo']."</td>
        <td>".$row['strCookTime']."</td>
        </tr>";
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>idMeal</th>
        <th>strMeal</th>
        <th>strCategory</th>
        <th>strArea</th>

        <th>strMealThumb</th>
        <th>strTags</th>
        <th>strIngredients</th>
        <th>strMeasures</th>
        <th>strMealInfo</th>
        <th>strCookTime</th>
      </tr>
    </tfoot>
  </table>

</div>

  <section id="about" class="pl-5 pt-3 pb-5 pr-5  background" style="width: 35%; ">

    <section id='main' style="border: solid 2px #242424 " class="mt-1 mb-1">
      <div class="hidden">
        <form id="auth" class="popup_fast py-2 pl-4 pr-4 " style="right:38%;" method="POST">
          <h5 style="text-align: center;">Удаление записи из базы данных(Не рекомендуется)</h5>
          <p></p>
          <input type="text" name="recID" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" size=20 placeholder="Идентификатор записи">
          <p></p>
          <button type="submit" name="action" value="deleterecipe" class="btn" style="border: solid 1px; width: 34%;">Удалить запись</button>
        </form>
      </div>
    </section>
  </section>


  <!-- Удаление категории по идентификатору -->

  <?php 
  if (isset($_POST['recID']) and $_REQUEST['action'] =='deleterecipe')
  {

    require_once 'api/db_connect.php';

    $recipeid = $_POST['recID'];

    $queryy = "DELETE from meals WHERE idMeal = '$recipeid'";
    
    $result = mysqli_query($bd, $queryy) or die ("Ошибка".mysqli_error($bd)); 

    
    

    echo '<script>window.location="adminpanelrecipesview.php"</script>';


  }

  ?>




</body>
</html>