<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<style>
        .container {
            display: grid;
            margin-top: 20px;
        }
        .editor-container, .preview-container {
            width: 80%;
        }
        #preview {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 300px;
            background-color: #f9f9f9;
        }
        .hidden{
            display: none;
        }
    </style>
    <div class="container">
        <button onclick="previewToggal()" id="preview-btn" style="margin-bottom: 10px;">preview</button>
        <div class="editor-container" id="editor-container">
            <textarea id="editor"></textarea>
        </div>
        <div class="preview-container hidden" id="preview-container">
            <div id="preview"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        function previewToggal() {
            document.getElementById("editor-container");
            document.getElementById("preview-container").classList.toggle("hidden");
            document.getElementById("editor-container").classList.toggle("hidden");

        }
        document.addEventListener("DOMContentLoaded", () => {
            const markdown = document.getElementById("editor");
            const simplemde = new SimpleMDE({ 
                element: markdown,
                placeholder: "Write your description here...",
                spellChecker: false,
                hideIcons: ["guide", "preview", "fullscreen", "horizontalRule"]
            });
            function updatePreview() {
                const preview = document.getElementById("preview");
                preview.innerHTML = simplemde.markdown(simplemde.value());
            }
            simplemde.codemirror.on("change", updatePreview);
        });
    </script>

