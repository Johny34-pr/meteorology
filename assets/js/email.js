function validateEmail(email) {
  error = false;
  if (email != 0) {
    if (isValidEmailAddress(email)) {
      error = false;
    } else {
      error = true;
    }
  } else {
    error = true;
  }

  function isValidEmailAddress(emailAddress) {
    var pattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return pattern.test(emailAddress);
  }

  return error;
}
