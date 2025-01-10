<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<style>
        .desc-container {
            display: grid;
            margin-top: 20px;
        }
        .editor-container {
            width: 80%;
        }
        .hidden{
            display: none;
        }
    </style>
    <div id="" class="desc-container">
        <form action="<?= "/project_oop/controller/ProjectController.php"?>" method="post">
            <input type="hidden" id="jsonMarkdown" name="project_description">
            <input type="submit" value="save">
        </form>
        
        <div class="editor-container" id="editor-container">
            <textarea id="editor" ></textarea>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const markdown = document.getElementById("editor");
            const simplemde = new SimpleMDE({ 
                element: markdown,
                placeholder: "Write your Description here...",
                spellChecker: false,
                hideIcons: ["guide" ,"fullscreen" ,"horizontalRule" ]
            });
            function updatePreview() {
                const desc = document.getElementById("jsonMarkdown");
                desc.value = JSON.stringify(simplemde.value());
            }
            simplemde.codemirror.on("change", updatePreview);
        });
    </script>

