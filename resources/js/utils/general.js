window.addEventListener("DOMContentLoaded", () => {

  const wrapper = document.getElementById("wrapper");
  if (!wrapper) return;

  const continueBtn = document.getElementById("continue-btn");
  const verifyBtn = document.getElementById("verify-btn");
  const backBtn = document.getElementById("back-btn");
  const doneBtn = document.getElementById("done-btn");

  function setStep(step) {
    wrapper.classList.remove("translate-x-0", "-translate-x-1/3", "-translate-x-2/3");

      if (step === "first") {
      wrapper.classList.add("translate-x-0");
    } else if (step === "second") {
      wrapper.classList.add("-translate-x-1/3");
    } else if (step === "third") {
      wrapper.classList.add("-translate-x-2/3");
    }

    localStorage.setItem("currentStep", step);
  }

  continueBtn.addEventListener("click", () => setStep('second'));
  verifyBtn.addEventListener("click", () => setStep('third'));
  backBtn.addEventListener("click", () => setStep('first'));
  doneBtn.addEventListener("click", () => {
    localStorage.removeItem('currentStep');
    window.location.href = '/login';
  });

  window.addEventListener("DOMContentLoaded", () => {
    const step = localStorage.getItem("currentStep") || "register";
    setStep(step);
  });

  const inputs = document.querySelectorAll(".otp-input");

  inputs.forEach((input, index) => {
    input.addEventListener("input", () => {
      if (input.value.length === 1 && index < 5) {
        inputs[index + 1].focus(); 
      }
    });

    input.addEventListener("keydown", (e) => {
      if (e.key === "Backspace" && input.value === "" && index > 0) {
        inputs[index - 1].focus(); 
      }
    });
  });

});
