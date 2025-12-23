document.addEventListener('DOMContentLoaded', () => {
  if (localStorage.getItem('role') !== 'admin') {
    window.location.href = 'login.html';
  }
});

function uploadVideo() {
  const formData = new FormData();
  formData.append('title', document.getElementById('title').value);
  formData.append('type', document.getElementById('type').value);
  formData.append('thumbnail', document.getElementById('thumbnail').files[0]);
  const videoLink = document.getElementById('videoLink').value;
  if (videoLink) {
    formData.append('videoLink', videoLink);
  }

  fetch('/admin/upload', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => alert(data.message));

  // If uploading video file separately
  const videoFile = document.getElementById('videoFile').files[0];
  if (videoFile) {
    const fileFormData = new FormData();
    fileFormData.append('video', videoFile);
    fetch('/admin/upload-video-file', {
      method: 'POST',
      body: fileFormData
    })
    .then(res => res.json())
    .then(data => {
      console.log('Video file path:', data.path);
      // You can update the video metadata with this path if needed
    });
  }
}

function updateBanners() {
  const banners = []; // Collect from inputs, e.g., multiple fields
  // For simplicity, assume a JSON input field
  const bannersJson = document.getElementById('banners').value;
  fetch('/admin/banners', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ banners: JSON.parse(bannersJson) })
  })
  .then(res => res.json())
  .then(data => alert(data.message));
}