import intlTelInput from "intl-tel-input";
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('input[type=tel]');
    inputs.forEach(function (input) {
        const name = input.name;
        input.name = `iti-${name}`;
        const iti = intlTelInput(input, {
            loadUtils: () => import("intl-tel-input/utils"),
            initialCountry: "auto",
            geoIpLookup: (success, failure) => {
                fetch("https://ipapi.co/json")
                    .then((res) => res.json())
                    .then((data) => success(data.country_code))
                    .catch(() => failure());
            },
            nationalMode: true,
            strictMode: true,
            separateDialCode: false,
            hiddenInput: () => ({ phone: name }),
        });
        const hiddenInput = document.querySelector(`input[name=${name}]`);
        // Update both inputs on any change
        const updateNumber = () => {
            const fullNumber = iti.getNumber();
            hiddenInput.value = fullNumber;
        };
        // Add event listeners
        input.addEventListener('input', updateNumber);
        input.addEventListener('countrychange', updateNumber);
    });
});