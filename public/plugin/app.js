// disable websocket connection
// document.addEventListener('visibilitychange', function() {
//     if (document.hidden) {
//         // Disconnect WebSocket or suspend connection here
//         if (socket) {
//             socket.close();
//         }
//     } else {
//         // Reconnect WebSocket or resume connection here
//         if (!socket || socket.readyState === WebSocket.CLOSED) {
//             socket = new WebSocket('ws://your-websocket-server');
//         }
//     }
// });

// back to top button
document.addEventListener('scroll', function() {
    const button = document.getElementById('back-to-top');
    if (window.scrollY > 300) {
      button.classList.remove('opacity-0', 'invisible');
      button.classList.add('opacity-100', 'visible');
    } else {
      button.classList.add('opacity-0', 'invisible');
      button.classList.remove('opacity-100', 'visible');
    }
  });

  document.getElementById('back-to-top').addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
