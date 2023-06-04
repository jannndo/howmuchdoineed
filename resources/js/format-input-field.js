import 'alpinejs';

window.formatNumber = function(val) {
    let intPart = val.slice(0, -2) || '0';
    let decimalPart = val.slice(-2);
    intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return (intPart !== '0' ? intPart + ',' : '') + decimalPart;
}

window.unformatNumber = function(val) {
    return val.replace(/[\.,]/g, '');
}

window.inputManager = function(inputValue) {
    return {
        inputValue: inputValue,
        warningVisible: false,
        init() {
            this.$watch('inputValue', (value) => {
                if(value !== ''){
                    let cleanValue = this.unformatNumber(value);
                    if(cleanValue.length > 2) {
                        this.inputValue = this.formatNumber(cleanValue);
                    }
                }
            });
            this.$on('inputUpdated', (e) => {
                this.inputValue = this.formatNumber(e.detail);
            });
        },
        input(event) {
            let cleanValue = this.unformatNumber(event.target.value);
            if(cleanValue !== '') {
                if (/^\d+$/.test(cleanValue)) {
                    this.inputValue = cleanValue.length > 2 ? this.formatNumber(cleanValue) : cleanValue;
                    this.warningVisible = false;
                } else {
                    this.warningVisible = true;
                }
            } else {
                this.warningVisible = false;
            }
        }
    }
}

// Wait for Livewire to load before starting Alpine
document.addEventListener('livewire:load', function () {
    window.Alpine = Alpine;
    Alpine.start();
});