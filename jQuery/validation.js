function validateEmail(email) {
    const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return emailRegex.test(email);
}

function validateForm() {
    const emailInput = document.getElementById('email');
    const telephoneInput = document.getElementById('telephone');
    const email = emailInput.value;
    const telephone = telephoneInput.value;
    
    if (!validateEmail(email)) {
      alert('Please enter a valid email address');
      emailInput.focus();
      return false;
    }
    
    if (telephone && !/^\d{11}$/.test(telephone)) {
      alert('Please enter a valid 11-digit telephone number');
      telephoneInput.focus();
      return false;
    }
    
    return true;
}
