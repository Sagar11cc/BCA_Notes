// Enhanced BCA Online Notes Application

// Save notes to localStorage
function saveNotesToLocalStorage() {
    localStorage.setItem("bcaNotes", JSON.stringify(notes));
}

// Load notes from localStorage
function loadNotesFromLocalStorage() {
    const savedNotes = JSON.parse(localStorage.getItem("bcaNotes"));
    if (savedNotes) {
        notes = savedNotes;
    }
}

// Sort Notes by Title or Subject
function sortNotes(criteria) {
    notes.sort((a, b) => {
        if (criteria === "title") {
            return a.title.localeCompare(b.title);
        } else if (criteria === "subject") {
            return a.subject.localeCompare(b.subject);
        }
    });
    renderNotes();
}

// Categorize Notes by Subject
function renderCategories() {
    const subjects = [...new Set(notes.map(note => note.subject))];
    const categoryContainer = document.getElementById("categoryContainer");
    categoryContainer.innerHTML = "<h4>Categories</h4>";
    subjects.forEach(subject => {
        const categoryButton = document.createElement("button");
        categoryButton.textContent = subject;
        categoryButton.onclick = () => renderNotesBySubject(subject);
        categoryContainer.appendChild(categoryButton);
    });
}

// Render Notes by Subject
function renderNotesBySubject(subject) {
    renderNotes(subject);
}

// Theming Options
function applyTheme(theme) {
    document.body.className = theme;
    localStorage.setItem("bcaTheme", theme);
}

function loadTheme() {
    const savedTheme = localStorage.getItem("bcaTheme");
    if (savedTheme) {
        document.body.className = savedTheme;
    }
}

// Initialize Application
function initializeApp() {
    loadNotesFromLocalStorage();
    loadTheme();
    renderNotes();
    renderCategories();
}

// Clear All Notes
function clearAllNotes() {
    if (confirm("Are you sure you want to delete all notes?")) {
        notes = [];
        saveNotesToLocalStorage();
        renderNotes();
        renderCategories();
    }
}

// Event Listeners for Sorting and Theming
document.getElementById("sortByTitle").addEventListener("click", () => sortNotes("title"));
document.getElementById("sortBySubject").addEventListener("click", () => sortNotes("subject"));

document.getElementById("themeLight").addEventListener("click", () => applyTheme("light-theme"));
document.getElementById("themeDark").addEventListener("click", () => applyTheme("dark-theme"));

document.getElementById("clearNotes").addEventListener("click", clearAllNotes);

// Run the Application
initializeApp();
