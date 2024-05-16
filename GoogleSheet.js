const messageBox = document.getElementById('messageBox')
const messageContent = document.getElementById('messageContent')
const form = document.forms['contact-form']

// Add a loading state to the form submission
let isLoading = false;
form.addEventListener('submit', function(event) {
  if (isLoading) return;
  event.preventDefault()
  isLoading = true;
  const formData = new FormData(form)
  const name = formData.get('your-name')
  const email = formData.get('your-email')
  const phone = formData.get('your-number')
  const message = formData.get('message')

  // Send form data to server and handle response
  fetch('https://script.google.com/macros/s/AKfycbzdcdawrog8ADCigUz-WUAcEON5oG2c0PoyUmU3O7EW6dhbHJ1rBOXs0Hba5pLLAd4Ezw/exec', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    if (data.result === 'success') {
      showMessage('success', `Merci ${name} ! Votre invitation a bien été envoyée.`);
      createCalendarButton();
    } else {
      showMessage('error', 'Une erreur est survenue lors de l\'envoi de votre invitation.');
    }
    isLoading = false;
  })
  .catch(error => {
showMessage('error', 'Une erreur est survenue lorsde l\'envoi de votre invitation.');
    isLoading = false;
  })
})

let calendarButton; // Declare the calendarButton variable

// Function to create the calendar button
function createCalendarButton() {
  if (!calendarButton) {
    calendarButton = document.createElement('button');
    console.log('Bouton créé :', calendarButton);
    calendarButton.textContent = 'Ajouter à mon calendrier';
    calendarButton.innerHTML = `<i class="fas fa-calendar-plus"></i> Ajouter à mon calendrier`;
    calendarButton.className = 'calendar-button btn btn-primary';
    calendarButton.addEventListener('click', () => {
      const eventUrl = createCalendarEventUrl();
      if (eventUrl) {
        window.open(eventUrl, '_blank');
      } else {
        showMessage('error', 'Une erreur est survenue lors de la création de l\'événement.');
      }
    });
    messageBox.appendChild(calendarButton);
  }
}

// Function to create the calendar event URL
function createCalendarEventUrl() {
  const eventTitle = 'Genesis Studio Inauguration';
  const eventDate = '2024-06-27T18:00:00';
  const eventLocation = '19 rue Notre Dame de Nazareth, 75003 Paris';
  const googleCalendarUrl = `https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(eventTitle)}&dates=${encodeURIComponent(eventDate)}&location=${encodeURIComponent(eventLocation)}&details=${encodeURIComponent('Venez célébrer l\'inauguration du studio Genesis !')}`;
  const appleCalendarUrl = `https://calendar.apple.com/event?action=EDIT&text=${encodeURIComponent(eventTitle)}&start=${encodeURIComponent(eventDate)}&location=${encodeURIComponent(eventLocation)}&description=${encodeURIComponent('Venez célébrer l\'inauguration du studio Genesis !')}`;
  if (navigator.userAgent.indexOf('Mac') !== -1) {
    return appleCalendarUrl;
  } else if (navigator.userAgent.indexOf('Chrome') !== -1) {
    return googleCalendarUrl;
  } else {
    return null;
  }
}

// Function to show message
function showMessage(result, message) {
  messageContent.textContent = message
  messageBox.classList.remove('error', 'success')
  messageBox.classList.add(result)
  messageBox.open = true
  messageBox.style.display = "block"; // Affiche l'élément
}

// Function to hide message
function hideMessage() {
  messageBox.classList.remove('error', 'success')
  messageBox.open = false
  messageBox.style.display = "none"; // Cache l'élément
}

// Hide message box after a delay
setTimeout(hideMessage, 5000)