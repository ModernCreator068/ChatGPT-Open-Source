{
  const texts = ["Jailbreak your AI chatbot for unlimited potential!", "Experience AI like never before with our interactive chatbot!", "Unleash the true power of AI - try our chatbot prompts now!", "Take your AI experience to the next level - jailbreak your chatbot today!"];
  const delay = 70; // the delay between each character being typed out
  let currentTextIndex = 0;
  let currentCharIndex = 0;
  const typingTextElement = document.getElementById("typing-text");

  function type() {
    if (currentCharIndex < texts[currentTextIndex].length) {
      typingTextElement.innerHTML += texts[currentTextIndex].charAt(currentCharIndex);
      currentCharIndex++;
      setTimeout(type, delay);
    } else {
      setTimeout(() => {
        currentCharIndex = 0;
        currentTextIndex = (currentTextIndex + 1) % texts.length;
        typingTextElement.innerHTML = "";
        type();
      }, 2000); // wait for 2 seconds before moving to the next line
    }
  }

  type();
}


{

  const copyButton = document.getElementById("copyButton");
  const promptText = document.getElementById("promptText");

  copyButton.addEventListener("click", () => {
    navigator.clipboard.writeText(promptText.innerText)
      .then(() => {
        console.log("Prompt text copied to clipboard.");
      })
      .catch((error) => {
        console.error("Failed to copy prompt text: ", error);
      });
  });
}

{
  const copyPromptText = () => {
    navigator.clipboard.writeText(promptText.innerText)
      .then(() => {
        console.log("Prompt text copied to clipboard.");
      })
      .catch((error) => {
        console.error("Failed to copy prompt text: ", error);
      });
  }
  
  document.querySelector('.promptcopy').addEventListener('click', copyPromptText);
}

// {
  

//   const copyButton = document.getElementById("copyButton");
//   const promptText = document.getElementById("promptText");
  
//   copyButton.addEventListener("click", () => {
//   navigator.clipboard.writeText(promptText.innerText)
//   .then(() => {
//   console.log("Prompt text copied to clipboard.");
//   })
//   .catch((error) => {
//   console.error("Failed to copy prompt text: ", error);
//   });
//   });
//   }


{
  
}