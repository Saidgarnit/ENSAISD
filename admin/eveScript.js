// Dynamically load navbar
fetch('partials/_navbar.html')
  .then(response => response.text())
  .then(data => {
    document.getElementById('navbarContainer').innerHTML = data;
  });

// Dynamically load settings panel
fetch('partials/_settings-panel.html')
  .then(response => response.text())
  .then(data => {
    document.getElementById('settingsPanelContainer').innerHTML = data;
  });

// Dynamically load sidebar
fetch('partials/_sidebar.html')
  .then(response => response.text())
  .then(data => {
    document.getElementById('sidebarContainer').innerHTML = data;
  });

// Dynamically load footer
fetch('partials/_footer.html')
  .then(response => response.text())
  .then(data => {
    document.getElementById('footerContainer').innerHTML = data;
  });
