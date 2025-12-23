document.addEventListener('DOMContentLoaded', () => {
  fetch('/videos')
    .then(res => res.json())
    .then(videos => {
      const videoList = document.getElementById('video-list');
      videos.forEach(video => {
        const item = document.createElement('div');
        item.className = 'video-item';
        item.innerHTML = `
          <img src="${video.thumbnail}" alt="${video.title}">
          <p>${video.title} (${video.type})</p>
          <a href="watch.html?id=${video.id}">Watch</a>
        `;
        videoList.appendChild(item);
      });
    });

  fetch('/banners')
    .then(res => res.json())
    .then(banners => {
      const bannerDiv = document.getElementById('banner');
      banners.forEach(banner => {
        const img = document.createElement('img');
        img.src = banner.imageUrl;
        img.onclick = () => window.location.href = banner.link;
        bannerDiv.appendChild(img);
      });
    });
});

// For watch.html
function loadVideo() {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  fetch('/videos')
    .then(res => res.json())
    .then(videos => {
      const video = videos.find(v => v.id == id);
      if (video) {
        const player = document.getElementById('player');
        if (video.source.startsWith('http')) {
          player.src = video.source; // External link
        } else {
          player.src = `/videos/stream/${video.source.split('/').pop()}`; // Local stream
        }
      }
    });
}