// Get all the Copy Prompt buttons
const copyBtns = document.querySelectorAll('.promptcopy');

// Add click event listener to each button
copyBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    // Get the prompt text of the clicked button
    const promptText = btn.closest('.promptbox').querySelector('.prompttext p').innerText.trim();

    // Create a temporary textarea element
    const tempTextarea = document.createElement('textarea');
    tempTextarea.value = promptText;

    // Append the textarea element to the body
    document.body.appendChild(tempTextarea);

    // Copy the text from the textarea
    tempTextarea.select();
    document.execCommand('copy');

    // Remove the textarea element
    document.body.removeChild(tempTextarea);

    // Show a confirmation message
    const successDiv = document.createElement('div');
    successDiv.style.position = 'fixed';
    successDiv.style.bottom = '0';
    successDiv.style.left = '10';
    successDiv.style.backgroundColor = 'black';
    successDiv.style.color = 'white';
    successDiv.style.padding = '10px';
    successDiv.style.border = '1px solid white';
    successDiv.textContent = 'Prompt Copied Wohoo!';
    document.body.appendChild(successDiv);

    // Hide the success message after 2 seconds
    setTimeout(() => {
      document.body.removeChild(successDiv);
    }, 2000);
  });
});

       const promptCopyBtns = document.querySelectorAll('.promptcopy');
const bottomIconsParent = document.querySelector('.bottomicons');

promptCopyBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    // Play the success sound
    const successSound = new Audio('./sounds/sucess.mp3');
    successSound.volume = 0.3; // set volume to 30%
    successSound.play();
    
    // Copy the prompt text to clipboard
    const writerText = bottomIconsParent.querySelector('.writer').textContent.trim();
    navigator.clipboard.writeText(writerText);
  });
});

// // Expandation of the prmopt js
// const expandBtns = document.querySelectorAll('.expand-btn');

// expandBtns.forEach(btn => {
//   btn.addEventListener('click', () => {
//     const promptText = btn.parentNode;
//     promptText.classList.toggle('expanded');
//     btn.textContent = promptText.classList.contains('expanded') ? 'Collapse' : 'Expand';
//   });
// });

       