const BASE = "http://localhost/appointment-system/backend/index.php";

let userId = null;

// REGISTER
function register() {
    fetch(BASE + "/register", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value
        })
    })
    .then(res => res.json())
    .then(data => alert(data.message));
}

// LOGIN
function login() {
    fetch(BASE + "/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            email: document.getElementById("loginEmail").value,
            password: document.getElementById("loginPassword").value
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            userId = data.data.id;
            alert("Login success");
        } else {
            alert(data.message);
        }
    });
}

// BOOK
function book() {
    if (!userId) {
        alert("Login first!");
        return;
    }

    fetch(BASE + "/appointments", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            user_id: userId,
            appointment_date: document.getElementById("date").value,
            appointment_time: document.getElementById("time").value
        })
    })
    .then(res => res.json())
    .then(data => alert(data.message));
}

// GET
function getAppointments() {
    fetch(BASE + "/appointments")
    .then(res => res.json())
    .then(data => {
        const list = document.getElementById("list");
        list.innerHTML = "";

        data.data.forEach(a => {
            const li = document.createElement("li");
            li.innerText = `${a.appointment_date} - ${a.appointment_time}`;
            list.appendChild(li);
        });
    });
}