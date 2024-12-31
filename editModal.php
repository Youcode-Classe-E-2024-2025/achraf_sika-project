<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>
<div id="editModal" class="edit-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Task</h3>
        </div>
        <div class="modal-body">
            <form id="editForm">
                <div class="form-group">
                    <label for="editName">Task Name</label>
                    <input type="text" id="editName" name="name">
                </div>
                <div class="form-group">
                    <label for="editDescription">Description</label>
                    <textarea id="editDescription" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="editType">Type</label>
                    <select id="editType" name="type">
                        <option value="simple">Simple</option>
                        <option value="bug">Bug</option>
                        <option value="feature">Feature</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editStatus">Status</label>
                    <select id="editStatus" name="status">
                        <option value="To Do">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button id="saveButton">Save Changes</button>
        </div>
    </div>
</div>
