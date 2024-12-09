// Enhanced BCA Notes App with More Features

// Advanced Search with Filters
function advancedSearch() {
    const titleFilter = document.getElementById("titleFilter").value.toLowerCase();
    const subjectFilter = document.getElementById("subjectFilter").value.toLowerCase();
    const contentFilter = document.getElementById("contentFilter").value.toLowerCase();

    const filteredNotes = notes.filter(note =>
        note.title.toLowerCase().includes(titleFilter) &&
        note.subject.toLowerCase().includes(subjectFilter) &&
        note.content.toLowerCase().includes(contentFilter)
    );

    renderNotes(filteredNotes);
}

// Export Notes to JSON File
function exportNotes() {
    const blob = new Blob([JSON.stringify(notes, null, 2)], { type: "application/json" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "bca_notes.json";
    link.click();
}

// Import Notes from JSON File
function importNotes(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const importedNotes = JSON.parse(e.target.result);
            notes = notes.concat(importedNotes);
            saveNotesToLocalStorage();
            renderNotes();
            renderCategories();
        };
        reader.readAsText(file);
    }
}

// Preview Note in a Modal
function previewNote(id) {
    const note = notes.find(n => n.id === id);
    if (note) {
        const modal = document.getElementById("notePreviewModal");
        modal.querySelector(".modal-title").innerText = note.title;
        modal.querySelector(".modal-subject").innerText = note.subject;
        modal.querySelector(".modal-content").innerText = note.content;
        modal.style.display = "block";
    }
}

// Close Modal
function closeModal() {
    const modal = document.getElementById("notePreviewModal");
    modal.style.display = "none";
}

// Set Reminder for a Note
function setReminder(id) {
    const reminderTime = prompt("Enter reminder time (YYYY-MM-DD HH:MM:SS):");
    if (reminderTime) {
        const reminderDate = new Date(reminderTime);
        const now = new Date();
        if (reminderDate > now) {
            const timeDifference = reminderDate - now;
            setTimeout(() => {
                alert(`Reminder for Note: "${notes.find(note => note.id === id).title}"`);
            }, timeDifference);
        } else {
            alert("The reminder time must be in the future.");
        }
    }
}

// Add Event Listeners for Export and Import
document.getElementById("exportNotes").addEventListener("click", exportNotes);
document.getElementById("importNotes").addEventListener("change", importNotes);

// Render Notes with Advanced Filters
document.getElementById("advancedSearchButton").addEventListener("click", advancedSearch);

// Modal Close Button
document.getElementById("modalCloseButton").addEventListener("click", closeModal);

// Reminder Button in Notes
function renderNotes(filter = "") {
    notesContainer.innerHTML = "";
    const filteredNotes = notes.filter(note =>
        note.title.toLowerCase().includes(filter.toLowerCase()) ||
        note.content.toLowerCase().includes(filter.toLowerCase()) ||
        note.subject.toLowerCase().includes(filter.toLowerCase())
    );

    filteredNotes.forEach(note => {
        const noteElement = document.createElement("div");
        noteElement.classList.add("note");
        noteElement.innerHTML = `
            <h3>${note.title}</h3>
            <p><strong>Subject:</strong> ${note.subject}</p>
            <p>${note.content}</p>
            <button onclick="editNote(${note.id})">Edit</button>
            <button onclick="deleteNote(${note.id})">Delete</button>
            <button onclick="previewNote(${note.id})">Preview</button>
            <button onclick="setReminder(${note.id})">Set Reminder</button>
        `;
        notesContainer.appendChild(noteElement);
    });
}

// Run Initialization
initializeApp();
// Enhanced BCA Notes App with More Features

// Advanced Search with Filters
function advancedSearch() {
    const titleFilter = document.getElementById("titleFilter").value.toLowerCase();
    const subjectFilter = document.getElementById("subjectFilter").value.toLowerCase();
    const contentFilter = document.getElementById("contentFilter").value.toLowerCase();

    const filteredNotes = notes.filter(note =>
        note.title.toLowerCase().includes(titleFilter) &&
        note.subject.toLowerCase().includes(subjectFilter) &&
        note.content.toLowerCase().includes(contentFilter)
    );

    renderNotes(filteredNotes);
}

