<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Prenotazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <form action="sendData.php" method="POST">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="name" aria-label="name" name="name" aria-describedby="basic-addon2">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="email" aria-label="email" name="email" aria-describedby="basic-addon1">
        </div>
        <div class="input-group">
            <span class="input-group-text">Messaggio</span>
            <textarea class="form-control" aria-label="With textarea" name="textArea"></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Invia</button>
        </div>
    </form>
    <?php
      
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>