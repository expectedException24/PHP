<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Prenotazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h2>Modulo Prenotazione</h2>
        <form action="gestioneprenotazione.php" method="get">
            <!-- Nome -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="name" required>
            </div>

            <!-- Cognome -->
            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome</label>
                <input type="text" class="form-control" id="cognome" name="surname" required>
            </div>

            <!-- Numero del tavolo -->
            <div class="mb-3">
                <label for="tavolo" class="form-label">Numero del tavolo</label>
                <select class="form-select" id="tavolo" name="nTable" required>
                    <option value="" disabled selected>Seleziona il numero</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <!-- Orario -->
            <div class="mb-3">
                <label for="orario" class="form-label">Orario</label>
                <input type="time" class="form-control" id="orario" name="time" required>
            </div>

            <!-- Eventuali note -->
            <div class="mb-3">
                <label for="note" class="form-label">Eventuali note</label>
                <textarea class="form-control" id="note" name="extraSpec" rows="3"></textarea>
            </div>

            <!-- Checkbox per antipasto, primo, secondo -->
            <div class="mb-3">
                <label class="form-label">Scelte menù</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="antipasto" name="menu" value="antipasto">
                    <label class="form-check-label" for="antipasto">Antipasto</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="primo" name="menu" value="primo">
                    <label class="form-check-label" for="primo">Primo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="secondo" name="menu" value="secondo">
                    <label class="form-check-label" for="secondo">Secondo</label>
                </div>
            </div>

            <!-- Radio button per parcheggio -->
            <div class="mb-3">
                <label class="form-label">Parcheggio</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="parcheggio_custodito" name="parking"
                        value="custodito" required>
                    <label class="form-check-label" for="parcheggio_custodito">Parcheggio custodito</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="parcheggio_non_custodito" name="parking"
                        value="non_custodito">
                    <label class="form-check-label" for="parcheggio_non_custodito">Parcheggio non custodito</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="no_parcheggio" name="parking" value="nessuno">
                    <label class="form-check-label" for="no_parcheggio">Non usufruirò del parcheggio</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>