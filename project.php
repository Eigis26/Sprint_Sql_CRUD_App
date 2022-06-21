<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sprint CRUD System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Projects</h2>
                        <a href="crt_project.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Project</a>
                    </div>
                    <?php
                    require_once "config.php";
                    echo'<ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Employees</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="project.php">Projects</a>
                    </li>
                    </ul>';
                    $sql = "SELECT group_concat(CONCAT_WS(' ', name)SEPARATOR ' , ') as names, 
                    project.id, project.project FROM project 
                     left JOIN Employees ON project.id = employees.project_id
                     GROUP BY project.project";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Project</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['project'] . "</td>";
                                        echo "<td>" . $row['names'] . " </td>";
                                        echo "<td>";
                                            echo '<a href="upd_project.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="del_project.php?id='. $row['id'] .'" <span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>