<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" > 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <span class="navbar-text">
     <a href="index.php"><i class="bi bi-house-fill"></i></a>
    </span>
  </div>
</nav>

<section>
    <div class="container">
        <form>
                <legend>Register</legend>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student ID</label>
                <input type="text" name="" class="form-control">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student FullName</label>
                <input type="text" name="" class="form-control">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Password</label>
                <input type="password" name="" class="form-control">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Confrim Password</label>
                <input type="password" name="" class="form-control">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Gender</label>
                <select id="disabledSelect" class="form-select">
                    <option value="F">Female</option>
                    <option value="M">Male</option>
                </select>
                </div>
                <div class="mb-3">
                <label for="disabledSelect" class="form-label">Program</label>
                <select id="disabledSelect" class="form-select">
                    <option>BS Information Technology</option>
                    <option>BS Information Technology Animation</option>
                </select>
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Year & Block</label>
                <input type="text" name="" class="form-control" placeholder="Example: 1A">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
           
        </form>

    </div>

</section>






    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
</body>
</html>