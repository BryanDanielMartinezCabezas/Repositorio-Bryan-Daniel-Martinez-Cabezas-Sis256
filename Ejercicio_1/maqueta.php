<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="content">
        <nav>
            <h1>Opciones</h1>
            <select name="mes" id="mes">
                <option value=1>Enero</option>
                <option value=2>Febrero</option>
                <option value=3>Marzo</option>
                <option value=4>Abril</option>
                <option value=5>Mayo</option>
                <option value=6>Junio</option>
                <option value=7>Julio</option>
                <option value=8>Agosto</option>
                <option value=9>Septiembre</option>
                <option value=10>Octubre</option>
                <option value=11>Noviembre</option>
                <option value=12>Diciembre</option>
            </select>

            <select name="año" id="año">
            </select>

            <script>
                const inicio = 1975;
                const final = 2024;
                let options = "";

                for (let año = inicio; año <= final; año++) {
                    options += `<option value="${año}">${año}</option>`;
                }

                document.getElementById("año").innerHTML = options;
            </script>
        </nav>

        <section>

        </section>

        <script>
            const yearSelect = document.getElementById('año');
            const monthSelect = document.getElementById('mes');
            function fetchCalendar() {
                const year = yearSelect.value;
                const month = monthSelect.value;
                fetch(`calendario.php?mes=${month}&anio=${year}`)
                    .then(response => response.text())
                    .then(data => {
                        document.querySelector('section').innerHTML = data;
                    });
            }
            fetchCalendar();
            yearSelect.addEventListener('change', fetchCalendar);
            monthSelect.addEventListener('change', fetchCalendar);
        </script>
    </div>
    <footer>Sucre Semestre 1 2024</footer>
</body>
</html>
