// Stepper lement
var element = document.querySelector("#kt_create_account_stepper");

// Initialize Stepper
var stepper = new KTStepper(element);

// Handle navigation click
stepper.on("kt.stepper.click", function (stepper) {
    stepper.goTo(stepper.getClickedStepIndex()); // go to clicked step
});

// Handle next step
stepper.on("kt.stepper.next", function (stepper) {
    stepper.goNext(); // go next step
});

// Handle previous step
stepper.on("kt.stepper.previous", function (stepper) {
    stepper.goPrevious(); // go previous step
});