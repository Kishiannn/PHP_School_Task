<?php
require "conn.php";
session_start();

function createSection($name){
    $conn = connection();
    $sql = "INSERT INTO sections (`name`) VALUE ('$name')";

    if($conn -> query($sql)){
        header('refresh: 0'); //refresh the page if successful
    } else{
        die("Error adding new product section: " .$conn -> error);
        //kill program with error message if not successful
    }   
}

function getAllSections(){
    $conn = connection();
    $sql = "SELECT id, name FROM sections";

    if($result = $conn -> query($sql)){
        return $result;
    }else{
        die("Error retrieving product sections: " .$conn -> error);
    }
}

function deleteSection($section_id){
    $conn = connection();
    $sql = "DELETE FROM sections WHERE id = $section_id";

    if($result = $conn -> query($sql)){
        return $result;
    }else{
        die("Error delete product sections: " .$conn -> error);
    }
}

if(isset($_POST['btn_add'])){
    $name = $_POST['name'];

    createSection($name);
}
if(isset($_POST['btn_delete'])){
    $section_id = $_POST['btn_delete'];
    deleteSection($section_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-3">
                <h2 class="fw-light mb-3">Sections</h2>
                <div class="mb-3">
                    <!---FORM-->
                    <form action="" method="post">
                        <div class="row gx-2">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Add a new section here..." max="50" required autofocus>
                            </div>
                            <div class="col-auto">
                                <button type="submit" name="btn_add" class="btn-info w-100 fw-bold">
                                    <i class="fa-solid fa-plus"></i> Add 
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
                <!--TABLE-->
                <table class="table table-sm align-middle text-center">
                    <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $all_sections = getAllSections();
                        while($section = $all_sections -> fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $section['id'] ?></td>
                            <td><?php echo $section['name'] ?></td>
                            <td>
                                <form method="post">
                                    <button type="submit" value="<?= $section['id']?>" name="btn_delete" class="btn btn-outline-danger border-0"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>


            </div>
        </div>
    </main>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>    
</body>
</html>
