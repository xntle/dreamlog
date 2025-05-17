<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DreamLog — Tell us about your dream</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: #111;
            line-height: 1.6;
            background: #fff;
        }

        .main {
            flex: 1;
            padding: 6rem 2rem 2rem 2rem;
            max-width: 80ch;
        }

        .title {
            font-size: 4.6rem;
            font-weight: 700;
            margin-bottom: 1rem;
            margin-top: -4rem;
        }

        .editable-title, .editable-text {
            outline: none;
            padding: 0.5rem 0;
            margin-bottom: 1rem;
            width: 100%;
        }

        .editable-title {
            font-size: 1.4rem;
            font-weight: 600;
            min-height: 2.5rem;
        }

        .editable-text {
            font-size: 1rem;
            min-height: 10rem;
        }

        .editable:empty:before {
            content: attr(placeholder);
            color: #bbb;
        }

        #dreamImage {
            position: fixed;
            top: 6rem;
            right: 2rem;
            width: 40vw;
            max-width: 600px;
            display: none;
            border-radius: 12px;
            overflow: hidden;
            z-index: 10;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #dreamImage img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 12px;
        }

        .tag {
            background: #f4f4f4;
            padding: 0.2rem 0.7rem;
            border-radius: 999px;
            font-size: 0.8rem;
            color: #555;
            cursor: pointer;
            user-select: none;
        }

        .tag-input {
            border: none;
            outline: none;
            font-size: 0.9rem;
            min-width: 100px;
            flex: 1;
        }

        #tagsContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .add-image-btn {
            position: fixed;
            top: 8rem;
            right: 2rem;
            padding: 0.4rem 1.2rem;
            border: 1px solid #111;
            border-radius: 999px;
            background: transparent;
            font-size: 0.9rem;
            cursor: pointer;
            z-index: 15;
        }

        .add-image-btn:hover {
            background: #111;
            color: #fff;
        }

        .actions {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: none;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border: 1px solid #111;
            border-radius: 999px;
            background: transparent;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn:hover {
            background: #111;
            color: #fff;
        }

        #fileInput {
            display: none;
        }
    </style>
</head>
<body>

<header>
    <?= view('components/header') ?>
</header>

<div class="main">
    <!-- ✅ Tags container always on top -->

    <div class="title">Tell us about your dream.</div>
    <div id="tagsContainer"></div>

    <div class="editable editable-title" id="dreamTitle" contenteditable="true" placeholder="Your dream title..."></div>
    <div class="editable editable-text" id="dreamText" contenteditable="true" placeholder="Start writing your dream..."></div>
</div>

<div id="dreamImage">
    <img src="" alt="Dream Image">
</div>

<button class="add-image-btn" id="addImageBtn">add image</button>

<div class="actions" id="actions">
    <form id="dreamForm" method="post" enctype="multipart/form-data" action="/api/create">
        <input type="hidden" name="title" id="hiddenTitle">
        <input type="hidden" name="content" id="hiddenContent">
        <input type="hidden" name="tags" id="hiddenTags">
        <input type="file" name="image" id="fileInput" accept="image/*">
        <button type="submit" class="btn">submit</button>
    </form>
</div>

<script>
    const titleInput = document.getElementById('dreamTitle');
    const textInput = document.getElementById('dreamText');
    const actions = document.getElementById('actions');
    const dreamImage = document.getElementById('dreamImage');
    const imgTag = dreamImage.querySelector('img');
    const addImageBtn = document.getElementById('addImageBtn');
    const fileInput = document.getElementById('fileInput');
    const dreamForm = document.getElementById('dreamForm');
    const hiddenTitle = document.getElementById('hiddenTitle');
    const hiddenContent = document.getElementById('hiddenContent');
    const hiddenTags = document.getElementById('hiddenTags');

    let tags = [];

    function renderTags() {
        tagsContainer.innerHTML = `
            ${tags.map(t => `<span class="tag" onclick="removeTag('${t}')">#${t}</span>`).join('')}
            <input type="text" id="tagInput" class="tag-input" placeholder="Add tags follow by a space :-)">
        `;

        const newTagInput = document.getElementById('tagInput');
        newTagInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ' || e.key === ',') {
                e.preventDefault();
                addTag(newTagInput.value);
            }
        });
        newTagInput.focus();
    }

    function addTag(tag) {
        tag = tag.trim().replace(/^#/, '');
        if (tag && !tags.includes(tag)) {
            tags.push(tag);
            renderTags();
        }
    }

    function removeTag(tag) {
        tags = tags.filter(t => t !== tag);
        renderTags();
    }

    function checkContent() {
        if (titleInput.innerText.trim() !== '' || textInput.innerText.trim() !== '') {
            actions.style.display = 'block';
        } else {
            actions.style.display = 'none';
        }
    }

    titleInput.addEventListener('input', checkContent);
    textInput.addEventListener('input', checkContent);

    addImageBtn.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (evt) {
                imgTag.src = evt.target.result;
                dreamImage.style.display = 'block';
                addImageBtn.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });

    imgTag.addEventListener('click', () => fileInput.click());

    dreamForm.addEventListener('submit', function (e) {
        hiddenTitle.value = titleInput.innerText.trim();
        hiddenContent.value = textInput.innerText.trim();
        hiddenTags.value = tags.join(',');
    });

    // Initial render
    renderTags();
    titleInput.focus();
</script>

</body>
</html>
