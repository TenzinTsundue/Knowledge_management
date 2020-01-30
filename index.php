<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Knowledge management</title>
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php
        if(isset($_SESSION['message'])):?>

    <div class="alert alert-<?=$_SESSION['msg_type'] ?> ">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
    </div>
    <?php endif ?>
    
    <?php include 'header.php'; ?> 
    <div class="container">
        <?php include 'connect.php'; 
            $sql="SELECT * FROM donor";
            $result = $conn->query($sql) or die($conn->error);    
        ?>
        
        <p class="h1 text-center">Donor input</p>
        <div class="row justify-content-left">
            <form action="process.php" method="POST">
                <input type="hidden" name='id' value="<?php echo $id; ?>">
                <div class="form-group">
                <label>Donar name :</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter donor name">
                </div>
                <div class="form-group">
                <label>Guideline :</label>
                <input type="text" name="guideline" class="form-control" value="<?php echo $guid; ?>" placeholder="paste guideline link">
                </div>
                <div class="form-group">
                <label>Year :</label>
                <input type="text" name="year" class="form-control" value="<?php echo $year; ?>" placeholder="Year of donation">
                </div>
                <div class="form-group">
                <?php
                if ($update == true):
                ?>
                    <button type="submit" class="btn btn-info" name="update">UPDATE</button>
                <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">SAVE</button>
                <?php endif; ?>
                </div>
            </form>  
        </div> 
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                    <th>Donor name</th>
                    <th>Guideline</th>
                    <th>Year</th>
                    <th colspan="2">Action</th>
                    </tr>
                </thead>
        </div>
        <?php
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['donor_name']; ?></td>
                    <?php
                    $url = $row['guideline']; 
                    echo "<td><a href='" . $url . "'>" . $url . "</a></td>"; ?>
                    <td><?php echo $row['year']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php include 'footer.php'; ?> 
    </div>
</body>
</html>