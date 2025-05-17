<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dream Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #fff;
        }

        main {
            padding: 2rem;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <header>
        <?= view('components/header') ?>
    </header>

    <main>
        <?= view('components/calendar', [
            'month' => $month,
            'year' => $year,
            'dreamsByDate' => $dreamsByDate,
        ]) ?>
    </main>
</body>
</html>
