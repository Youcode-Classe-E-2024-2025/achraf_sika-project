document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.getElementById('editButton');
    const editModal = document.getElementById('editModal');
    const saveButton = document.getElementById('saveButton');
    const editForm = document.getElementById('editForm');

    const taskName = document.getElementById('taskName');
    const taskDescription = document.getElementById('taskDescription');
    const taskType = document.getElementById('taskType');
    const taskStatus = document.getElementById('taskStatus');

    const editName = document.getElementById('editName');
    const editDescription = document.getElementById('editDescription');
    const editType = document.getElementById('editType');
    const editStatus = document.getElementById('editStatus');

    editButton.addEventListener('click', function() {
        editModal.classList.remove('hidden');
        editName.value = taskName.textContent;
        editDescription.value = taskDescription.textContent;
        editType.value = taskType.textContent;
        editStatus.value = taskStatus.textContent;
    });

    saveButton.addEventListener('click', function() {
        taskName.textContent = editName.value;
        taskDescription.textContent = editDescription.value;
        taskType.textContent = editType.value;
        taskStatus.textContent = editStatus.value;

        // Update task type badge color
        updateTypeBadgeColor(taskType);

        // Update task status badge color
        updateStatusBadgeColor(taskStatus);

        editModal.classList.add('hidden');
    });

    // Close modal when clicking outside
    editModal.addEventListener('click', function(event) {
        if (event.target === editModal) {
            editModal.classList.add('hidden');
        }
    });

    function updateTypeBadgeColor(element) {
        element.className = 'px-2 py-1 text-xs font-semibold rounded-full';
        switch(element.textContent) {
            case 'Development':
                element.classList.add('text-blue-800', 'bg-blue-100');
                break;
            case 'Design':
                element.classList.add('text-purple-800', 'bg-purple-100');
                break;
            case 'Marketing':
                element.classList.add('text-green-800', 'bg-green-100');
                break;
            case 'Research':
                element.classList.add('text-yellow-800', 'bg-yellow-100');
                break;
        }
    }

    function updateStatusBadgeColor(element) {
        element.className = 'px-2 py-1 text-xs font-semibold rounded-full';
        switch(element.textContent) {
            case 'To Do':
                element.classList.add('text-gray-800', 'bg-gray-100');
                break;
            case 'In Progress':
                element.classList.add('text-blue-800', 'bg-blue-100');
                break;
            case 'Done':
                element.classList.add('text-green-800', 'bg-green-100');
                break;
        }
    }
});