<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    
</body>
</html>
<div id="editModal" class="edit-modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Task</h3>
        </div>
        <div class="modal-body">
            <form action="./Database.php?action=edit" method="post" id="editForm">
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
                <input id="editTaskId" type="hidden" name="id">
                <div class="modal-footer">
                    <button id="saveButton">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .edit-modal {
    position: fixed;
    inset: 0;
    background-color: rgba(75, 85, 99, 0.5);  /* gray-600 with opacity */
    overflow-y: auto;
    height: 100%;
    width: 100%;
    display: none;
    justify-content: center;
    align-items: flex-start;
    padding-top: 5rem;
}

/* Modal Content */
.modal-content {
    background-color: white;
    border-radius: 0.375rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 24rem;
    padding: 1.25rem;
    border: 1px solid #d1d5db;  /* gray-300 */
}

/* Modal Header */
.modal-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #111827;  /* gray-900 */
    margin-bottom: 1rem;
    text-align: center;
}

/* Form Group */
.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    font-size: 0.875rem;
    font-weight: 700;
    color: #374151;  /* gray-700 */
    margin-bottom: 0.5rem;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid #d1d5db;  /* gray-300 */
    border-radius: 0.375rem;
    font-size: 1rem;
    color: #4b5563;  /* gray-700 */
    outline: none;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);  /* blue-300 */
    border-color: #3b82f6;  /* blue-500 */
}

/* Modal Footer */
.modal-footer {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
}

#saveButton {
    background-color: #3b82f6;  /* blue-500 */
    color: white;
    font-size: 1rem;
    font-weight: 500;
    border: none;
    border-radius: 0.375rem;
    padding: 0.75rem;
    width: 100%;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: background-color 0.2s ease-in-out;
}

#saveButton:hover {
    background-color: #2563eb;  /* blue-700 */
}

#saveButton:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
}
</style>