// Export Notes to JSON File
function exportNotes() {
    const blob = new Blob([JSON.stringify(notes, null, 2)], { type: "application/json" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "bca_notes.json";
    link.click();
}

// Import Notes from JSON File
function importNotes(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const importedNotes = JSON.parse(e.target.result);
            notes = notes.concat(importedNotes);
            saveNotesToLocalStorage();
            renderNotes();
            renderCategories();
        };
        reader.readAsText(file);
    }
}

// Preview Note in a Modal
function previewNote(id) {
    const note = notes.find(n => n.id === id);
    if (note) {
        const modal = document.getElementById("notePreviewModal");
        modal.querySelector(".modal-title").innerText = note.title;
        modal.querySelector(".modal-subject").innerText = note.subject;
        modal.querySelector(".modal-content").innerText = note.content;
        modal.style.display = "block";
    }
}

// Close Modal
function closeModal() {
    const modal = document.getElementById("notePreviewModal");
    modal.style.display = "none";
}

// Set Reminder for a Note
function setReminder(id) {
    const reminderTime = prompt("Enter reminder time (YYYY-MM-DD HH:MM:SS):");
    if (reminderTime) {
        const reminderDate = new Date(reminderTime);
        const now = new Date();
        if (reminderDate > now) {
            const timeDifference = reminderDate - now;
            setTimeout(() => {
                alert(`Reminder for Note: "${notes.find(note => note.id === id).title}"`);
            }, timeDifference);
        } else {
            alert("The reminder time must be in the future.");
        }
    }
}

// Add Event Listeners for Export and Import
document.getElementById("exportNotes").addEventListener("click", exportNotes);
document.getElementById("importNotes").addEventListener("change", importNotes);

// Render Notes with Advanced Filters
document.getElementById("advancedSearchButton").addEventListener("click", advancedSearch);

// Modal Close Button
document.getElementById("modalCloseButton").addEventListener("click", closeModal);

// Reminder Button in Notes
function renderNotes(filter = "") {
    notesContainer.innerHTML = "";
    const filteredNotes = notes.filter(note =>
        note.title.toLowerCase().includes(filter.toLowerCase()) ||
        note.content.toLowerCase().includes(filter.toLowerCase()) ||
        note.subject.toLowerCase().includes(filter.toLowerCase())
    );

    filteredNotes.forEach(note => {
        const noteElement = document.createElement("div");
        noteElement.classList.add("note");
        noteElement.innerHTML = `
            <h3>${note.title}</h3>
            <p><strong>Subject:</strong> ${note.subject}</p>
            <p>${note.content}</p>
            <button onclick="editNote(${note.id})">Edit</button>
            <button onclick="deleteNote(${note.id})">Delete</button>
            <button onclick="previewNote(${note.id})">Preview</button>
            <button onclick="setReminder(${note.id})">Set Reminder</button>
        `;
        notesContainer.appendChild(noteElement);
    });
}

// Run Initialization
initializeApp();
// Enhanced BCA Notes App with More Features

// Advanced Search with Filters
function advancedSearch() {
    const titleFilter = document.getElementById("titleFilter").value.toLowerCase();
    const subjectFilter = document.getElementById("subjectFilter").value.toLowerCase();
    const contentFilter = document.getElementById("contentFilter").value.toLowerCase();

    const filteredNotes = notes.filter(note =>
        note.title.toLowerCase().includes(titleFilter) &&
        note.subject.toLowerCase().includes(subjectFilter) &&
        note.content.toLowerCase().includes(contentFilter)
    );

    renderNotes(filteredNotes);
}

