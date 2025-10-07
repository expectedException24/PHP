<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rubrica Contatti</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

  <div class="container my-5" style="max-width: 700px;">
    <h1 class="mb-4 text-center">Rubrica Contatti</h1>

    <form id="contactForm">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" placeholder="Inserisci nome" required>
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Telefono</label>
        <input type="tel" class="form-control" id="telefono" placeholder="Inserisci numero di telefono" required>
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Telefono</label>
        <input type="tel" class="form-control" id="telefono" placeholder="Inserisci numero di telefono" required>
      </div>


      <button type="submit" class="btn btn-success w-100">Salva Contatto</button>
    </form>

    <div class="table-responsive mt-5">
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-primary">
          <tr>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Telefono</th>
          </tr>
        </thead>
        <tbody id="contactList">
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
