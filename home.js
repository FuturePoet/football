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