// Export Notes to JSON File
function exportNotes() {
    const blob = new Blob([JSON.stringify(notes, null, 2)], { type: "application/json" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "bca_notes.json";
    link.click();
}

// Import Notes from JSON File
function importNotes(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const importedNotes = JSON.parse(e.target.result);
            notes = notes.concat(importedNotes);
            saveNotesToLocalStorage();
            renderNotes();
            renderCategories();
        };
        reader.readAsText(file);
    }
}

// Preview Note in a Modal
function previewNote(id) {
    const note = notes.find(n => n.id === id);
    if (note) {
        const modal = document.getElementById("notePreviewModal");
        modal.querySelector(".modal-title").innerText = note.title;
        modal.querySelector(".modal-subject").innerText = note.subject;
        modal.querySelector(".modal-content").innerText = note.content;
        modal.style.display = "block";
    }
}

// Close Modal
function closeModal() {
    const modal = document.getElementById("notePreviewModal");
    modal.style.display = "none";
}

// Set Reminder for a Note
function setReminder(id) {
    const reminderTime = prompt("Enter reminder time (YYYY-MM-DD HH:MM:SS):");
    if (reminderTime) {
        const reminderDate = new Date(reminderTime);
        const now = new Date();
        if (reminderDate > now) {
            const timeDifference = reminderDate - now;
            setTimeout(() => {
                alert(`Reminder for Note: "${notes.find(note => note.id === id).title}"`);
            }, timeDifference);
        } else {
            alert("The reminder time must be in the future.");
        }
    }
}

// Add Event Listeners for Export and Import
document.getElementById("exportNotes").addEventListener("click", exportNotes);
document.getElementById("importNotes").addEventListener("change", importNotes);

// Render Notes with Advanced Filters
document.getElementById("advancedSearchButton").addEventListener("click", advancedSearch);

// Modal Close Button
document.getElementById("modalCloseButton").addEventListener("click", closeModal);

// Reminder Button in Notes
function renderNotes(filter = "") {
    notesContainer.innerHTML = "";
    const filteredNotes = notes.filter(note =>
        note.title.toLowerCase().includes(filter.toLowerCase()) ||
        note.content.toLowerCase().includes(filter.toLowerCase()) ||
        note.subject.toLowerCase().includes(filter.toLowerCase())
    );

    filteredNotes.forEach(note => {
        const noteElement = document.createElement("div");
        noteElement.classList.add("note");
        noteElement.innerHTML = `
            <h3>${note.title}</h3>
            <p><strong>Subject:</strong> ${note.subject}</p>
            <p>${note.content}</p>
            <button onclick="editNote(${note.id})">Edit</button>
            <button onclick="deleteNote(${note.id})">Delete</button>
            <button onclick="previewNote(${note.id})">Preview</button>
            <button onclick="setReminder(${note.id})">Set Reminder</button>
        `;
        notesContainer.appendChild(noteElement);
    });
}

// Run Initialization
initializeApp();
// Enhanced BCA Notes App with More Features

// Advanced Search with Filters
function advancedSearch() {
    const titleFilter = document.getElementById("titleFilter").value.toLowerCase();
    const subjectFilter = document.getElementById("subjectFilter").value.toLowerCase();
    const contentFilter = document.getElementById("contentFilter").value.toLowerCase();

    const filteredNotes = notes.filter(note =>
        note.title.toLowerCase().includes(titleFilter) &&
        note.subject.toLowerCase().includes(subjectFilter) &&
        note.content.toLowerCase().includes(contentFilter)
    );

    renderNotes(filteredNotes);
}

// Export Notes to JSON File
function exportNotes() {
    const blob = new Blob([JSON.stringify(notes, null, 2)], { type: "application/json" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "bca_notes.json";
    link.click();
}

// Import Notes from JSON File
function importNotes(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const importedNotes = JSON.parse(e.target.result);
            notes = notes.concat(importedNotes);
            saveNotesToLocalStorage();
            renderNotes();
            renderCategories();
        };
        reader.readAsText(file);
    }
}

