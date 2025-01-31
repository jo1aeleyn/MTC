document.addEventListener('DOMContentLoaded', () => {
    const taskList = document.getElementById('taskList');
    const addTaskButton = document.getElementById('addTaskButton');
    const newTaskInput = document.getElementById('newTaskInput');
    const clearAllButton = document.getElementById('clearAllButton');
    const filterButtons = document.querySelectorAll('.filter-button');

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Load tasks based on filter
    function loadTasks(filter = 'all') {
        console.log(`Loading tasks with filter: ${filter}`); // Debugging
        fetch(`/tasks?filter=${filter}`)
            .then(response => response.json())
            .then(tasks => {
                taskList.innerHTML = ''; // Clear the existing tasks
                tasks.forEach(task => addTaskToList(task));
            })
            .catch(error => {
                alert('Failed to load tasks');
                console.error(error); // Debugging
            });
    }

    // Add a new task to the list
    function addTaskToList(task) {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex align-items-center'; // Use flexbox layout
        listItem.dataset.id = task.id; // Set task ID for easy access

        // Create a wrapper for checkbox and task text
        const contentWrapper = document.createElement('div');
        contentWrapper.className = 'd-flex align-items-center flex-grow-1'; // Flex grow to push delete button to the right

        // Create a checkbox for the task
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.className = 'form-check-input me-3';
        checkbox.checked = task.completed;
        checkbox.addEventListener('change', () => {
            updateTaskStatus(task.id, checkbox.checked);
        });

        // Create an element to hold the task title
        const taskText = document.createElement('span');
        taskText.className = 'task-text';
        taskText.textContent = task.title;
        if (task.completed) {
            taskText.style.textDecoration = 'line-through';
            taskText.style.pointerEvents = 'none';
        }
        taskText.addEventListener('click', () => {
            if (!task.completed) { // Only make editable if not completed
                makeTaskEditable(task.id, taskText);
            }
        });

        // Append checkbox and task text to contentWrapper
        contentWrapper.appendChild(checkbox);
        contentWrapper.appendChild(taskText);

        // Create a delete button
        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-sm'; // Ensure button is small and red
        deleteButton.innerHTML = '<i class="bx bxs-trash" style="color:#ff3e1d"></i>'; // Use Bootstrap Icons trash icon
        deleteButton.addEventListener('click', () => {
            // Confirm deletion with SweetAlert2
            Swal.fire({
                title: 'Are you sure?',
                text: "You will not be able to recover this task!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteTask(task.id, listItem);
                }
            });
        });

        // Append contentWrapper and deleteButton to listItem
        listItem.appendChild(contentWrapper);
        listItem.appendChild(deleteButton);

        taskList.appendChild(listItem);
    }


    // Make a task editable inline
    function makeTaskEditable(taskId, taskTextElement) {
        const originalText = taskTextElement.textContent;
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-control';
        input.value = originalText;

        // Replace the task text with an input field
        taskTextElement.replaceWith(input);
        input.focus();

        // Save changes on blur or Enter key
        input.addEventListener('blur', () => saveEdit(taskId, input, originalText));
        input.addEventListener('keypress', (event) => {
            if (event.key === 'Enter') {
                saveEdit(taskId, input, originalText);
            }
        });
    }

    // Save the edited task
    function saveEdit(taskId, input, originalText) {
        const newText = input.value.trim();
        if (newText === originalText) {
            input.replaceWith(createTaskTextElement(originalText));
            return;
        }
        updateTask(taskId, newText).then(() => {
            input.replaceWith(createTaskTextElement(newText));
        }).catch(() => {
            alert('Failed to update task');
            input.replaceWith(createTaskTextElement(originalText));
        });
    }

    function createTaskTextElement(text) {
        const span = document.createElement('span');
        span.className = 'task-text';
        span.textContent = text;
        span.addEventListener('click', () => {
            makeTaskEditable(span.parentElement.dataset.id, span);
        });
        return span;
    }

    // Update task status
    function updateTaskStatus(taskId, completed) {
        fetch(`/tasks/${taskId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ completed })
        }).then(response => {
            if (!response.ok) {
                throw new Error('Failed to update task status');
            }
            // Update the task text style based on checkbox state
            const taskTextElement = taskList.querySelector(`[data-id="${taskId}"] .task-text`);
            if (taskTextElement) {
                taskTextElement.style.textDecoration = completed ? 'line-through' : 'none';
            }
        }).catch(error => {
            alert(error.message);
        });
    }

    // Update task title
    function updateTask(taskId, title) {
        return fetch(`/tasks/${taskId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ title })
        }).then(response => {
            if (!response.ok) {
                throw new Error('Failed to update task');
            }
        });
    }

    // Delete a task
    function deleteTask(taskId, listItem) {
        fetch(`/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            if (response.ok) {
                listItem.remove();
            } else {
                throw new Error('Failed to delete task');
            }
        }).catch(error => {
            alert(error.message);
        });
    }

    // Add task on button click
    addTaskButton.addEventListener('click', () => {
        const title = newTaskInput.value.trim();
        if (title) {
            fetch('/tasks', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ title })
            }).then(response => response.json())
                .then(task => {
                    addTaskToList(task);
                    newTaskInput.value = '';
                })
                .catch(error => {
                    alert('Failed to add task');
                });
        }
    });

    // Set up filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const filter = button.getAttribute('data-filter');
            console.log(`Filter button clicked: ${filter}`);
            loadTasks(filter);
        });
    });

    // Clear all tasks
    clearAllButton.addEventListener('click', () => {
        console.log('Clear all button clicked');
        console.log('CSRF Token:', csrfToken);
        fetch('/tasks-clearAll', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => {
                if (response.ok) {
                    taskList.innerHTML = '';
                    console.log('Tasks cleared successfully');
                } else {
                    throw new Error('Failed to clear tasks');
                }
            })
            .catch(error => {
                alert(error.message);
                console.error(error);
            });
    });

    // Initial load
    loadTasks();
});

// Delete a task swal
function deleteTask(taskId, listItem) {
    fetch(`/tasks/${taskId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    }).then(response => {
        if (response.ok) {
            listItem.remove();
            Swal.fire(
                'Deleted!',
                'Your task has been deleted.',
                'success'
            );
        } else {
            throw new Error('Failed to delete task');
        }
    }).catch(error => {
        Swal.fire(
            'Failed!',
            'There was an issue deleting the task.',
            'error'
        );
    });
}
