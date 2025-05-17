<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DreamLog — Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        a {
            text-decoration: none;
            color: inherit;
            outline: none;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: #111;
        }

        .container {
            padding: 2rem;
        }

        h2 {
            font-size: 2rem;
            font-weight: 400;
            margin-bottom: 1.5rem;
            margin-left: 20px;
        }

        .recent-dreams {
            display: flex;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .featured-large {
            flex: 1;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            padding: 1rem;
        }

        .featured-large img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .featured-small {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .featured-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            padding: 0.5rem;
            display: flex;
            flex-direction: column;

        }

        .featured-card img {
            width: 100%;
            border-radius: 8px;
        }

        .dream-log {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .dream-post {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .dream-post img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .dream-content {
            display: flex;
            flex-direction: column;
        }

        .dream-title {
            font-weight: 600;
            font-size: 1rem;
            margin-top: 8px;
        }

        .dream-date {
            font-size: 0.8rem;
            color: #888;
            margin-top: 8px;
        }

        .dream-snippet {
            font-size: 0.9rem;
            color: #444;
            margin-top: 16px;
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
    </style>
</head>

<body>

<header>
    <?= view('components/header') ?>
</header>

<div class="container">
    <h2>Recent Dreams</h2>
    <div class="recent-dreams">
        <div class="featured-large" id="featured-large"></div>
        <div class="featured-small" id="featured-small"></div>
    </div>

    <h2>All Dreams</h2>
    <div class="dream-log" id="dream-log"></div>
</div>

<script>
    function getImageUrl(image_url) {
        return image_url && image_url !== 'null' && image_url.trim() !== '' 
            ? image_url 
            : 'https://via.placeholder.com/300x300?text=No+Image';
    }

    function getTags(tags) {
        if (!tags || tags.trim() === '') return '';
        return `
            <div class="dream-tags">
                ${tags.split(',').map(tag => `<span class="dream-tag">${tag.trim()}</span>`).join('')}
            </div>
        `;
    }

    async function loadDreams() {
        try {
            const response = await fetch('/api/dreams');
            const dreams = await response.json();

            const featuredLarge = document.getElementById('featured-large');
            const featuredSmall = document.getElementById('featured-small');
            const dreamLog = document.getElementById('dream-log');

            featuredLarge.innerHTML = '';
            featuredSmall.innerHTML = '';
            dreamLog.innerHTML = '';

            if (dreams.length > 0) {
                const first = dreams[0];
                featuredLarge.innerHTML = `
                    <a href="/dream/${first.id}">
                        <img src="${getImageUrl(first.image_url)}" alt="">
                        <div class="dream-title">${first.title}</div>
                        <div class="dream-date">${new Date(first.created_at).toLocaleDateString()}</div>
                        ${getTags(first.tags)}

                        <div class="dream-snippet">${first.content}</div>
                        
                    </a>
                `;

                dreams.slice(1, 5).forEach(dream => {
                    featuredSmall.innerHTML += `
                        <a href="/dream/${dream.id}" class="featured-card">
                            <img src="${getImageUrl(dream.image_url)}" alt="">
                            <div class="dream-title">${dream.title}</div>
                            <div class="dream-date">${new Date(dream.created_at).toLocaleDateString()}</div>
                            ${getTags(dream.tags)}                            
                            <div class="dream-snippet">${dream.content.substring(0, 50)}...</div>
                        </a>
                    `;
                });

                dreams.slice(5).forEach(dream => {
                    dreamLog.innerHTML += `
                        <a href="/dream/${dream.id}" class="dream-post">
                            <img src="${getImageUrl(dream.image_url)}" alt="">
                            <div class="dream-content">
                                <div class="dream-title">${dream.title}</div>
                                <div class="dream-date">${new Date(dream.created_at).toLocaleDateString()}</div>
                                ${getTags(dream.tags)}

                                <div class="dream-snippet">${dream.content}</div>
                            </div>
                        </a>
                    `;
                });

            } else {
                featuredLarge.innerHTML = '<p>No dreams yet.</p>';
                featuredSmall.innerHTML = '';
                dreamLog.innerHTML = '<p>No dreams logged yet.</p>';
            }
        } catch (err) {
            console.error('Failed to load dreams:', err);
            document.getElementById('dream-log').innerHTML = '<p>Failed to load dreams.</p>';
        }
    }

    loadDreams();
</script>
</body>
</html>
