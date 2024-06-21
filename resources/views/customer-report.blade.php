<html>

<head>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: black;
        }

        @page {
            size: A4;
            margin: 150px 50px;
        }

        header,
        footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }

        header {
            top: -100px;
        }

        header h1 {
            text-decoration: underline;
        }

        footer {
            bottom: -50px;
        }

        footer .pagination:after {
            content: " " counter(page);
        }

        img {
            width: 200px;
        }

        .general-list li {
            margin-top: 20px;
        }

        .hobby-list li {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('/assets/bloonde.svg') }}">
        <h1>Reporte de Clientes</h1>
    </header>

    <footer>
        <p class="pagination">Página</p>
    </footer>

    <main>
        <ol class="general-list">
            @foreach ($customers as $customer)
                <li>
                    <strong>Nombre y Apellidos:</strong> {{ $customer->name }} {{ $customer->surname }}

                    <br />

                    <strong>- Hobbies:</strong>

                    <ul class="hobby-list">
                        @foreach ($customer->hobbies as $hobbie)
                            <li>{{ $hobbie->name }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ol>
    </main>
</body>

</html>
