function sendMessage() {
    var input = document.getElementById('chatbot-input');
    var message = input.value;
    if (message.trim() === '') return;

    var messagesDiv = document.getElementById('chatbot-messages');
    var userMessageDiv = document.createElement('div');
    userMessageDiv.textContent = 'You: ' + message;
    messagesDiv.appendChild(userMessageDiv);

    input.value = '';

    // Simulate AI response
    setTimeout(function() {
        var aiMessageDiv = document.createElement('div');
        aiMessageDiv.textContent = 'AI: ' + getAIResponse(message);
        messagesDiv.appendChild(aiMessageDiv);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }, 1000);
}

function getAIResponse(message) {
    // This is a placeholder function. Replace with actual API call to AI model.
    return 'This is a response to "' + message + '".';
}
$(document).ready(function(){
    $('.carousel').carousel({
        interval: 2000 
    });
});  
const darkModeToggle = document.getElementById('darkModeToggle');

darkModeToggle.addEventListener('click', () => {
document.body.classList.toggle('dark-mode');
});
const text = "Welcome To\nFSP \nWebsite";
const welcomeText = document.getElementById("welcomeText");
let index = 0;

function showText() {
    if (index < text.length) {
        welcomeText.innerHTML += text.charAt(index) === '\n' ? '<br>' : text.charAt(index);
        index++;
        setTimeout(showText, 30000); // 5 minutes in milliseconds
    }
}

showText();

// Add transformations for color and movement
welcomeText.style.transition = 'color 1s, transform 1s';
welcomeText.style.color = 'blue';
welcomeText.style.transform = 'translateX(0)';

setTimeout(() => {
    welcomeText.style.color = 'red';
    welcomeText.style.transform = 'translateX(100px)';
}, 1000);