// Preview Note in a Modal
function previewNote(id) {
    const note = notes.find(n => n.id === id);
    if (note) {
        const modal = document.getElementById("notePreviewModal");
        modal.querySelector(".modal-title").innerText = note.title;
        modal.querySelector(".modal-subject").innerText = note.subject;
        modal.querySelector(".modal-content").innerText = note.content;
        modal.style.display = "block";
    }
}

// Close Modal
function closeModal() {
    const modal = document.getElementById("notePreviewModal");
    modal.style.display = "none";
}

// Set Reminder for a Note
function setReminder(id) {
    const reminderTime = prompt("Enter reminder time (YYYY-MM-DD HH:MM:SS):");
    if (reminderTime) {
        const reminderDate = new Date(reminderTime);
        const now = new Date();
        if (reminderDate > now) {
            const timeDifference = reminderDate - now;
            setTimeout(() => {
                alert(`Reminder for Note: "${notes.find(note => note.id === id).title}"`);
            }, timeDifference);
        } else {
            alert("The reminder time must be in the future.");
        }
    }
}
<div id="categoryContainer"></div>
<div id="sorting">
    <button id="sortByTitle">Sort by Title</button>
    <button id="sortBySubject">Sort by Subject</button>
</div>
<div id="theming">
    <button id="themeLight">Light Theme</button>
    <button id="themeDark">Dark Theme</button>
</div>
<button id="clearNotes">Clear All Notes</button>


// Add Event Listeners for Export and Import
document.getElementById("exportNotes").addEventListener("click", exportNotes);
document.getElementById("importNotes").addEventListener("change", importNotes);

// Render Notes with Advanced Filters
document.getElementById("advancedSearchButton").addEventListener("click", advancedSearch);

// Modal Close Button
document.getElementById("modalCloseButton").addEventListener("click", closeModal);

// Reminder Button in Notes
function renderNotes(filter = "") {
    notesContainer.innerHTML = "";
    const filteredNotes = notes.filter(note =>
        note.title.toLowerCase().includes(filter.toLowerCase()) ||
        note.content.toLowerCase().includes(filter.toLowerCase()) ||
        note.subject.toLowerCase().includes(filter.toLowerCase())
    );

    filteredNotes.forEach(note => {
        const noteElement = document.createElement("div");
        noteElement.classList.add("note");
        noteElement.innerHTML = `
            <h3>${note.title}</h3>
            <p><strong>Subject:</strong> ${note.subject}</p>
            <p>${note.content}</p>
            <button onclick="editNote(${note.id})">Edit</button>
            <button onclick="deleteNote(${note.id})">Delete</button>
            <button onclick="previewNote(${note.id})">Preview</button>
            <button onclick="setReminder(${note.id})">Set Reminder</button>
        `;
        notesContainer.appendChild(noteElement);
    });
}

// Run Initialization
initializeApp();

<!-- Advanced Search -->
<div id="advancedSearch">
    <h4>Advanced Search</h4>
    <input id="titleFilter" type="text" placeholder="Search by Title">
    <input id="subjectFilter" type="text" placeholder="Search by Subject">
    <input id="contentFilter" type="text" placeholder="Search by Content">
    <button id="advancedSearchButton">Search</button>
</div>

<!-- Export and Import -->
<div id="importExport">
    <button id="exportNotes">Export Notes</button>
    <input id="importNotes" type="file" accept=".json">
</div>

<!-- Note Preview Modal -->
<div id="notePreviewModal" class="modal">
    <div class="modal-content">
        <span id="modalCloseButton" class="close">&times;</span>
        <h3 class="modal-title"></h3>
        <p><strong>Subject:</strong> <span class="modal-subject"></span></p>
        <p class="modal-content"></p>
    </div>
</div>
<div id="categoryContainer"></div>
<div id="sorting">
    <button id="sortByTitle">Sort by Title</button>
    <button id="sortBySubject">Sort by Subject</button>
</div>
<div id="theming">
    <button id="themeLight">Light Theme</button>
    <button id="themeDark">Dark Theme</button>
</div>
<button id="clearNotes">Clear All Notes</button>
