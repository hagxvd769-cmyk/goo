function register() {
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  fetch('/register', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email, password })
  })
  .then(res => res.json())
  .then(data => alert(data.message));
}

function login() {
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  fetch('/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email, password })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    localStorage.setItem('role', data.role);
    if (data.role === 'admin') {
      window.location.href = 'admin.html';
    } else {
      window.location.href = 'index.html';
    }
  });
}