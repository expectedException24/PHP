
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <form action="submit.php" method="get">
    <div class="input-group d-inline-flex p-5">
      <span class="input-group-text">First and last name</span>
      <input type="text" aria-label="First name" id="nome" name="name" class="form-control">
      <input type="text" aria-label="Last name" id="cognome" name="surname" class="form-control">
      <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">@</span>
        <input type="text" class="form-control" id="mail" name="mail" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
      </div>
    </div>
    <button type="submit" class="btn btn-danger">submit</button>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>