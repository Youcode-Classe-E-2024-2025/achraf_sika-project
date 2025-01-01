const saveButton = document.getElementById('saveButton');
const editForm = document.getElementById('editForm');

const taskName = document.getElementById('taskName');
const taskDescription = document.getElementById('taskDescription');
const taskType = document.getElementById('taskType');
const taskStatus = document.getElementById('taskStatus');

function edit(element,description,name,type,status) {
    editModal.style.display="flex";
    const editName = document.getElementById('editName');
    const editDescription = document.getElementById('editDescription');
    const editType = document.getElementById('editType');
    const editStatus = document.getElementById('editStatus');
    const editId = document.getElementById('editTaskId');
    editId.value = element;
    editDescription.value = description.textContent;
    editName.value = name.textContent;
    editType.value = type.textContent.toLowerCase();
    editStatus.value = status;
};
document.addEventListener("DOMContentLoaded",()=>{
    const status = document.querySelectorAll("#taskStatus");
    status.forEach(element => {
        switch (element.textContent) {
            case "To Do":
                element.style.backgroundColor="#d9d7d7"
                element.style.color="#5f5f5f"
                break;
            case "In Progress":
                element.style.backgroundColor="#c5c5ff"
                element.style.color="#4c47b1"
                break;
                
            default:
                break;
        }
    });
    
})