// BCA Online Notes Application

// Sample Notes Data Structure
let notes = [
    { id: 1, title: "Introduction to Programming", content: "Basics of programming in C.", subject: "Programming" },
    { id: 2, title: "Data Structures", content: "Stacks, queues, linked lists, and trees.", subject: "Computer Science" },
];

// DOM Elements
const notesContainer = document.getElementById("notesContainer");
const addNoteButton = document.getElementById("addNoteButton");
const searchInput = document.getElementById("searchInput");
const noteForm = document.getElementById("noteForm");
const noteTitleInput = document.getElementById("noteTitle");
const noteContentInput = document.getElementById("noteContent");
const noteSubjectInput = document.getElementById("noteSubject");
const saveNoteButton = document.getElementById("saveNoteButton");

let editMode = false;
let editNoteId = null;

// Render Notes Function
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
        `;
        notesContainer.appendChild(noteElement);
    });
}

// Add Note Function
function addNote() {
    const title = noteTitleInput.value.trim();
    const content = noteContentInput.value.trim();
    const subject = noteSubjectInput.value.trim();

    if (title && content && subject) {
        const newNote = {
            id: notes.length ? notes[notes.length - 1].id + 1 : 1,
            title,
            content,
            subject
        };
        notes.push(newNote);
        renderNotes();
        noteForm.reset();
    } else {
        alert("Please fill out all fields!");
    }
}

// Edit Note Function
function editNote(id) {
    const noteToEdit = notes.find(note => note.id === id);
    if (noteToEdit) {
        noteTitleInput.value = noteToEdit.title;
        noteContentInput.value = noteToEdit.content;
        noteSubjectInput.value = noteToEdit.subject;
        editMode = true;
        editNoteId = id;
        saveNoteButton.innerText = "Update Note";
    }
}

// Update Note Function
function updateNote() {
    const title = noteTitleInput.value.trim();
    const content = noteContentInput.value.trim();
    const subject = noteSubjectInput.value.trim();

    if (title && content && subject) {
        const noteIndex = notes.findIndex(note => note.id === editNoteId);
        if (noteIndex > -1) {
            notes[noteIndex] = { id: editNoteId, title, content, subject };
            renderNotes();
            noteForm.reset();
            editMode = false;
            editNoteId = null;
            saveNoteButton.innerText = "Add Note";
        }
    } else {
        alert("Please fill out all fields!");
    }
}

// Delete Note Function
function deleteNote(id) {
    notes = notes.filter(note => note.id !== id);
    renderNotes();
}

// Save Note Button Handler
saveNoteButton.addEventListener("click", () => {
    if (editMode) {
        updateNote();
    } else {
        addNote();
    }
});

// Search Notes Handler
searchInput.addEventListener("input", (e) => {
    renderNotes(e.target.value);
});

// Initial Render
renderNotes();
