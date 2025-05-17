<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($dream['title']) ?> — DreamLog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            padding: 2rem;
            max-width: 700px;
            margin: auto;
            line-height: 1.8;
            color: #111;
        }

        img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        h1 {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        .date {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        .content {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .dream-tags {
            margin-top: 0.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .dream-tag {
            background: #f4f4f4;
            padding: 0.2rem 0.7rem;
            border-radius: 999px;
            font-size: 0.75rem;
            color: #555;
        }

        a.back {
            display: inline-block;
            margin-top: 2rem;
            color: #333;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1><?= esc($dream['title']) ?></h1>
    <div class="date"><?= date('F j, Y', strtotime($dream['created_at'])) ?></div>

    <img src="<?= esc($dream['image_url']) ?: 'https://via.placeholder.com/600x400?text=No+Image' ?>" alt="Dream Image">

    <div class="content"><?= esc($dream['content']) ?></div>

    <?php if (!empty($dream['tags'])): ?>
        <div class="dream-tags">
            <?php foreach (explode(',', $dream['tags']) as $tag): ?>
                <span class="dream-tag">#<?= esc(trim($tag)) ?></span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <a href="/" class="back">← Back to all dreams</a>

</body>
</html>
